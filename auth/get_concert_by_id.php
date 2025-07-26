<?php
// Aktifkan error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Tambahkan header CORS untuk development
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Content-Type: application/json');

require_once 'config.php';

// Log request
file_put_contents('debug.log', date('Y-m-d H:i:s') . " - Request: " . print_r($_GET, true) . "\n", FILE_APPEND);

// Ambil ConcertID dari parameter GET
$concertId = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($concertId <= 0) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid concert ID']);
    exit;
}

try {
    // Query untuk mengambil detail konser berdasarkan ID
    $stmt = $pdo->prepare("
        SELECT 
            c.*, 
            a.Name AS ArtistName,
            a.ImageURL AS ArtistImageURL,
            GROUP_CONCAT(DISTINCT g.genre SEPARATOR ', ') AS Genres
        FROM concerts c
        LEFT JOIN artists a ON c.ArtistID = a.ArtistID
        LEFT JOIN concertgenres cg ON c.ConcertID = cg.ConcertID
        LEFT JOIN genres g ON cg.GenreID = g.GenreID
        WHERE c.ConcertID = :concertId
        GROUP BY c.ConcertID
    ");
    $stmt->bindParam(':concertId', $concertId, PDO::PARAM_INT);
    $stmt->execute();
    
    $concert = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$concert) {
        http_response_code(404);
        echo json_encode(['error' => 'Concert not found']);
        exit;
    }

    // Query untuk mengambil tiket yang tersedia untuk konser ini
    $ticketStmt = $pdo->prepare("
        SELECT TicketTypeID, TypeName, Price, QuantityAvailable, Description
        FROM tickettypes
        WHERE ConcertID = :concertId
        AND QuantityAvailable > 0
    ");
    $ticketStmt->bindParam(':concertId', $concertId, PDO::PARAM_INT);
    $ticketStmt->execute();
    $tickets = $ticketStmt->fetchAll(PDO::FETCH_ASSOC);

    // Gabungkan data konser dengan data tiket
    $concert['tickets'] = $tickets;

    // Konversi harga tiket ke float
    foreach ($concert['tickets'] as &$ticket) {
        $ticket['Price'] = (float)$ticket['Price'];
    }

    echo json_encode($concert);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
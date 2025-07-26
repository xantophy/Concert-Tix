<?php
require_once '../auth/session_config.php';
header('Content-Type: application/json');

if (!isset($_SESSION['UserID'])) {
    http_response_code(401);
    echo json_encode(['error' => 'User not logged in.']);
    exit();
}

include '../auth/config.php'; // Path dari user/ ke auth/

$userID = $_SESSION['UserID'];

try {
    // Query untuk mengambil riwayat tiket pengguna
    // Anda perlu menyesuaikan query ini agar sesuai dengan struktur tabel Anda
    // Misalnya, mengambil data dari `orders`, `orderitems`, `tickettypes`, `concerts`, `artists`, `genres`
    $stmt = $pdo->prepare("
        SELECT
            c.ConcertID,
            c.Title AS concertName,
            c.ImageURL AS image,
            tt.TypeName AS type,
            tt.Price AS price,
            oi.Quantity AS quantity,
            c.ConcertDate AS raw_date,
            c.ConcertTime AS raw_time,
            c.Venue AS venue,
            a.Name AS artistName,
            GROUP_CONCAT(DISTINCT g.genre SEPARATOR ', ') AS genres_list
        FROM
            orders o
        JOIN
            orderitems oi ON o.OrderID = oi.OrderID
        JOIN
            tickettypes tt ON oi.TicketTypeID = tt.TicketTypeID
        JOIN
            concerts c ON tt.ConcertID = c.ConcertID
        LEFT JOIN
            artists a ON c.ArtistID = a.ArtistID
        LEFT JOIN
            concertgenres cg ON c.ConcertID = cg.ConcertID
        LEFT JOIN
            genres g ON cg.GenreID = g.GenreID
        WHERE
            o.UserID = ?
        GROUP BY
            o.OrderID, oi.OrderItemID, c.ConcertID, c.Title, c.ImageURL, tt.TypeName, tt.Price, oi.Quantity, c.ConcertDate, c.ConcertTime, c.Venue, a.Name
        ORDER BY
            c.ConcertDate DESC, c.ConcertTime DESC
    ");
    $stmt->execute([$userID]);
    $tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Format data agar sesuai dengan JavaScript frontend
    $formattedTickets = [];
    foreach ($tickets as $ticket) {
        $concertDate = new DateTime($ticket['raw_date']);
        $concertTime = new DateTime($ticket['raw_time']);

        // Perbaiki penanganan array genres_list
        $genreArray = explode(', ', $ticket['genres_list'] ?? '');
        $ticketTypesArray = [$ticket['type']]; // Asumsikan type adalah single string seperti 'Regular', 'VIP'

        $formattedTickets[] = [
            'id' => $ticket['ConcertID'], // Gunakan ConcertID atau OrderItemID sebagai ID unik
            'title' => htmlspecialchars($ticket['concertName']),
            'date' => $concertDate->format('D, M d, Y') . ' - ' . htmlspecialchars($ticket['venue']),
            'type' => htmlspecialchars($ticket['type'] . ' Ticket'), // Tipe tiket (e.g., Regular Ticket)
            'price' => 'Rp ' . number_format($ticket['price'], 0, ',', '.'), // Format harga
            'quantity' => $ticket['quantity'],
            'image' => htmlspecialchars($ticket['image']),
            'genre' => htmlspecialchars($ticket['genres_list'] ?? 'N/A'), // Untuk marquee
            'ticketTypes' => $ticketTypesArray, // Array tipe tiket untuk badge (sesuai kebutuhan HTML)
            'venue' => htmlspecialchars($ticket['venue']),
            'backDetails' => [
                'date' => $concertDate->format('D, M d, Y'),
                'time' => $concertTime->format('H:i A'),
                'venue' => htmlspecialchars($ticket['venue']),
                'buttonText' => 'View Ticket' // Atau link ke detail tiket yang spesifik
            ]
        ];
    }

    echo json_encode($formattedTickets);

} catch (PDOException $e) {
    http_response_code(500);
    error_log("Database error fetching ticket history for UserID {$userID}: " . $e->getMessage());
    echo json_encode(['error' => 'Database error fetching ticket history.']);
}
?>
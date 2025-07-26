<?php
require_once 'config.php';

try {
    $stmt = $pdo->query("
        SELECT c.*, GROUP_CONCAT(g.genre SEPARATOR ', ') AS Genres
        FROM concerts c
        LEFT JOIN concertgenres cg ON c.ConcertID = cg.ConcertID
        LEFT JOIN genres g ON cg.GenreID = g.GenreID
        WHERE c.IsSlider = 1
        GROUP BY c.ConcertID
        ORDER BY c.ConcertDate DESC
        LIMIT 5
    ");
    
    $concerts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    header('Content-Type: application/json');
    echo json_encode($concerts);
} catch (Exception $e) {
    header('Content-Type: application/json');
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
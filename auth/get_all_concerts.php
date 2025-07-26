<?php
require_once 'config.php';

try {
    $stmt = $pdo->prepare("
        SELECT 
            c.ConcertID,
            c.Title,
            c.Description,
            c.ConcertDate,
            c.ConcertTime,
            c.Venue,
            c.City,
            c.ImageURL,
            MIN(tt.Price) AS MinPrice,
            GROUP_CONCAT(DISTINCT g.genre SEPARATOR ', ') AS Genres
        FROM concerts c
        LEFT JOIN concertgenres cg ON c.ConcertID = cg.ConcertID
        LEFT JOIN genres g ON cg.GenreID = g.GenreID
        LEFT JOIN tickettypes tt ON c.ConcertID = tt.ConcertID
        WHERE c.Status = 'upcoming'
        GROUP BY c.ConcertID
        ORDER BY c.ConcertDate ASC
        LIMIT 28
    ");
    $stmt->execute();
    $concerts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    echo json_encode($concerts);
} catch (Exception $e) {
    header('Content-Type: application/json');
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
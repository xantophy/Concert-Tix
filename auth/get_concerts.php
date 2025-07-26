<?php
require_once 'config.php';

try {
$stmt = $pdo->query("
    SELECT c.*, GROUP_CONCAT(g.genre SEPARATOR ', ') AS Genres
    FROM concerts c
    LEFT JOIN concertgenres cg ON c.ConcertID = cg.ConcertID
    LEFT JOIN genres g ON cg.GenreID = g.GenreID
    GROUP BY c.ConcertID
    ORDER BY c.ConcertDate DESC
");
  
  $concerts = [];
  
  while ($concert = $stmt->fetch()) {
    // Get ticket types
    $ticketStmt = $pdo->prepare("
      SELECT TypeName, Price, QuantityAvailable 
      FROM tickettypes 
      WHERE ConcertID = ?
    ");
    $ticketStmt->execute([$concert['ConcertID']]);
    $tickets = $ticketStmt->fetchAll();
    
    $prices = ['regular' => 0, 'vip' => 0, 'platinum' => 0];
    $stocks = ['regular' => 0, 'vip' => 0, 'platinum' => 0];
    
    foreach ($tickets as $ticket) {
      $type = strtolower($ticket['TypeName']);
      $prices[$type] = (float)$ticket['Price'];
      $stocks[$type] = (int)$ticket['QuantityAvailable'];
    }
    
    $concerts[] = [
      'ConcertID' => $concert['ConcertID'],
      'Title' => $concert['Title'],
      'Venue' => $concert['Venue'],
      'City' => $concert['City'],
      'ImageURL' => $concert['ImageURL'],
      'ConcertDate' => $concert['ConcertDate'],
      'Genres' => $concert['Genres'],
      'Prices' => $prices,
      'Stocks' => $stocks,
      'IsSlider' => (bool)$concert['IsSlider']
    ];
  }
  
  header('Content-Type: application/json');
  echo json_encode($concerts);
} catch (Exception $e) {
  header('Content-Type: application/json');
  http_response_code(500);
  echo json_encode(['error' => $e->getMessage()]);
}
?>
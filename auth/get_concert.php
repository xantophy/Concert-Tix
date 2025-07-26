<?php
require_once 'config.php';

$concertId = $_GET['id'] ?? 0;

try {
  // Get concert
  $stmt = $pdo->prepare("
    SELECT c.*, a.Name AS ArtistName, a.ImageURL AS ArtistImage
    FROM concerts c
    LEFT JOIN artists a ON c.ArtistID = a.ArtistID
    WHERE c.ConcertID = ?
  ");
  $stmt->execute([$concertId]);
  $concert = $stmt->fetch();

  if (!$concert) {
    http_response_code(404);
    echo json_encode(['error' => 'Concert not found']);
    exit;
  }

  // Get genres
  $stmt = $pdo->prepare("
    SELECT g.GenreID, g.genre
    FROM concertgenres cg
    JOIN genres g ON cg.GenreID = g.GenreID
    WHERE cg.ConcertID = ?
  ");
  $stmt->execute([$concertId]);
  $genres = $stmt->fetchAll();

  // Get ticket types
  $stmt = $pdo->prepare("
    SELECT TypeName, Price, QuantityAvailable
    FROM tickettypes
    WHERE ConcertID = ?
  ");
  $stmt->execute([$concertId]);
  $tickets = $stmt->fetchAll();

  // Format data
  $result = [
    'ConcertID' => $concert['ConcertID'],
    'Title' => $concert['Title'],
    'Description' => $concert['Description'],
    'ConcertDate' => $concert['ConcertDate'],
    'ConcertTime' => $concert['ConcertTime'],
    'Venue' => $concert['Venue'],
    'City' => $concert['City'],
    'Address' => $concert['Address'],
    'Facilities' => $concert['Facilities'],
    'MapLink' => $concert['MapLink'], // Tambahkan ini
    'ImageURL' => $concert['ImageURL'],
    'Artist' => [
      'Name' => $concert['ArtistName'],
      'ImageURL' => $concert['ArtistImage']
    ],
    'Genres' => $genres,
    'Tickets' => $tickets,
    'LongDescription' => $concert['LongDescription']
  ];

  header('Content-Type: application/json');
  echo json_encode($result);

} catch (Exception $e) {
  http_response_code(500);
  echo json_encode(['error' => $e->getMessage()]);
}
?>
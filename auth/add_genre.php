<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = json_decode(file_get_contents('php://input'), true);
  
  if (empty($data['genre'])) {
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => 'Genre name required']);
    exit;
  }
  
  try {
    $stmt = $pdo->prepare("INSERT INTO genres (genre) VALUES (?)");
    $stmt->execute([$data['genre']]);
    
    header('Content-Type: application/json');
    echo json_encode([
      'status' => 'success',
      'id' => $pdo->lastInsertId(),
      'genre' => $data['genre']
    ]);
  } catch (Exception $e) {
    header('Content-Type: application/json');
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
  }
} else {
  header('Content-Type: application/json');
  http_response_code(405);
  echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
}
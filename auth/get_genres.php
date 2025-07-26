<?php
require_once 'config.php';

try {
  $stmt = $pdo->query("SELECT * FROM genres ORDER BY genre");
  $genres = $stmt->fetchAll();
  
  header('Content-Type: application/json');
  echo json_encode($genres);
} catch (Exception $e) {
  header('Content-Type: application/json');
  http_response_code(500);
  echo json_encode(['error' => $e->getMessage()]);
}
?>
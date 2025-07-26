<?php
require_once 'config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    try {
        $pdo->beginTransaction();
        
        foreach ($data['updates'] as $update) {
            $stmt = $pdo->prepare("UPDATE concerts SET IsSlider = ? WHERE ConcertID = ?");
            $stmt->execute([$update['isSlider'], $update['id']]);
        }
        
        $pdo->commit();
        
        echo json_encode(['status' => 'success']);
    } catch (Exception $e) {
        $pdo->rollBack();
        echo json_encode([
            'status' => 'error',
            'message' => 'Database error: ' . $e->getMessage()
        ]);
    }
} else {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
}
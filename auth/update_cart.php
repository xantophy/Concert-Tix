<?php
require_once 'session_config.php';
require_once 'config.php';

header('Content-Type: application/json');

$user_id = $_SESSION['UserID'];
$data = json_decode(file_get_contents('php://input'), true);

if (!$data || !isset($data['action'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid data']);
    exit;
}

try {
    // Cari cart aktif
    $stmt = $pdo->prepare("SELECT CartID FROM carts WHERE UserID = ? ORDER BY CreatedDate DESC LIMIT 1");
    $stmt->execute([$user_id]);
    $cart = $stmt->fetch();
    
    if (!$cart) {
        echo json_encode(['success' => false, 'message' => 'Cart not found']);
        exit;
    }
    
    $cartId = $cart['CartID'];
    
    if ($data['action'] === 'update') {
        $stmt = $pdo->prepare("UPDATE cartitems SET Quantity = ? WHERE CartItemID = ? AND CartID = ?");
        $stmt->execute([$data['quantity'], $data['cart_item_id'], $cartId]);
    } 
    elseif ($data['action'] === 'delete') {
        $stmt = $pdo->prepare("DELETE FROM cartitems WHERE CartItemID = ? AND CartID = ?");
        $stmt->execute([$data['cart_item_id'], $cartId]);
    }
    elseif ($data['action'] === 'clear') {
        $stmt = $pdo->prepare("DELETE FROM cartitems WHERE CartID = ?");
        $stmt->execute([$cartId]);
    }
    
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
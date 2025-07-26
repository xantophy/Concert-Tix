<?php
require_once 'session_config.php';
require_once 'config.php';

header('Content-Type: application/json');

// Untuk demo, kita asumsikan user ID 1
$user_id = $_SESSION['UserID'];

try {
    // Cari cart aktif untuk user
    $stmt = $pdo->prepare("SELECT c.CartID FROM carts c WHERE c.UserID = ? ORDER BY c.CreatedDate DESC LIMIT 1");
    $stmt->execute([$user_id]);
    $cart = $stmt->fetch();

    if (!$cart) {
        echo json_encode(['success' => true, 'count' => 0]);
        exit;
    }

    $cartId = $cart['CartID'];

    // Hitung jumlah item di cart
    $stmt = $pdo->prepare("SELECT SUM(ci.Quantity) AS total FROM cartitems ci WHERE ci.CartID = ?");
    $stmt->execute([$cartId]);
    $result = $stmt->fetch();

    $count = $result['total'] ? (int)$result['total'] : 0;

    echo json_encode(['success' => true, 'count' => $count]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
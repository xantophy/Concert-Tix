<?php
// auth/get_cart_items.php
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
        echo json_encode(['success' => true, 'items' => []]);
        exit;
    }

    $cartId = $cart['CartID'];

    // Ambil item cart
    $stmt = $pdo->prepare("
        SELECT ci.*, tt.*, c.*, a.Name AS ArtistName
        FROM cartitems ci
        JOIN tickettypes tt ON ci.TicketTypeID = tt.TicketTypeID
        JOIN concerts c ON tt.ConcertID = c.ConcertID
        JOIN artists a ON c.ArtistID = a.ArtistID
        WHERE ci.CartID = ?
    ");
    $stmt->execute([$cartId]);
    $items = $stmt->fetchAll();

    echo json_encode(['success' => true, 'items' => $items]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
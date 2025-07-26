<?php
require_once 'session_config.php';
require_once 'config.php';

header('Content-Type: application/json');

// Untuk demo, kita asumsikan user ID 1
$user_id = $_SESSION['UserID'];

$data = json_decode(file_get_contents('php://input'), true);

if (!$data || !isset($data['ticket_type_id']) || !isset($data['quantity'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid data']);
    exit;
}

$ticket_type_id = $data['ticket_type_id'];
$quantity = $data['quantity'];

try {
    // Cari cart aktif untuk user ini
    $stmt = $pdo->prepare("SELECT CartID FROM carts WHERE UserID = ? ORDER BY CreatedDate DESC LIMIT 1");
    $stmt->execute([$user_id]);
    $cart = $stmt->fetch();

    if (!$cart) {
        // Buat cart baru
        $stmt = $pdo->prepare("INSERT INTO carts (UserID) VALUES (?)");
        $stmt->execute([$user_id]);
        $cart_id = $pdo->lastInsertId();
    } else {
        $cart_id = $cart['CartID'];
    }

    // Cek apakah item sudah ada di cart
    $stmt = $pdo->prepare("SELECT * FROM cartitems WHERE CartID = ? AND TicketTypeID = ?");
    $stmt->execute([$cart_id, $ticket_type_id]);
    $existingItem = $stmt->fetch();

    if ($existingItem) {
        // Update quantity
        $newQuantity = $existingItem['Quantity'] + $quantity;
        $stmt = $pdo->prepare("UPDATE cartitems SET Quantity = ? WHERE CartItemID = ?");
        $stmt->execute([$newQuantity, $existingItem['CartItemID']]);
    } else {
        // Insert new item
        $stmt = $pdo->prepare("INSERT INTO cartitems (CartID, TicketTypeID, Quantity) VALUES (?, ?, ?)");
        $stmt->execute([$cart_id, $ticket_type_id, $quantity]);
    }

    echo json_encode(['success' => true, 'message' => 'Item added to cart']);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
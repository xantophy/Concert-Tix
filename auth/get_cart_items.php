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
// Di akhir try block sebelum json_encode
$baseImagePath = '/assets/images/'; // Path absolut dari root
$defaultImage = $baseImagePath . 'default-concert.jpg';

$items = array_map(function($item) use ($baseImagePath, $defaultImage) {
    // Jika ImageURL kosong atau tidak valid
    if (empty($item['ImageURL'])) {
        $item['ImageURL'] = $defaultImage;
    } 
    // Jika ImageURL relatif (mengandung ../)
    else if (strpos($item['ImageURL'], '../') === 0) {
        $item['ImageURL'] = $baseImagePath . basename($item['ImageURL']);
    }
    // Jika ImageURL sudah absolut, biarkan apa adanya
    
    return $item;
}, $items);

echo json_encode(['success' => true, 'items' => $items]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
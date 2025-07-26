<?php
require_once '../auth/session_config.php';
header('Content-Type: application/json');

if (!isset($_SESSION['UserID'])) {
    http_response_code(401);
    echo json_encode(['error' => 'User not logged in.']);
    exit();
}

include '../auth/config.php'; // Path dari user/ ke auth/

$userID = $_SESSION['UserID'];

try {
    $stmt = $pdo->prepare("
        SELECT g.GenreID, g.genre
        FROM usergenres ug
        JOIN genres g ON ug.GenreID = g.GenreID
        WHERE ug.UserID = ?
    ");
    $stmt->execute([$userID]);
    $userSelectedGenres = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($userSelectedGenres);

} catch (PDOException $e) {
    http_response_code(500);
    error_log("Database error fetching user genres for UserID {$userID}: " . $e->getMessage());
    echo json_encode(['error' => 'Database error fetching user genres.']);
}
?>
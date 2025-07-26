<?php
ob_start(); // Biarkan ini tetap ada jika membantu mencegah output error, atau hapus jika tidak diperlukan
require_once 'session_config.php';
include 'config.php';

// Atur header untuk merespons dalam JSON
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $stmt = $pdo->prepare("SELECT UserID, FullName, PasswordHash, Role FROM users WHERE Email = ?"); // 'Role' dengan R kapital
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user) {
            if (password_verify($password, $user['PasswordHash'])) {
                $_SESSION['UserID'] = $user['UserID'];
                $_SESSION['name'] = $user['FullName'];
                $_SESSION['role'] = $user['Role']; // 'Role' dengan R kapital

                // Berikan respons JSON sukses, termasuk peran untuk pengalihan di klien
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Login successful',
                    'role' => $user['Role'] // Kirim peran ke klien ('Role' dengan R kapital)
                ]);
                exit();
            } else {
                // Password salah
                echo json_encode(['status' => 'error', 'message' => 'Invalid credentials.']);
                exit();
            }
        } else {
            // User tidak ditemukan
            echo json_encode(['status' => 'error', 'message' => 'No user found with that email.']);
            exit();
        }
    } catch (PDOException $e) {
        // Tangani error database
        http_response_code(500); // Set status code untuk error server
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
        exit();
    }
} else {
    // Metode request tidak diizinkan
    http_response_code(405); // Method Not Allowed
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed.']);
    exit();
}
?>
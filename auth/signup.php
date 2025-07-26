<?php
error_reporting(E_ALL); // Aktifkan semua pelaporan error PHP
ini_set('display_errors', 1); // Tampilkan error di browser

// Sertakan session_config.php dan config.php
require_once 'session_config.php'; 
include 'config.php'; 

// Atur header untuk merespons dalam JSON
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // === Bagian 1: Menyimpan Akun Pengguna ===
    // Cek apakah ini request untuk menyimpan akun (tidak ada 'action' parameter)
    if (!isset($_POST['action'])) { // Jika tidak ada parameter 'action', anggap ini pendaftaran akun
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        // Validasi dasar
        if (empty($name) || empty($email) || empty($password)) {
            echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
            exit();
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid email format.']);
            exit();
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        try {
            // Periksa apakah email sudah terdaftar
            $stmtCheck = $pdo->prepare("SELECT COUNT(*) FROM users WHERE Email = ?");
            $stmtCheck->execute([$email]);
            if ($stmtCheck->fetchColumn() > 0) {
                echo json_encode(['status' => 'error', 'message' => 'Email already registered.']);
                exit();
            }

            // Masukkan data pengguna baru
            $stmt = $pdo->prepare("INSERT INTO users (FullName, PasswordHash, Email, Role) VALUES (?, ?, ?, 'user')");
            if ($stmt->execute([$name, $passwordHash, $email])) {
                // Sesi sudah dimulai oleh session_config.php
                $_SESSION['UserID'] = $pdo->lastInsertId(); // Simpan UserID baru di sesi
                $_SESSION['name'] = $name;
                $_SESSION['role'] = 'user';

                echo json_encode([
                    'status' => 'success',
                    'message' => 'Account created successfully!',
                    'userId' => $_SESSION['UserID'] // Kirim UserID kembali ke klien
                ]);
                exit();
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Signup failed: Could not insert user data.']);
                exit();
            }
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'Database error during account creation: ' . $e->getMessage()]);
            exit();
        }
    } 
    // === Bagian 2: Menyimpan Genre Pengguna ===
    // Cek jika ini adalah request untuk menyimpan genre (ada 'action' = 'save_genres')
    else if (isset($_POST['action']) && $_POST['action'] === 'save_genres') {
        // Sesi sudah dimulai oleh session_config.php

        // Pastikan pengguna sudah login sebelum menyimpan genre
        if (!isset($_SESSION['UserID'])) {
            echo json_encode(['status' => 'error', 'message' => 'User not logged in or session expired.']);
            exit();
        }

        $userID = $_SESSION['UserID'];
        // Ambil genre dari array POST, pastikan itu array
        $selectedGenreIDs = isset($_POST['genres']) ? (array)$_POST['genres'] : [];

        try {
            $pdo->beginTransaction(); // Mulai transaksi untuk atomisitas

            // Hapus genre lama pengguna (jika ada) untuk menghindari duplikasi
            $stmtDelete = $pdo->prepare("DELETE FROM usergenres WHERE UserID = ?");
            $stmtDelete->execute([$userID]);

            // Masukkan genre baru yang dipilih
            $stmtInsert = $pdo->prepare("INSERT INTO usergenres (UserID, GenreID) VALUES (?, ?)");
            foreach ($selectedGenreIDs as $genreID) {
                // Pastikan genreID adalah integer yang valid
                $genreID = (int)$genreID;
                if ($genreID > 0) { // Hanya masukkan jika GenreID valid
                    $stmtInsert->execute([$userID, $genreID]);
                }
            }

            $pdo->commit(); // Commit transaksi

            echo json_encode(['status' => 'success', 'message' => 'Genres saved successfully!']);
            exit();

        } catch (PDOException $e) {
            $pdo->rollBack(); // Rollback jika ada error
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'Database error during genre save: ' . $e->getMessage()]);
            exit();
        }
    }
    // Jika ada 'action' tapi tidak dikenal
    else {
        http_response_code(400); // Bad Request
        echo json_encode(['status' => 'error', 'message' => 'Invalid request action.']);
        exit();
    }
} else {
    // Metode request bukan POST
    http_response_code(405); // Method Not Allowed
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed.']);
    exit();
}
?>
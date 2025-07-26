<?php
require_once '../auth/session_config.php';
header('Content-Type: application/json');

if (!isset($_SESSION['UserID'])) {
    http_response_code(401);
    echo json_encode(['status' => 'error', 'message' => 'User not logged in.']);
    exit();
}

include '../auth/config.php'; // Path dari user/ ke auth/

$userID = $_SESSION['UserID'];
$action = $_POST['action'] ?? '';

try {
    if ($action === 'update_profile') {
        $fullName = $_POST['fullName'] ?? '';
        $email = $_POST['email'] ?? '';
        $profilePictureURL = null; // Default to null, will be updated if file uploaded

        // Handle profile picture upload
        if (isset($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] === UPLOAD_ERR_OK) {
            $targetDir = "../../assets/images/profiles/"; // Path untuk menyimpan gambar
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0755, true);
            }
            $fileName = uniqid() . '_' . basename($_FILES['profilePicture']['name']);
            $targetFilePath = $targetDir . $fileName;

            // Pastikan file adalah gambar yang valid
            $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
            $allowedTypes = ['jpg', 'png', 'jpeg', 'gif'];
            if (!in_array($imageFileType, $allowedTypes)) {
                echo json_encode(['status' => 'error', 'message' => 'Invalid image file type. Only JPG, JPEG, PNG, GIF are allowed.']);
                exit();
            }

            // Batasi ukuran file (misal 2MB)
            if ($_FILES['profilePicture']['size'] > 2 * 1024 * 1024) { // 2MB
                echo json_encode(['status' => 'error', 'message' => 'File size exceeds 2MB limit.']);
                exit();
            }

            if (move_uploaded_file($_FILES['profilePicture']['tmp_name'], $targetFilePath)) {
                $profilePictureURL = "/Concert/assets/images/profiles/" . $fileName; // Path URL untuk disimpan di DB
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to upload profile picture.']);
                exit();
            }
        } else {
             // Ambil URL gambar profil yang sudah ada jika tidak ada upload baru
            $stmt = $pdo->prepare("SELECT ProfilePictureURL FROM users WHERE UserID = ?");
            $stmt->execute([$userID]);
            $existingProfilePicture = $stmt->fetchColumn();
            $profilePictureURL = $existingProfilePicture; // Pertahankan yang sudah ada
        }

        $sql = "UPDATE users SET FullName = ?, Email = ?";
        $params = [$fullName, $email];
        if ($profilePictureURL !== null) { // Hanya update kolom gambar jika ada gambar baru atau gambar lama yang dipertahankan
            $sql .= ", ProfilePictureURL = ?";
            $params[] = $profilePictureURL;
        }
        $sql .= " WHERE UserID = ?";
        $params[] = $userID;

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);

        // Update session variables if name or email changed
        $_SESSION['name'] = $fullName; // Update sesi nama

        echo json_encode([
            'status' => 'success',
            'message' => 'Profile updated successfully!',
            'fullName' => $fullName,
            'email' => $email,
            'profilePictureURL' => $profilePictureURL
        ]);
        exit();

    } elseif ($action === 'update_password') {
        $currentPassword = $_POST['currentPassword'] ?? '';
        $newPassword = $_POST['newPassword'] ?? '';
        $confirmNewPassword = $_POST['confirmNewPassword'] ?? ''; // Pastikan ini juga diambil

        if (empty($currentPassword) || empty($newPassword) || empty($confirmNewPassword)) {
            echo json_encode(['status' => 'error', 'message' => 'All password fields are required.']);
            exit();
        }

        if ($newPassword !== $confirmNewPassword) {
            echo json_encode(['status' => 'error', 'message' => 'New passwords do not match.']);
            exit();
        }

        // Tambahkan validasi kekuatan password jika diperlukan
        // if (strlen($newPassword) < 8) {
        //     echo json_encode(['status' => 'error', 'message' => 'New password must be at least 8 characters long.']);
        //     exit();
        // }

        // Ambil password hash lama dari DB
        $stmt = $pdo->prepare("SELECT PasswordHash FROM users WHERE UserID = ?");
        $stmt->execute([$userID]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user || !password_verify($currentPassword, $user['PasswordHash'])) {
            echo json_encode(['status' => 'error', 'message' => 'Incorrect current password.']);
            exit();
        }

        $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE users SET PasswordHash = ? WHERE UserID = ?");
        $stmt->execute([$newPasswordHash, $userID]);

        echo json_encode(['status' => 'success', 'message' => 'Password updated successfully!']);
        exit();

    } elseif ($action === 'update_genres') {
        $selectedGenreIDs = isset($_POST['genres']) ? (array)$_POST['genres'] : [];

        $pdo->beginTransaction();
        // Hapus genre lama
        $stmtDelete = $pdo->prepare("DELETE FROM usergenres WHERE UserID = ?");
        $stmtDelete->execute([$userID]);

        // Masukkan genre baru
        $stmtInsert = $pdo->prepare("INSERT INTO usergenres (UserID, GenreID) VALUES (?, ?)");
        foreach ($selectedGenreIDs as $genreID) {
            $genreID = (int)$genreID;
            if ($genreID > 0) { // Hanya masukkan jika GenreID valid
                $stmtInsert->execute([$userID, $genreID]);
            }
        }
        $pdo->commit();

        echo json_encode(['status' => 'success', 'message' => 'Favorite genres updated successfully!']);
        exit();
    } else {
        http_response_code(400); // Bad Request
        echo json_encode(['status' => 'error', 'message' => 'Invalid action.']);
        exit();
    }
} catch (PDOException $e) {
    if ($pdo->inTransaction()) { // Hanya rollback jika transaksi aktif
        $pdo->rollBack(); 
    }
    http_response_code(500);
    error_log("Database error in update_profile.php (Action: $action, UserID: $userID): " . $e->getMessage());
    echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
    exit();
}
<?php
require_once '../auth/session_config.php'; // Mulai sesi

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['UserID'])) {
    // Jika belum login, alihkan ke halaman login
    header("Location: ../auth/login.html");
    exit();
}

// Sertakan file konfigurasi database
// Path ini relatif dari htdocs../user/ ke htdocs../auth/
include '../auth/config.php'; 

$loggedInUserID = $_SESSION['UserID'];
$loggedInUserName = $_SESSION['name']; // Ambil dari sesi
$loggedInUserRole = $_SESSION['role']; // Ambil dari sesi

// Default values jika data tidak ditemukan atau ada error
$userData = [
    'FullName' => $loggedInUserName,
    'Email' => 'N/A', // Akan diisi dari DB jika berhasil
    'Role' => $loggedInUserRole,
    'ProfilePictureURL' => 'https://randomuser.me/api/portraits/men/75.jpg' // Default image
];
$userGenres = [];
$allAvailableGenres = []; // Untuk menampilkan semua genre di form edit
$totalConcerts = 0; // Statistik dummy
$totalVipTickets = 0; // Statistik dummy
$totalPremiumTickets = 0; // Statistik dummy

try {
    // Ambil detail pengguna dari tabel users
    $stmtUser = $pdo->prepare("SELECT FullName, Email, Role, ProfilePictureURL FROM users WHERE UserID = ?");
    $stmtUser->execute([$loggedInUserID]);
    $fetchedUserData = $stmtUser->fetch(PDO::FETCH_ASSOC);

    if ($fetchedUserData) {
        $userData = array_merge($userData, $fetchedUserData);
        // Jika ProfilePictureURL kosong di DB, tetap pakai default
        if (empty($userData['ProfilePictureURL'])) {
            $userData['ProfilePictureURL'] = 'https://randomuser.me/api/portraits/men/75.jpg'; // Default image jika kosong
        }
    }

    // Ambil genre favorit pengguna dari tabel usergenres
    $stmtUserGenres = $pdo->prepare("
        SELECT g.GenreID, g.genre
        FROM usergenres ug
        JOIN genres g ON ug.GenreID = g.GenreID
        WHERE ug.UserID = ?
    ");
    $stmtUserGenres->execute([$loggedInUserID]);
    $userGenres = $stmtUserGenres->fetchAll(PDO::FETCH_ASSOC);

    // Ambil semua genre yang tersedia dari tabel genres untuk form edit
    $stmtAllGenres = $pdo->query("SELECT GenreID, genre FROM genres ORDER BY genre");
    $allAvailableGenres = $stmtAllGenres->fetchAll(PDO::FETCH_ASSOC);

    // TODO: Implementasi pengambilan statistik konser/tiket dari database di sini
    // Ini adalah dummy data untuk statistik. Anda perlu mengimplementasikan query database yang sebenarnya.
    // Contoh query (Anda harus menyesuaikannya dengan skema tabel orders dan tickettypes Anda):
    /*
    $stmtTotalConcerts = $pdo->prepare("SELECT COUNT(DISTINCT o.ConcertID) FROM orders o JOIN orderitems oi ON o.OrderID = oi.OrderID JOIN tickettypes tt ON oi.TicketTypeID = tt.TicketTypeID WHERE o.UserID = ?");
    $stmtTotalConcerts->execute([$loggedInUserID]);
    $totalConcerts = $stmtTotalConcerts->fetchColumn();

    $stmtVIPTickets = $pdo->prepare("SELECT SUM(oi.Quantity) FROM orders o JOIN orderitems oi ON o.OrderID = oi.OrderID JOIN tickettypes tt ON oi.TicketTypeID = tt.TicketTypeID WHERE o.UserID = ? AND tt.TypeName = 'VIP'");
    $stmtVIPTickets->execute([$loggedInUserID]);
    $totalVipTickets = $stmtVIPTickets->fetchColumn();

    $stmtPremiumTickets = $pdo->prepare("SELECT SUM(oi.Quantity) FROM orders o JOIN orderitems oi ON o.OrderID = oi.OrderID JOIN tickettypes tt ON oi.TicketTypeID = tt.TicketTypeID WHERE o.UserID = ? AND tt.TypeName = 'Platinum'"); // Ganti 'Platinum' jika nama tipe tiket premium Anda berbeda
    $stmtPremiumTickets->execute([$loggedInUserID]);
    $totalPremiumTickets = $stmtPremiumTickets->fetchColumn();
    */

} catch (PDOException $e) {
    // Jika ada error database, log error dan gunakan data dari sesi/default
    error_log("Database error in profile.php: " . $e->getMessage());
    // Fallback ke data sesi/default jika ada error database
    // Data dummy statistik tetap, hanya data user/genre yang di-fallback
    $userData['Email'] = 'Failed to load email';
    $userGenres = []; // Kosongkan genre jika ada error
}

// Konversi genre yang diambil dari database ke format HTML tags
$genreTagsHtml = '';
if (!empty($userGenres)) {
    foreach ($userGenres as $genre) {
        $genreTagsHtml .= '<span class="genre-tag" data-genre-id="' . htmlspecialchars($genre['GenreID']) . '">' . htmlspecialchars($genre['genre']) . '</span>';
    }
} else {
    $genreTagsHtml = '<span class="text-muted">No favorite genres selected.</span>';
}

// Persiapan HTML untuk checkbox genre di "edit mode"
$editGenresHtml = '';
$userGenreIDs = array_column($userGenres, 'GenreID'); // Ambil hanya ID genre yang dimiliki user
foreach ($allAvailableGenres as $genre) {
    $checked = in_array($genre['GenreID'], $userGenreIDs) ? 'checked' : '';
    $editGenresHtml .= '
        <div class="form-check me-3 mb-2">
            <input class="form-check-input" type="checkbox" id="editGenre' . htmlspecialchars($genre['GenreID']) . '" name="genres[]" value="' . htmlspecialchars($genre['GenreID']) . '" ' . $checked . ' />
            <label class="form-check-label" for="editGenre' . htmlspecialchars($genre['GenreID']) . '">' . htmlspecialchars($genre['genre']) . '</label>
        </div>
    ';
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../assets/images/logo_1.png" type="image/x-icon" />
    <title>My Profile - ConcertTix</title>

    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'" />
    <noscript><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" /></noscript>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet" />

    <style>
      /* VARIABLES */
      :root {
        --primary-purple: #8a4fff;
        --primary-orange: #ff6600;
        --gradient-purple: linear-gradient(135deg, #8a4fff 0%, #5e2de0 100%);
      }

      /* BASE STYLES */
      body {
        background: linear-gradient(to bottom, #f5f0ff 0%, #ffffff 100%);
        overflow-x: hidden;
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      }

      /* Wider container */
      .container {
        max-width: 100%;
        padding-left: 15px;
        padding-right: 15px;
      }

      /* Navbar Styles */
      .navbar {
        transition: all 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
        box-shadow: 0 2px 15px rgba(138, 79, 255, 0.1);
        padding: 0.5rem 0;
      }

      .navbar .container {
        max-width: 100%;
        padding-left: 15px;
        padding-right: 15px;
      }

      .navbar.scrolled {
        padding: 0.5rem 0 !important;
        background: rgba(138, 79, 255, 0.98) !important;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25) !important;
        backdrop-filter: blur(10px);
      }

      .navbar.scrolled .navbar-brand span:first-child {
        color: white !important;
      }

      .navbar.scrolled .navbar-brand span:last-child {
        color: var(--primary-orange) !important;
      }

      /* Navbar brand */
      .navbar-brand {
        font-size: 1.6rem;
        font-weight: 700;
        transition: all 0.3s ease;
        margin-right: 1rem;
      }

      .navbar-brand:hover {
        transform: scale(1.03);
      }

      /* Search input styles */
      .navbar:not(.scrolled) .input-group {
        border: 2px solid var(--primary-purple);
        border-radius: 1.5rem;
        overflow: hidden;
      }

      .navbar:not(.scrolled) .form-control {
        border-left: none;
        border-color: var(--primary-purple);
        background-color: white;
      }

      /* Button styles */
      .navbar:not(.scrolled) .btn-outline-secondary,
      .navbar:not(.scrolled) .btn-outline-purple {
        border-color: var(--primary-purple);
        color: var(--primary-purple);
      }

      .navbar:not(.scrolled) .btn-outline-secondary:hover,
      .navbar:not(.scrolled) .btn-outline-purple:hover {
        background: var(--primary-purple);
        color: white;
      }

      .navbar:not(.scrolled) .btn-purple-gradient {
        background: var(--gradient-purple);
        color: white;
      }

      .navbar:not(.scrolled) .btn-purple-gradient:hover {
        background: linear-gradient(135deg, #7a3fef 0%, #4e1dd0 100%);
        color: white;
      }

      /* Button styles for offcanvas menu */
      .btn-outline-purple {
        color: #8a4fff;
        border-color: #8a4fff;
        transition: all 0.3s ease;
      }

      .btn-outline-purple:hover {
        background: #8a4fff;
        color: white;
      }

      .btn-purple-gradient {
        background: linear-gradient(135deg, #8a4fff 0%, #5e2de0 100%);
        color: white;
        border: none;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
      }

      .btn-purple-gradient:hover {
        background: linear-gradient(135deg, #7a3fef 0%, #4e1dd0 100%);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(138, 79, 255, 0.3);
      }

      /* Hover effect for gradient button */
      .btn-purple-gradient::before {
        content: "";
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.473), transparent);
        transition: 0.5s;
      }

      .btn-purple-gradient:hover::before {
        left: 100%;
      }

      /* Style for scrolled navbar buttons */
      .navbar.scrolled .btn-outline-secondary,
      .navbar.scrolled .btn-outline-purple {
        border-color: rgba(255, 255, 255, 0.5);
        color: rgba(255, 255, 255, 0.8);
      }

      .navbar.scrolled .btn-outline-secondary:hover,
      .navbar.scrolled .btn-outline-purple:hover {
        border-color: var(--primary-orange);
        background: var(--primary-orange);
        color: white;
      }

      .navbar.scrolled .btn-purple-gradient {
        background: var(--primary-orange);
        color: white;
      }

      .navbar.scrolled .btn-purple-gradient:hover {
        background: #ff5500;
        color: white;
        box-shadow: 0 4px 15px rgba(255, 102, 0, 0.3);
      }

      /* Ikon search di navbar */
      .navbar:not(.scrolled) .input-group-text {
        background-color: white;
        color: var(--primary-purple);
        border-right: none;
        border-color: var(--primary-purple);
      }

      .navbar.scrolled .input-group-text {
        color: rgb(228, 221, 221) !important;
        background-color: rgba(255, 255, 255, 0.1) !important;
        border-color: rgba(255, 255, 255, 0.5) !important;
      }

      /* Placeholder text */
      .navbar:not(.scrolled) .form-control::placeholder {
        color: #6c757d;
      }

      .navbar.scrolled .form-control::placeholder {
        color: rgba(255, 255, 255, 0.8) !important;
      }

      .navbar.scrolled .form-control {
        border-color: rgba(255, 255, 255, 0.5);
        color: white;
        background-color: rgba(255, 255, 255, 0.1);
      }

      .navbar.scrolled .input-group:hover .input-group-text {
        background-color: rgba(255, 255, 255, 0.2) !important;
        color: white !important;
      }

      /* Hover state untuk search di navbar putih */
      .navbar:not(.scrolled) .input-group:hover .input-group-text {
        background-color: var(--primary-purple);
        color: white;
      }

      .navbar:not(.scrolled) .input-group:hover .form-control {
        border-color: var(--primary-purple);
        color: #333;
      }

      .navbar:not(.scrolled) .form-control {
        border-color: var(--primary-purple);
        color: #333;
      }

      /* Navbar toggler */
      .navbar-toggler {
        border: none;
        padding: 0.5rem;
        font-size: 1.25rem;
        display: block !important;
      }

      .navbar-toggler:focus {
        box-shadow: none;
        outline: none;
      }

      .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(138, 79, 255, 0.8)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
      }

      .navbar.scrolled .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 255, 255, 0.8)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
      }

      /* Offcanvas menu styles */
      .offcanvas-start {
        width: 250px;
        background: linear-gradient(to bottom, #f5f0ff 0%, #ffffff 100%);
      }

      .nav-link {
        padding: 0.5rem 1rem;
        border-radius: 0.25rem;
        margin-bottom: 0.25rem;
        transition: all 0.3s ease;
      }

      .nav-link:hover {
        background-color: rgba(138, 79, 255, 0.1);
        color: var(--primary-purple);
      }

      .offcanvas-body .nav-link {
        position: relative;
        overflow: hidden;
      }

      .offcanvas-body .nav-link::before {
        content: "";
        position: absolute;
        left: 0;
        bottom: 0;
        width: 0;
        height: 2px;
        background: var(--primary-purple);
        transition: width 0.3s ease;
      }

      .offcanvas-body .nav-link:hover::before {
        width: 100%;
      }

      /* Responsive adjustments */
      @media (max-width: 992px) {
        .navbar-brand span.ms-3 {
          display: none !important;
        }

        .navbar-collapse {
          padding-top: 1rem;
        }

        .justify-content-center {
          justify-content: flex-start !important;
          margin-left: 1rem;
        }

        .navbar-toggler.order-first {
          order: 0 !important;
        }

        .navbar-brand.order-lg-1 {
          order: 1 !important;
          margin-right: auto;
        }

        .justify-content-center.order-lg-2 {
          order: 3 !important;
          flex-basis: 100%;
          margin-top: 0.5rem;
        }

        .ms-lg-3.order-lg-3 {
          order: 2 !important;
          margin-left: auto;
        }

        .navbar .container {
          flex-wrap: wrap;
          justify-content: space-between;
        }

        .navbar-brand {
          order: 1;
          margin-right: auto;
        }

        .navbar-toggler {
          order: 0;
        }

        .navbar-collapse {
          order: 2;
          flex-basis: 100%;
        }

        .navbar .input-group {
          width: 100%;
        }
      }

      @media (max-width: 768px) {
        .navbar .container {
          flex-wrap: nowrap;
        }

        .navbar-toggler.me-2 {
          margin-right: 0.5rem !important;
        }

        .navbar-brand {
          font-size: 1.4rem !important;
          margin-right: 0;
        }

        .d-flex.flex-grow-1 {
          flex-grow: 0 !important;
          margin-left: auto;
        }
      }

      /* Animations */
      @keyframes floatLink {
        0%,
        100% {
          transform: translateY(0);
        }
        50% {
          transform: translateY(-2px);
        }
      }

      @keyframes subtleShake {
        0%,
        100% {
          transform: translateX(0) rotate(0deg);
        }
        25% {
          transform: translateX(-2px) rotate(-0.5deg);
        }
        50% {
          transform: translateX(2px) rotate(0.5deg);
        }
        75% {
          transform: translateX(-1px) rotate(-0.3deg);
        }
      }

      @keyframes pulse {
        0% {
          transform: scale(1);
        }
        50% {
          transform: scale(1.05);
        }
        100% {
          transform: scale(1);
        }
      }

      @keyframes float {
        0%,
        100% {
          transform: translateY(0);
        }
        50% {
          transform: translateY(-5px);
        }
      }

      /* Apply animations */
      .menu-item-float {
        animation: floatLink 4s infinite ease-in-out;
      }

      .subtle-shake {
        animation: subtleShake 5s infinite ease-in-out;
      }

      .pulse-animation {
        animation: pulse 2s infinite ease-in-out;
      }

      .float-animation {
        animation: float 3s infinite ease-in-out;
      }

      .social-float {
        animation: float 4s infinite ease-in-out;
      }

      /* Delay animations for staggered effect */
      .menu-item-float:nth-child(1) {
        animation-delay: 0.1s;
      }
      .menu-item-float:nth-child(2) {
        animation-delay: 0.2s;
      }
      .menu-item-float:nth-child(3) {
        animation-delay: 0.3s;
      }
      .menu-item-float:nth-child(4) {
        animation-delay: 0.4s;
      }

      .social-float:nth-child(1) {
        animation-delay: 0.1s;
      }
      .social-float:nth-child(2) {
        animation-delay: 0.2s;
      }
      .social-float:nth-child(3) {
        animation-delay: 0.3s;
      }
      .social-float:nth-child(4) {
        animation-delay: 0.4s;
      }

      .scroll-indicator {
        position: fixed;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        color: var(--primary-purple);
        font-size: 1.5rem;
        animation: bounce 2s infinite;
      }
      @keyframes bounce {
        0%,
        20%,
        50%,
        80%,
        100% {
          transform: translateY(0);
        }
        40% {
          transform: translateY(-20px);
        }
        60% {
          transform: translateY(-10px);
        }
      }

      /* Ticket Card Styles */
      .ticket-card {
        width: 100%;
        height: 360px;
        scroll-snap-align: start;
        flex: 0 0 auto;
        perspective: 1000px;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        position: relative;
        background: white;
        z-index: 1;
        transition: all 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
      }

      .ticket-card:hover {
        transform: translateY(-10px) scale(1.03);
        box-shadow: 0 15px 30px rgba(138, 79, 255, 0.2);
      }

      .ticket-card-inner {
        position: relative;
        width: 100%;
        height: 100%;
        transition: transform 0.6s;
        transform-style: preserve-3d;
      }

      .ticket-card:hover .ticket-card-inner {
        transform: rotateY(180deg);
      }

      .ticket-card-front,
      .ticket-card-back {
        position: absolute;
        width: 100%;
        height: 100%;
        backface-visibility: hidden;
        -webkit-backface-visibility: hidden;
      }

      .ticket-card-back {
        transform: rotateY(180deg);
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
      }

      .ticket-card-back-content {
        padding: 15px;
        text-align: center;
      }

      .ticket-image {
        width: 100%;
        height: 230px;
        object-fit: cover;
        transition: transform 0.5s ease;
      }

      .ticket-card:hover .ticket-image {
        transform: scale(1.1);
      }

      .ticket-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 230px;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.7) 0%, rgba(0, 0, 0, 0) 100%);
      }

      .ticket-artist-badge {
        position: absolute;
        bottom: 0px;
        left: 0px;
        right: 0;
        z-index: 2;
        background: linear-gradient(135deg, #8a4fffad, #ff6600b7);
        color: white;
        padding: 4px 10px;
        border-radius: 0px;
        font-size: 0.8rem;
        font-weight: 600;
      }

      .ticket-price-badge {
        position: absolute;
        top: 0;

        right: 0;
        left: 40%;
        background: linear-gradient(135deg, #8a4fffad, #ff6600b7);
        color: white;
        padding: 6px 0;
        padding-left: 10px;
        border-radius: 0 0 0 30px;
        font-size: 0.79rem;

        /* Perubahan di sini */
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;

        clip-path: polygon(15% 100%, 100% 100%, 100% 0, 0 0);
      }

      .ticket-date-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 8px;
        border-radius: 8px;
        text-align: center;
        width: 50px;
        z-index: 2;
      }

      .ticket-date-badge .day {
        font-size: 1.2rem;
        font-weight: bold;
        display: block;
        line-height: 1;
      }

      .ticket-date-badge .month {
        font-size: 0.7rem;
        text-transform: uppercase;
        display: block;
        line-height: 1;
      }

      .ticket-body {
        padding: 8px 12px 12px;
        height: calc(100% - 230px);
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
      }

      .ticket-title {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 1px;
        color: #333;
        display: -webkit-box;
        -webkit-line-clamp: 1; /* Batasi ke 2 baris */
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        min-height: 1.4em; /* Tinggi untuk 2 baris (1.2em per baris) */
        line-height: 1.2em;
      }

      .ticket-meta {
        margin-top: auto;
        font-size: 0.8rem;
        color: #666;
        display: flex;
        align-items: center;
        gap: 8px;
      }

      .ticket-meta i {
        color: var(--primary-purple);
        font-size: 1rem;
      }
      .ticket-meta span {
        display: -webkit-box;
        -webkit-line-clamp: 1; /* Batasi ke 2 baris */
        -webkit-box-orient: vertical;
        overflow: hidden;
        margin-top: auto;
        text-overflow: ellipsis;
        min-height: 1.4em; /* Tinggi untuk 2 baris */
        line-height: 1.2em;
      }

      .ticket-type {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 5px;
        font-size: 0.8rem;
        font-weight: 600;
        margin: 4px 8px 10px 0; /* hanya tambahkan jarak antar item */
        border-radius: 16px;
      }

      .ticket-type.regular {
        background: linear-gradient(135deg, #eae6ff, #d2c7ff); /* ungu muda ke lavender */
        color: #5a3dad; /* ungu solid */
        box-shadow: 0 4px 8px rgba(154, 123, 255, 0.4), /* ungu terang */ 0 8px 16px rgba(90, 61, 173, 0.3), /* ungu gelap */ inset 0 0 10px rgba(210, 199, 255, 0.3); /* glow dalam lavender */
      }

      .ticket-type.vip {
        background: linear-gradient(135deg, #ffeabf, #ffd480); /* emas pastel */
        color: #a16600; /* emas gelap */
        box-shadow: 0 4px 8px rgba(255, 205, 102, 0.5), /* oranye muda */ 0 8px 16px rgba(161, 102, 0, 0.35), /* coklat emas gelap */ inset 0 0 10px rgba(255, 235, 160, 0.3); /* glow dalam kuning lembut */
      }

      .ticket-type.platinum {
        background: linear-gradient(135deg, #b36bff, #ff6600b7);
        color: #ffffff;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
        box-shadow: 0 4px 8px rgba(179, 107, 255, 0.5), 0 8px 16px rgba(255, 102, 0, 0.4), inset 0 0 10px rgba(255, 255, 255, 0.2);
      }

      .ticket-status {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 5px;
        font-size: 0.8rem;
        font-weight: 600;
      }

      .ticket-status.used {
        background: rgba(40, 167, 69, 0.1);
        color: #28a745;
      }

      .ticket-status.unused {
        background: rgba(23, 162, 184, 0.1);
        color: #17a2b8;
      }

      .ticket-status.expired {
        background: rgba(220, 53, 69, 0.1);
        color: #dc3545;
      }

      .btn-ticket-action {
        background: linear-gradient(135deg, #8a4fff 0%, #5e2de0 100%);
        color: white;
        border: none;
        padding: 6px 20px;
        border-radius: 30px;
        font-weight: 500;
        transition: all 0.3s ease;
        margin-top: 10px;
        font-size: 0.9rem;
      }

      .btn-ticket-action:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(138, 79, 255, 0.4);
      }

      /* Profile Page Specific Styles */
      .profile-header {
        background: linear-gradient(135deg, rgba(138, 79, 255, 0.1) 0%, rgba(255, 102, 0, 0.1) 100%);
        border-radius: 15px;
        padding: 30px;
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
      }

      .profile-header::before {
        content: "";
        position: absolute;
        top: -50px;
        right: -50px;
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(138, 79, 255, 0.1) 0%, transparent 70%);
        border-radius: 50%;
      }

      .profile-header::after {
        content: "";
        position: absolute;
        bottom: -30px;
        left: -30px;
        width: 150px;
        height: 150px;
        background: radial-gradient(circle, rgba(255, 102, 0, 0.1) 0%, transparent 70%);
        border-radius: 50%;
      }

      .profile-picture {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid white;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      }

      .profile-name {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 5px;
        color: #333;
      }

      .profile-email {
        color: #666;
        margin-bottom: 15px;
      }

      .profile-stats {
        display: flex;
        gap: 20px;
        margin-top: 20px;
      }

      .stat-item {
        text-align: center;
      }

      .stat-number {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary-purple);
      }

      .stat-label {
        font-size: 0.9rem;
        color: #666;
      }

      /* Profile Sections */
      .profile-section {
        background: white;
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 30px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        position: relative;
      }

      .section-title {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 20px;
        color: #333;
        position: relative;
        padding-bottom: 10px;
      }

      .section-title::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 3px;
        background: var(--gradient-purple);
        border-radius: 3px;
      }

      /* Edit Profile Form */
      .form-label {
        font-weight: 600;
        color: #555;
      }

      .form-control {
        border-radius: 10px;
        padding: 10px 15px;
        border: 1px solid #ddd;
        transition: all 0.3s ease;
      }

      .form-control:focus {
        border-color: var(--primary-purple);
        box-shadow: 0 0 0 0.2rem rgba(138, 79, 255, 0.1);
      }

      .btn-save {
        background: var(--gradient-purple);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 10px 25px;
        font-weight: 600;
        transition: all 0.3s ease;
      }

      .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(138, 79, 255, 0.3);
      }

      /* Favorite Genres */
      .genre-tag {
        display: inline-block;
        background: rgba(138, 79, 255, 0.1);
        color: var(--primary-purple);
        padding: 5px 15px;
        border-radius: 20px;
        margin-right: 10px;
        margin-bottom: 10px;
        font-size: 0.9rem;
        transition: all 0.3s ease;
      }

      .genre-tag:hover {
        background: var(--primary-purple);
        color: white;
        transform: translateY(-2px);
      }

      /* Edit Toggle Button */
      .edit-toggle {
        position: absolute;
        top: 25px;
        right: 25px;
        background: none;
        border: none;
        color: var(--primary-purple);
        font-size: 1.2rem;
        cursor: pointer;
        transition: all 0.3s ease;
        padding: 5px 10px;
        border-radius: 5px;
      }

      .edit-toggle:hover {
        transform: scale(1.1);
      }

      /* View Mode Styles */
      .view-mode {
        display: block;
      }

      .edit-mode {
        display: none;
      }

      .profile-section.editing .view-mode {
        display: none;
      }

      .profile-section.editing .edit-mode {
        display: block;
      }

      /* Password Toggle */
      .password-toggle {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #666;
      }

      .password-toggle:hover {
        color: var(--primary-purple);
      }

      .form-group {
        position: relative;
      }

      /* Edit Sections */
      .edit-section {
        position: relative;
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 10px;
        background: rgba(255, 255, 255, 0.8);
      }

      .edit-section-title {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 15px;
        color: var(--primary-purple);
        display: flex;
        justify-content: space-between;
        align-items: center;
      }

      .edit-section-toggle {
        background: none;
        border: none;
        color: var(--primary-purple);
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        padding: 5px 10px;
        border-radius: 5px;
      }

      .edit-section-toggle:hover {
        background: rgba(138, 79, 255, 0.1);
      }

      .edit-section-content {
        display: none;
      }

      .edit-section.editing .edit-section-content {
        display: block;
      }

      .edit-section.editing .view-mode {
        display: none;
      }

      /* All Concerts Grid Layout */
      .all-concerts-container {
        position: relative;
        width: 100%;
        margin: 20px 0;
      }

      .all-concerts-wrapper {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(224px, 1fr));
        gap: 20px;
        justify-content: center;
      }

      /* Marquee for genre text */
      .marquee-container {
        overflow: hidden;
        white-space: nowrap;
        position: relative;
        width: 100%;
      }

      .marquee-text {
        display: inline-block;
        padding-left: 100%;
        animation: marquee 15s linear infinite;
        white-space: nowrap;
      }

      @keyframes marquee {
        0% {
          transform: translateX(0);
        }
        100% {
          transform: translateX(-100%);
        }
      }

      /* Hentikan animasi saat hover dan tampilkan tooltip */
      .ticket-card:hover .marquee-text {
        animation-play-state: paused;
        position: relative;
      }
      .ticket-card:hover .marquee-text::after {
        content: attr(data-genre);
        position: absolute;
        left: 0;
        top: 100%;
        background: rgba(0, 0, 0, 0.8);
        color: white;
        padding: 5px;
        border-radius: 4px;
        font-size: 0.7rem;
        white-space: normal;
        width: max-content;
        max-width: 200px;
        z-index: 10;
      }

      /* Responsive adjustments */
      @media (max-width: 1200px) {
        .all-concerts-wrapper {
          grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        }
      }

      @media (max-width: 992px) {
        .all-concerts-wrapper {
          grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        }
      }

      @media (max-width: 768px) {
        .ticket-card {
          height: 380px;
        }

        .ticket-image {
          height: 180px;
        }

        .ticket-body {
          height: calc(100% - 180px);
        }

        .profile-header {
          text-align: center;
        }

        .profile-stats {
          justify-content: center;
        }

        .profile-picture {
          margin: 0 auto 15px;
        }
      }

      @media (max-width: 576px) {
        .ticket-card {
          height: 360px;
        }

        .ticket-image {
          height: 160px;
        }

        .ticket-body {
          height: calc(100% - 160px);
        }

        .all-concerts-wrapper {
          grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
        }
      }

      /* Footer Styles */
      .footer-link {
        transition: var(--transition);
        display: inline-block;
      }

      .footer-link:hover {
        color: var(--primary-purple) !important;
        transform: translateX(5px);
      }
      /* Wave Background - Fixed Version */
      .wave-bg-footer {
        background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" preserveAspectRatio="none"><path fill="%238a4fff" fill-opacity="0.05" d="M0,192L48,197.3C96,203,192,213,288,229.3C384,245,480,267,576,250.7C672,235,768,181,864,181.3C960,181,1056,235,1152,234.7C1248,235,1344,181,1392,154.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
        background-repeat: no-repeat;
        background-position: bottom center;
        background-size: cover;
        height: 100%;
      }
      /* Social icons */
      .social-icon {
        transition: var(--transition);
        cursor: pointer;
      }

      .social-icon:hover {
        transform: scale(1.2) translateY(-3px);
        color: var(--primary-purple) !important;
      }

      /* Smooth scrolling */
      html {
        scroll-behavior: smooth;
      }

      /* Enhanced Pagination Styles */
      .pagination {
        --bs-pagination-color: #8a4fff;
        --bs-pagination-hover-color: #5e2de0;
        --bs-pagination-focus-color: #5e2de0;
        --bs-pagination-active-bg: #8a4fff;
        --bs-pagination-active-border-color: #8a4fff;
        gap: 8px;
      }

      .pagination .page-link {
        border-radius: 8px;
        margin: 0;
        min-width: 40px;
        text-align: center;
        border: 1px solid rgba(138, 79, 255, 0.2);
        box-shadow: 0 2px 5px rgba(138, 79, 255, 0.1);
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 40px;
      }

      .pagination .page-link:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(138, 79, 255, 0.2);
      }

      .pagination .page-item.active .page-link {
        background: var(--gradient-purple);
        border: none;
        color: white;
        font-weight: 600;
        box-shadow: 0 4px 10px rgba(138, 79, 255, 0.3);
      }

      .pagination .page-item.disabled .page-link {
        opacity: 0.5;
        pointer-events: none;
      }

      .pagination .page-item:not(.active):not(.disabled) .page-link {
        background: rgba(138, 79, 255, 0.05);
      }

      /* Arrow buttons */
      .pagination .page-item:first-child .page-link,
      .pagination .page-item:last-child .page-link {
        padding: 0 15px;
        font-weight: bold;
        background: rgba(138, 79, 255, 0.1);
      }

      .pagination .page-item:first-child .page-link:hover,
      .pagination .page-item:last-child .page-link:hover {
        background: rgba(138, 79, 255, 0.2);
      }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-white sticky-top shadow-sm py-1" id="mainNavbar">
      <div class="container">
        <button class="navbar-toggler order-first me-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <a href="../public/index.html" class="navbar-brand fw-bold order-lg-1 mx-auto mx-lg-0 me-lg-4" style="font-size: 1.6rem"> <span style="color: #8a4fff">Concert</span><span style="color: #ff6600">Tix</span> </a>
        <a href="../public/index.html" class="navbar-brand fw-bold order-lg-1 mx-auto mx-lg-0 me-lg-4" style="font-size: 1.6rem">
          <span class="ms-3 d-none d-lg-inline" style="font-size: 1.4rem; color: #7a3fef">Home Page</span>
        </a>

        <div class="order-lg-2 flex-grow-1 mx-2 mx-lg-0">
          <form class="w-100 position-relative" role="search" id="searchForm">
            <div class="input-group" style="border-radius: 50px; border: 2px solid #8a4fff; overflow: hidden; transition: all 0.3s ease">
              <input class="form-control border-0 py-2 shadow-none" type="search" placeholder="Search Concert..." aria-label="Search" id="searchInput" style="box-shadow: none !important" />
              <button type="submit" class="btn btn-purple-gradient d-none d-md-block" style="border-radius: 0 50px 50px 0; padding: 0.5rem 1rem">
                <span>
                  <i class="bi bi-search text-purple"> Search</i>
                </span>
              </button>
            </div>
          </form>
        </div>

        <div class="d-flex align-items-center gap-2 ms-lg-3 order-lg-3">
          <a href="../user/cart/index.html" class="btn btn-sm btn-outline-secondary d-none d-md-flex align-items-center" style="border-radius: 50px; padding: 0.5rem 0.9rem">
            <i class="bi bi-cart2"></i>
            <span class="ms-1 d-none d-lg-inline">Cart</span>
          </a>
          <a href="../user/profile.php" class="btn btn-sm btn-outline-secondary d-none d-md-flex align-items-center" style="border-radius: 50px; padding: 0.5rem 0.9rem">
            <i class="bi bi-person"></i>
            <span class="ms-1 d-none d-lg-inline">Profile</span>
          </a>
          <a href="../auth/login.html" class="btn btn-sm btn-purple-gradient d-none d-md-inline-flex align-items-center social-float" style="border-radius: 50px; padding: 0.5rem 1rem"> <i class="bi bi-box-arrow-in-right me-1"></i> Login </a>
          <a href="../auth/signup.html" class="btn btn-sm btn-purple-gradient d-none d-md-inline-flex align-items-center pulse-animation float-animation" style="border-radius: 50px; padding: 0.5rem 1rem">
            <i class="bi bi-person-plus me-1"></i> Sign Up
          </a>
        </div>
      </div>
    </nav>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
      <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title fw-bold" id="sidebarMenuLabel"><span style="color: #8a4fff">Concert</span><span style="color: #ff6600">Tix</span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="../public/index.html" class="nav-link active d-flex align-items-center py-2"> <i class="bi bi-house-door me-3 fs-5" style="color: #8a4fff"></i> Home Page </a>
          </li>
          <li class="nav-item">
            <a href="../user/profile.php" class="nav-link d-flex align-items-center py-2"> <i class="bi bi-person me-3 fs-5" style="color: #8a4fff"></i> Profile </a>
          </li>
          <li class="nav-item">
            <a href="../user/cart/index.html" class="nav-link d-flex align-items-center py-2"> <i class="bi bi-cart2 me-3 fs-5" style="color: #8a4fff"></i> Cart </a>
          </li>
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center py-2" href="../public/index.php#all-concerts-section" data-bs-dismiss="offcanvas"> <i class="bi bi-ticket-perforated me-3 fs-5" style="color: #8a4fff"></i> Concert </a>
          </li>
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center py-2" href="../public/events/index.php"> <i class="bi bi-music-note-list me-3 fs-5" style="color: #8a4fff"></i> Genre </a>
          </li>
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center py-2" href="../public/about.html"> <i class="bi bi-info-circle me-3 fs-5" style="color: #8a4fff"></i> About Us </a>
          </li>
        </ul>

        <hr class="my-3 mx-3" />

        <div class="px-3">
          <a href="../auth/login.html" class="btn btn-outline-purple w-100 mb-2 d-flex align-items-center justify-content-center" style="border-radius: 50px; padding: 0.5rem 1rem"> <i class="bi bi-box-arrow-in-right me-2"></i> Login </a>

          <a href="../auth/signup.html" class="btn btn-purple-gradient w-100 d-flex align-items-center justify-content-center pulse-animation float-animation" style="border-radius: 50px; padding: 0.5rem 1rem">
            <i class="bi bi-person-plus me-2"></i> Sign Up
          </a>
        </div>

        <hr class="my-3 mx-3" />

        <div class="px-3">
          <h6 class="text-muted mb-3">Follow Us</h6>
          <div class="social-links d-flex justify-content-center gap-4">
            <a href="https://www.facebook.com/groups/3288439241475430/" class="text-decoration-none" style="color: #8a4fff">
              <i class="bi bi-facebook fs-4"></i>
            </a>
            <a href="https://www.instagram.com/xtoph.y?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" class="text-decoration-none" style="color: #8a4fff">
              <i class="bi bi-instagram fs-4"></i>
            </a>
            <a href="https://x.com/home" class="text-decoration-none" style="color: #8a4fff">
              <i class="bi bi-twitter-x fs-4"></i>
            </a>
            <a href="https://www.youtube.com/@xant_san" class="text-decoration-none" style="color: #8a4fff">
              <i class="bi bi-youtube fs-4"></i>
            </a>
          </div>
        </div>
      </div>
      </div>
    </nav>

    <div class="container py-5">
      <div class="profile-header">
        <div class="row align-items-center">
          <div class="col-md-2 text-center text-md-start">
            <img src="<?php echo htmlspecialchars($userData['ProfilePictureURL']); ?>" alt="Profile Picture" class="profile-picture" id="profilePicture" />
          </div>
          <div class="col-md-6 text-center text-md-start mt-3 mt-md-0">
            <h1 class="profile-name" id="displayName"><?php echo htmlspecialchars($userData['FullName']); ?></h1>
            <p class="profile-email" id="displayEmail"><?php echo htmlspecialchars($userData['Email']); ?></p>
            <div class="d-flex flex-wrap" id="displayGenres">
              <?php echo $genreTagsHtml; ?>
            </div>
          </div>
          <div class="col-md-4 mt-4 mt-md-0">
            <div class="profile-stats">
              <div class="stat-item">
                <div class="stat-number"><?php echo $totalConcerts; ?></div>
                <div class="stat-label">Concerts</div>
              </div>
              <div class="stat-item">
                <div class="stat-number"><?php echo $totalVipTickets; ?></div>
                <div class="stat-label">VIP</div>
              </div>
              <div class="stat-item">
                <div class="stat-number"><?php echo $totalPremiumTickets; ?></div>
                <div class="stat-label">Premium</div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="edit-section" id="personalInfoSection">
        <div class="edit-section-title">
          <span>Personal Information</span>
          <button class="edit-section-toggle" id="personalInfoToggle"><i class="bi bi-pencil-fill me-2"></i> Edit</button>
        </div>

        <div class="view-mode">
          <div class="row">
            <div class="col-md-6">
              <p><strong>Full Name:</strong> <span id="viewFullName"><?php echo htmlspecialchars($userData['FullName']); ?></span></p>
              <p><strong>Email:</strong> <span id="viewEmail"><?php echo htmlspecialchars($userData['Email']); ?></span></p>
            </div>
            <div class="col-md-6">
              <p><strong>Profile Photo:</strong> <span id="viewPhoto">
                <?php if (!empty($userData['ProfilePictureURL']) && $userData['ProfilePictureURL'] !== 'https://randomuser.me/api/portraits/men/75.jpg') : ?>
                    <?php echo htmlspecialchars(basename($userData['ProfilePictureURL'])); ?>
                <?php else : ?>
                    No custom photo
                <?php endif; ?>
              </span></p>
            </div>
          </div>
        </div>

        <div class="edit-section-content">
          <form id="personalInfoForm">
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="editFullName" class="form-label">Full Name</label>
                  <input type="text" class="form-control" id="editFullName" name="fullName" value="<?php echo htmlspecialchars($userData['FullName']); ?>" />
                </div>

                <div class="mb-3">
                  <label for="editEmail" class="form-label">Email</label>
                  <input type="email" class="form-control" id="editEmail" name="email" value="<?php echo htmlspecialchars($userData['Email']); ?>" />
                </div>
              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label for="editProfilePicture" class="form-label">Profile Photo</label>
                  <input type="file" class="form-control" id="editProfilePicture" name="profilePicture" accept="image/*" />
                  <div class="form-text">Max size 2MB. Format: JPG, PNG.</div>
                </div>
                <?php if (!empty($userData['ProfilePictureURL']) && $userData['ProfilePictureURL'] !== 'https://randomuser.me/api/portraits/men/75.jpg') : ?>
                    <div class="mt-2">
                        <img src="<?php echo htmlspecialchars($userData['ProfilePictureURL']); ?>" alt="Current Profile" class="img-thumbnail" style="max-width: 100px; max-height: 100px;">
                        <small class="text-muted ms-2">Current photo</small>
                    </div>
                <?php endif; ?>
              </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-3">
              <button type="button" class="btn btn-outline-secondary" id="cancelPersonalInfo">Cancel</button>
              <button type="submit" class="btn btn-save"><i class="bi bi-save me-2"></i> Save</button>
            </div>
          </form>
        </div>
      </div>

      <div class="edit-section" id="passwordSection">
        <div class="edit-section-title">
          <span>Password</span>
          <button class="edit-section-toggle" id="passwordToggle"><i class="bi bi-pencil-fill me-2"></i> Edit</button>
        </div>

        <div class="view-mode">
          <p><strong>Password:</strong> ********</p>
        </div>

        <div class="edit-section-content">
          <form id="passwordForm">
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="currentPassword" class="form-label">Current Password</label>
                  <div class="form-group">
                    <input type="password" class="form-control" id="currentPassword" name="currentPassword" placeholder="Enter current password" />
                    <i class="bi bi-eye-fill password-toggle toggleCurrentPassword"></i>
                  </div>
                </div>

                <div class="mb-3">
                  <label for="newPassword" class="form-label">New Password</label>
                  <div class="form-group">
                    <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Enter new password" />
                    <i class="bi bi-eye-fill password-toggle toggleNewPassword"></i>
                  </div>
                </div>

                <div class="mb-3">
                  <label for="confirmNewPassword" class="form-label">Confirm New Password</label>
                  <div class="form-group">
                    <input type="password" class="form-control" id="confirmNewPassword" name="confirmNewPassword" placeholder="Confirm new password" />
                    <i class="bi bi-eye-fill password-toggle toggleConfirmNewPassword"></i>
                  </div>
                </div>
              </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-3">
              <button type="button" class="btn btn-outline-secondary" id="cancelPassword">Cancel</button>
              <button type="submit" class="btn btn-save"><i class="bi bi-save me-2"></i> Save</button>
            </div>
          </form>
        </div>
      </div>

      <div class="edit-section" id="genresSection">
        <div class="edit-section-title">
          <span>Favorite Genres</span>
          <button class="edit-section-toggle" id="genresToggle"><i class="bi bi-pencil-fill me-2"></i> Edit</button>
        </div>

        <div class="view-mode">
          <div id="viewGenres">
            <?php echo $genreTagsHtml; ?>
          </div>
        </div>

        <div class="edit-section-content">
          <form id="genresForm">
            <div class="mb-3">
              <label class="form-label">Select Your Favorite Genres</label>
              <div class="d-flex flex-wrap" id="editGenresContainer">
                <?php echo $editGenresHtml; ?>
              </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-3">
              <button type="button" class="btn btn-outline-secondary" id="cancelGenres">Cancel</button>
              <button type="submit" class="btn btn-save"><i class="bi bi-save me-2"></i> Save</button>
            </div>
          </form>
        </div>
      </div>

      <div class="profile-section">
        <h2 class="section-title">My Ticket History</h2>

        <div class="tab-content" id="ticketTabsContent">
          <div class="all-concerts-container">
            <div class="all-concerts-wrapper">
              </div>

            <div class="d-flex justify-content-center mt-4">
              <nav aria-label="Ticket pagination">
                <ul class="pagination" id="ticketPagination">
                  </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>

    <footer class="bg-light py-5 position-relative overflow-hidden">
      <div class="position-absolute bottom-0 start-0 w-100 h-100" style="z-index: 0; overflow: hidden">
        <div class="position-absolute bottom-0 start-0 w-100 h-100 wave-bg-footer"></div>
      </div>

      <div class="container position-relative" style="z-index: 1">
        <div class="row g-4">
          <div class="col-lg-4 mb-4">
            <div class="footer-brand">
              <h3 class="fw-bold mb-3" style="background: linear-gradient(90deg, #8a4fff, #ff6600); -webkit-background-clip: text; background-clip: text; color: transparent">Concert<span style="color: #ff6600">Tix</span></h3>
              <p class="text-muted mb-4">The easiest way to buy tickets for your favorite concerts and events worldwide.</p>
              <div class="d-flex gap-3 social-icons">
                <a
                  href="https://www.facebook.com/groups/3288439241475430/"
                  class="social-icon d-flex align-items-center justify-content-center rounded-circle"
                  style="width: 40px; height: 40px; background: rgba(138, 79, 255, 0.1); transition: all 0.3s ease"
                >
                  <i class="bi bi-facebook text-purple"></i>
                </a>
                <a
                  href="https://www.instagram.com/xtoph.y?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="
                  class="social-icon d-flex align-items-center justify-content-center rounded-circle"
                  style="width: 40px; height: 40px; background: rgba(138, 79, 255, 0.1); transition: all 0.3s ease"
                >
                  <i class="bi bi-instagram text-purple"></i>
                </a>
                <a href="https://x.com/home" class="social-icon d-flex align-items-center justify-content-center rounded-circle" style="width: 40px; height: 40px; background: rgba(138, 79, 255, 0.1); transition: all 0.3s ease">
                  <i class="bi bi-twitter-x text-purple"></i>
                </a>
                <a
                  href="https://www.youtube.com/@xant_san"
                  class="social-icon d-flex align-items-center justify-content-center rounded-circle"
                  style="width: 40px; height: 40px; background: rgba(138, 79, 255, 0.1); transition: all 0.3s ease"
                >
                  <i class="bi bi-youtube text-purple"></i>
                </a>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 mb-4">
            <div class="row g-4">
              <div class="col-sm-6">
                <h6 class="fw-bold mb-3 text-uppercase" style="color: #8a4fff">Company</h6>
                <ul class="list-unstyled">
                  <li class="mb-2">
                    <a href="../public/about.html" class="footer-link text-muted d-flex align-items-center" style="text-decoration: none; transition: all 0.3s ease">
                      <i class="bi bi-chevron-right me-2" style="color: #8a4fff"></i> About Us
                    </a>
                  </li>
                  <li class="mb-2">
                    <a href="../lost/404_page.html" class="footer-link text-muted d-flex align-items-center" style="text-decoration: none; transition: all 0.3s ease">
                      <i class="bi bi-chevron-right me-2" style="color: #8a4fff"></i> Careers
                    </a>
                  </li>
                  <li class="mb-2">
                    <a href="https://api.whatsapp.com/send?phone=6285156473714&text=Hi+Sir+Admin+ConcertTix" class="footer-link text-muted d-flex align-items-center" style="text-decoration: none; transition: all 0.3s ease">
                      <i class="bi bi-chevron-right me-2" style="color: #8a4fff"></i> Contact Us
                    </a>
                  </li>
                  <li class="mb-2">
                    <a href="../public/privacy_policy.html" class="footer-link text-muted d-flex align-items-center" style="text-decoration: none; transition: all 0.3s ease">
                      <i class="bi bi-chevron-right me-2" style="color: #8a4fff"></i> Privacy Policy
                    </a>
                  </li>
                  <li>
                    <a href="../public/tems_of_service.html" class="footer-link text-muted d-flex align-items-center" style="text-decoration: none; transition: all 0.3s ease">
                      <i class="bi bi-chevron-right me-2" style="color: #8a4fff"></i> Terms of Service
                    </a>
                  </li>
                </ul>
              </div>

              <div class="col-sm-6">
                <h6 class="fw-bold mb-3 text-uppercase" style="color: #8a4fff">Support</h6>
                <ul class="list-unstyled">
                  <li class="mb-2">
                    <a href="../lost/404_page.html" class="footer-link text-muted d-flex align-items-center" style="text-decoration: none; transition: all 0.3s ease">
                      <i class="bi bi-chevron-right me-2" style="color: #8a4fff"></i> Help Center
                    </a>
                  </li>
                  <li class="mb-2">
                    <a href="../public/faqs.html" class="footer-link text-muted d-flex align-items-center" style="text-decoration: none; transition: all 0.3s ease"> <i class="bi bi-chevron-right me-2" style="color: #8a4fff"></i> FAQs </a>
                  </li>
                  <li class="mb-2">
                    <a href="../public/refund_policy.html" class="footer-link text-muted d-flex align-items-center" style="text-decoration: none; transition: all 0.3s ease">
                      <i class="bi bi-chevron-right me-2" style="color: #8a4fff"></i> Refund Policy
                    </a>
                  </li>
                  <li>
                    <a href="../lost/404_page.html" class="footer-link text-muted d-flex align-items-center" style="text-decoration: none; transition: all 0.3s ease">
                      <i class="bi bi-chevron-right me-2" style="color: #8a4fff"></i> Report an Issue
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 mb-4">
            <h6 class="fw-bold mb-3 text-uppercase" style="color: #8a4fff">Stay Updated</h6>
            <p class="text-muted mb-3">Subscribe to our newsletter for concert updates and exclusive offers.</p>

            <form class="mb-4">
              <div class="input-group mb-3">
                <input type="email" class="form-control" placeholder="Your email" style="border-right: 0; border-color: #8a4fff" />
                <button class="btn btn-purple-gradient" type="submit" style="border-left: 0">
                  <i class="bi bi-send-fill"></i>
                </button>
              </div>
            </form>

            <h6 class="fw-bold mb-3 text-uppercase" style="color: #8a4fff">Download Our App</h6>
            <div class="d-flex gap-2 app-download">
              <a href="../lost/404_page.html" class="hover-grow" style="transition: all 0.3s ease">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/3c/Download_on_the_App_Store_Badge.svg/1280px-Download_on_the_App_Store_Badge.svg.png" alt="App Store" class="img-fluid rounded" style="height: 40px" />
              </a>
              <a href="../lost/404_page.html" class="hover-grow" style="transition: all 0.3s ease">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/78/Google_Play_Store_badge_EN.svg/1280px-Google_Play_Store_badge_EN.svg.png" alt="Google Play" class="img-fluid rounded" style="height: 40px" />
              </a>
            </div>
          </div>
        </div>

        <hr class="my-4" style="border-color: rgba(138, 79, 255, 0.1)" />

        <div class="row">
          <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
            <p class="mb-0 text-muted small">© 2025 ConcertTix. All rights reserved.</p>
          </div>
          <div class="col-md-6 text-center text-md-end">
            <div class="d-flex justify-content-center justify-content-md-end gap-3">
              <a href="../public/privacy_policy.html" class="text-muted small" style="text-decoration: none">Privacy Policy</a>
              <a href="../public/tems_of_service.html" class="text-muted small" style="text-decoration: none">Terms of Service</a>
              <a href="../lost/404_page.html" class="text-muted small" style="text-decoration: none">Sitemap</a>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
      // Pagination variables (dummy, akan diganti dengan data dari DB)
      let currentPage = 1;
      const ticketsPerPage = 8;
      let ticketData = []; // Akan diisi dari API

      // Fungsi untuk mengambil data riwayat tiket dari database
      async function fetchTicketHistory() {
        try {
          // Ganti dengan endpoint PHP yang sebenarnya untuk mengambil riwayat tiket
          const response = await fetch('../user/get_ticket_history.php'); // Anda perlu membuat file ini
          if (!response.ok) {
            throw new Error('Network response was not ok: ' + response.statusText);
          }
          ticketData = await response.json(); // Asumsikan API mengembalikan array konser
          generateAllConcertsCards(currentPage); // Generate kartu setelah data dimuat
        } catch (error) {
          console.error('Error fetching ticket history:', error);
          // Tampilkan pesan error ke pengguna atau fallback ke data dummy
          const ticketHistorySection = document.getElementById('ticketTabsContent');
          if (ticketHistorySection) {
            ticketHistorySection.innerHTML = '<div class="alert alert-warning">Failed to load ticket history.</div>';
          }
          ticketData = []; // Kosongkan data jika ada error
          generateAllConcertsCards(currentPage); // Tetap panggil untuk menampilkan pesan "no tickets"
        }
      }

      // Fungsi untuk menghasilkan kartu konser untuk riwayat tiket
      function generateAllConcertsCards(page = 1) {
        const container = document.querySelector(".all-concerts-wrapper");
        const pagination = document.getElementById("ticketPagination");
        const ticketHistorySection = document.querySelector(".profile-section"); // Get the ticket history section

        if (!container || !pagination) return;

        // Clear existing content
        container.innerHTML = "";
        pagination.innerHTML = "";

        if (ticketData.length === 0) {
            container.innerHTML = '<div class="alert alert-info text-center w-100">No ticket history found.</div>';
            return;
        }

        // Calculate pagination
        const startIndex = (page - 1) * ticketsPerPage;
        const endIndex = startIndex + ticketsPerPage;
        const paginatedConcerts = ticketData.slice(startIndex, endIndex);
        const totalPages = Math.ceil(ticketData.length / ticketsPerPage);

        // Generate cards for current page
        paginatedConcerts.forEach((ticket) => { // Perhatikan, ini adalah "ticket" bukan "concert"
          const card = document.createElement("div");
          card.className = "ticket-card";
          card.innerHTML = `
          <div class="ticket-card-inner">
            <div class="ticket-card-front">
              <div class="position-relative overflow-hidden">
                <img src="${ticket.image}" class="ticket-image img-fluid" alt="${ticket.title}">
                <div class="ticket-overlay"></div>
                <div class="ticket-artist-badge">
                  <div class="marquee-container">
                    <span class="marquee-text" data-genre="${ticket.genre}">${ticket.genre}</span>
                  </div>
                </div>
                <div class="ticket-price-badge">
                  <span class="amount">${ticket.price}</span>
                </div>
                <div class="ticket-date-badge">
                  <span class="day">${ticket.date.day}</span>
                  <span class="month">${ticket.date.month}</span>
                </div>
              </div>
              <div class="ticket-body">
                <h5 class="ticket-title">${ticket.title}</h5>
                <div class="d-flex flex-wrap mb-2">
                  ${ticket.ticketTypes.map((type) => `<span class="ticket-type ${type.toLowerCase()}">${type}</span>`).join("")}
                </div>
                <div class="ticket-meta">
                  <span><i class="bi bi-geo-alt-fill"></i> ${ticket.venue}</span>
                </div>
              </div>
            </div>
            <div class="ticket-card-back">
              <div class="ticket-card-back-content">
                <h5>${ticket.title}</h5>
                <div class="card-details">
                  <p><i class="bi bi-calendar-event"></i> ${ticket.backDetails.date}</p>
                  <p><i class="bi bi-clock"></i> ${ticket.backDetails.time}</p>
                  <p><i class="bi bi-geo-alt"></i> ${ticket.venue}</p>
                </div>
                <a href="../user/tickets/detail_ticket.php?ticket_id=${ticket.id}" class="btn btn-ticket-action">
                  <i class="bi bi-ticket-perforated me-1"></i> ${ticket.backDetails.buttonText}
                </a>
              </div>
            </div>
          </div>
        `;
          container.appendChild(card);
        });

        // Generate pagination controls
        if (totalPages > 1) {
          // Previous button
          const prevLi = document.createElement("li");
          prevLi.className = `page-item ${page === 1 ? "disabled" : ""}`;
          prevLi.innerHTML = `
            <a class="page-link" href="#" aria-label="Previous">
              <i class="bi bi-chevron-left"></i> Prev
            </a>
          `;
          prevLi.addEventListener("click", (e) => {
            e.preventDefault();
            if (page > 1) {
              generateAllConcertsCards(page - 1);
              currentPage = page - 1;
              ticketHistorySection.scrollIntoView({ behavior: "smooth", block: "start" });
            }
          });
          pagination.appendChild(prevLi);

          // Page numbers - show first page, current page with neighbors, and last page
          const maxVisiblePages = 5;
          let startPage = Math.max(1, page - Math.floor(maxVisiblePages / 2));
          let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

          if (endPage - startPage + 1 < maxVisiblePages) {
            startPage = Math.max(1, endPage - maxVisiblePages + 1);
          }

          // First page
          if (startPage > 1) {
            const firstLi = document.createElement("li");
            firstLi.className = `page-item ${1 === page ? "active" : ""}`;
            firstLi.innerHTML = `<a class="page-link" href="#">1</a>`;
            firstLi.addEventListener("click", (e) => {
              e.preventDefault();
              generateAllConcertsCards(1);
              currentPage = 1;
              ticketHistorySection.scrollIntoView({ behavior: "smooth", block: "start" });
            });
            pagination.appendChild(firstLi);

            if (startPage > 2) {
              const ellipsisLi = document.createElement("li");
              ellipsisLi.className = "page-item disabled";
              ellipsisLi.innerHTML = `<span class="page-link">...</span>`;
              pagination.appendChild(ellipsisLi);
            }
          }

          // Middle pages
          for (let i = startPage; i <= endPage; i++) {
            const pageLi = document.createElement("li");
            pageLi.className = `page-item ${i === page ? "active" : ""}`;
            pageLi.innerHTML = `<a class="page-link" href="#">${i}</a>`;
            pageLi.addEventListener("click", (e) => {
              e.preventDefault();
              generateAllConcertsCards(i);
              currentPage = i;
              ticketHistorySection.scrollIntoView({ behavior: "smooth", block: "start" });
            });
            pagination.appendChild(pageLi);
          }

          // Last page
          if (endPage < totalPages) {
            if (endPage < totalPages - 1) {
              const ellipsisLi = document.createElement("li");
              ellipsisLi.className = "page-item disabled";
              ellipsisLi.innerHTML = `<span class="page-link">...</span>`;
              pagination.appendChild(ellipsisLi);
            }

            const lastLi = document.createElement("li");
            lastLi.className = `page-item ${totalPages === page ? "active" : ""}`;
            lastLi.innerHTML = `<a class="page-link" href="#">${totalPages}</a>`;
            lastLi.addEventListener("click", (e) => {
              e.preventDefault();
              generateAllConcertsCards(totalPages);
              currentPage = totalPages;
              ticketHistorySection.scrollIntoView({ behavior: "smooth", block: "start" });
            });
            pagination.appendChild(lastLi);
          }

          // Next button
          const nextLi = document.createElement("li");
          nextLi.className = `page-item ${page === totalPages ? "disabled" : ""}`;
          nextLi.innerHTML = `
            <a class="page-link" href="#" aria-label="Next">
              Next <i class="bi bi-chevron-right"></i>
            </a>
          `;
          nextLi.addEventListener("click", (e) => {
            e.preventDefault();
            if (page < totalPages) {
              generateAllConcertsCards(page + 1);
              currentPage = page + 1;
              ticketHistorySection.scrollIntoView({ behavior: "smooth", block: "start" });
            }
          });
          pagination.appendChild(nextLi);
        }
      }

      // Make navbar change on scroll
      window.addEventListener("scroll", function () {
        const navbar = document.querySelector(".navbar");
        if (window.scrollY > 50) {
          navbar.classList.add("scrolled");
        } else {
          navbar.classList.remove("scrolled");
        }
      });

      // Handle search form submission
      document.getElementById("searchForm")?.addEventListener("submit", function (e) {
        e.preventDefault();
        const query = document.getElementById("searchInput").value.trim();
        if (query) {
          window.location.href = `../public/events/index.php?q=${encodeURIComponent(query)}`; // Corrected path
        }
      });

      // Setup offcanvas functionality
      function setupOffcanvas() {
        const offcanvasElement = document.getElementById("sidebarMenu");
        if (offcanvasElement) {
          if (!bootstrap.Offcanvas.getInstance(offcanvasElement)) {
            new bootstrap.Offcanvas(offcanvasElement);
          }
        }
      }

      // Toggle password visibility
      document.querySelectorAll(".password-toggle").forEach((toggle) => {
        toggle.addEventListener("click", function () {
          const input = this.parentElement.querySelector("input");
          const type = input.getAttribute("type") === "password" ? "text" : "password";
          input.setAttribute("type", type);
          this.classList.toggle("bi-eye-fill");
          this.classList.toggle("bi-eye-slash-fill");
        });
      });

      // Edit section toggles
      document.querySelectorAll(".edit-section-toggle").forEach((toggle) => {
        toggle.addEventListener("click", function () {
          const section = this.closest(".edit-section");
          section.classList.add("editing");
        });
      });

      // Cancel buttons
      document.querySelectorAll('[id^="cancel"]').forEach((button) => {
        button.addEventListener("click", function () {
          const section = this.closest(".edit-section");
          section.classList.remove("editing");
          // Revert form values if cancelled (optional, for real app, fetch original data again)
          document.getElementById('editFullName').value = document.getElementById('viewFullName').textContent;
          document.getElementById('editEmail').value = document.getElementById('viewEmail').textContent;
          // For password, clear new password fields
          if (document.getElementById('currentPassword')) document.getElementById('currentPassword').value = '';
          if (document.getElementById('newPassword')) document.getElementById('newPassword').value = '';
          if (document.getElementById('confirmNewPassword')) document.getElementById('confirmNewPassword').value = '';

          // Revert genre checkboxes (perlu memuat ulang status dari userGenres)
          loadGenresToEditForm(); // Panggil ulang untuk mengembalikan status checkbox
        });
      });

      // Personal Info Form Submission
      document.getElementById("personalInfoForm").addEventListener("submit", async function (e) {
        e.preventDefault();
        const fullName = document.getElementById("editFullName").value;
        const email = document.getElementById("editEmail").value;
        const profilePictureFile = document.getElementById("editProfilePicture").files[0];

        const formData = new FormData();
        formData.append('action', 'update_profile');
        formData.append('fullName', fullName);
        formData.append('email', email);
        if (profilePictureFile) {
            formData.append('profilePicture', profilePictureFile);
        }

        try {
            const response = await fetch('../user/update_profile.php', { // Anda perlu membuat file ini
                method: 'POST',
                body: formData
            });

            if (!response.ok) {
                const errorText = await response.text();
                throw new Error(`Server Error: ${response.status} - ${errorText}`);
            }

            const data = await response.json();
            if (data.status === 'success') {
                document.getElementById("displayName").textContent = data.fullName;
                document.getElementById("displayEmail").textContent = data.email;
                document.getElementById("viewFullName").textContent = data.fullName;
                document.getElementById("viewEmail").textContent = data.email;
                if (data.profilePictureURL) {
                    document.getElementById("profilePicture").src = data.profilePictureURL;
                    document.getElementById("viewPhoto").textContent = data.profilePictureURL.split('/').pop();
                }
                document.getElementById("personalInfoSection").classList.remove("editing");
                alert("Personal information updated successfully!");
                location.reload(); // Muat ulang halaman untuk update sesi dan tampilan navbar
            } else {
                alert("Failed to update personal information: " + data.message);
            }
        } catch (error) {
            console.error('Error updating personal info:', error);
            alert("An error occurred: " + error.message);
        }
      });


      // Password Form Submission
      document.getElementById("passwordForm").addEventListener("submit", async function (e) {
        e.preventDefault();
        const currentPassword = document.getElementById("currentPassword").value;
        const newPassword = document.getElementById("newPassword").value;
        const confirmNewPassword = document.getElementById("confirmNewPassword").value;

        if (newPassword !== confirmNewPassword) {
            alert("New passwords do not match!");
            return;
        }

        const formData = new FormData();
        formData.append('action', 'update_password');
        formData.append('currentPassword', currentPassword);
        formData.append('newPassword', newPassword);

        try {
            const response = await fetch('../user/update_profile.php', { // Kirim ke file yang sama atau file terpisah
                method: 'POST',
                body: formData
            });

            if (!response.ok) {
                const errorText = await response.text();
                throw new Error(`Server Error: ${response.status} - ${errorText}`);
            }

            const data = await response.json();
            if (data.status === 'success') {
                document.getElementById("passwordSection").classList.remove("editing");
                alert("Password updated successfully!");
                // Clear password fields
                document.getElementById('currentPassword').value = '';
                document.getElementById('newPassword').value = '';
                document.getElementById('confirmNewPassword').value = '';
            } else {
                alert("Failed to update password: " + data.message);
            }
        } catch (error) {
            console.error('Error updating password:', error);
            alert("An error occurred: " + error.message);
        }
      });

      // Genres Form Submission
      document.getElementById("genresForm").addEventListener("submit", async function (e) {
        e.preventDefault();

        const selectedGenreIDs = [];
        document.querySelectorAll('#editGenresContainer input[type="checkbox"]:checked').forEach(checkbox => {
            selectedGenreIDs.push(checkbox.value);
        });

        const formData = new FormData();
        formData.append('action', 'update_genres');
        selectedGenreIDs.forEach(id => {
            formData.append('genres[]', id);
        });

        try {
            const response = await fetch('../user/update_profile.php', { // Kirim ke file yang sama atau file terpisah
                method: 'POST',
                body: formData
            });

            if (!response.ok) {
                const errorText = await response.text();
                throw new Error(`Server Error: ${response.status} - ${errorText}`);
            }

            const data = await response.json();
            if (data.status === 'success') {
                // Update tampilan view-mode
                const viewGenresContainer = document.getElementById("viewGenres");
                viewGenresContainer.innerHTML = ''; // Kosongkan dulu
                selectedGenreIDs.forEach(genreId => {
                    // Temukan nama genre dari semua genre yang tersedia (allAvailableGenres)
                    const genreName = document.querySelector(`#editGenresContainer input[value="${genreId}"] + label`).textContent;
                    const genreTag = document.createElement("span");
                    genreTag.className = "genre-tag";
                    genreTag.textContent = genreName;
                    viewGenresContainer.appendChild(genreTag);
                });

                document.getElementById("genresSection").classList.remove("editing");
                alert("Favorite genres updated successfully!");
            } else {
                alert("Failed to update favorite genres: " + data.message);
            }
        } catch (error) {
            console.error('Error updating genres:', error);
            alert("An error occurred: " + error.message);
        }
      });


      // Fungsi untuk memuat semua genre ke form edit
      async function loadGenresToEditForm() {
          try {
              // Fetch semua genre yang tersedia dari database
              const responseAllGenres = await fetch('../auth/get_genres.php');
              if (!responseAllGenres.ok) {
                  throw new Error('Network response for all genres was not ok: ' + responseAllGenres.statusText);
              }
              const allGenres = await responseAllGenres.json();

              // Fetch genre yang sudah dipilih oleh user
              const responseUserGenres = await fetch('../user/get_user_genres.php'); // Buat file ini
              if (!responseUserGenres.ok) {
                  throw new Error('Network response for user genres was not ok: ' + responseUserGenres.statusText);
              }
              const userSelectedGenres = await responseUserGenres.json();
              const userSelectedGenreIDs = userSelectedGenres.map(g => g.GenreID);

              const editGenresContainer = document.getElementById('editGenresContainer');
              if (editGenresContainer) { // Pastikan elemen ada
                editGenresContainer.innerHTML = ''; // Bersihkan konten yang ada

                allGenres.forEach(genre => {
                    const div = document.createElement('div');
                    div.className = 'form-check me-3 mb-2';
                    const isChecked = userSelectedGenreIDs.includes(genre.GenreID) ? 'checked' : '';
                    div.innerHTML = `
                        <input class="form-check-input" type="checkbox" id="editGenre${genre.GenreID}" name="genres[]" value="${genre.GenreID}" ${isChecked} />
                        <label class="form-check-label" for="editGenre${genre.GenreID}">${genre.genre}</label>
                    `;
                    editGenresContainer.appendChild(div);
                });
              }

          } catch (error) {
              console.error('Error loading genres for edit form:', error);
              const genresSection = document.getElementById('genresSection');
              if (genresSection) {
                  const errorDiv = document.createElement('div');
                  errorDiv.className = 'alert alert-warning mt-3';
                  errorDiv.textContent = 'Failed to load genre options for editing. (Error: ' + error.message + ')';
                  genresSection.querySelector('.edit-section-content')?.prepend(errorDiv);
              }
          }
      }


      // Initialize the page
      document.addEventListener("DOMContentLoaded", function () {
        // Panggil fungsi untuk memuat riwayat tiket
        fetchTicketHistory();
        setupOffcanvas();
        loadGenresToEditForm(); // Panggil ini untuk mengisi form edit genre
      });
    </script>
  </body>
</html>
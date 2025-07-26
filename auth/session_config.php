<?php
// session_config.php
if (session_status() == PHP_SESSION_NONE) { // Periksa jika sesi belum dimulai
    session_start(); // Mulai sesi jika belum dimulai
}
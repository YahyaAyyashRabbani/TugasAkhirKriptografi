<?php
include 'connect.php';
session_start();

// Jika user sudah login, redirect ke page.php
if (isset($_SESSION['username'])) {
    header("location: page.php");
    exit;
}

// Proses login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Query untuk mendapatkan data user berdasarkan username
    $stmt = $koneksi->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username); // Bind parameter untuk mencegah SQL Injection
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Cek apakah user ditemukan
    if ($user) {
        // Cek apakah password cocok
        if (password_verify($password, $user['password'])) {
            // Login berhasil
            $_SESSION['username'] = $username; // Simpan session username
            header("location: page.php");
            exit;
        } else {
            // Password salah
            echo "<script>alert('Password salah!'); window.location.href='login.php';</script>";
            exit;
        }
    } else {
        // Username tidak ditemukan
        echo "<script>alert('Username tidak ditemukan!'); window.location.href='login.php';</script>";
        exit;
    }
} else {
    // Jika user mengakses langsung tanpa POST, redirect ke login form
    header("location: login.php");
    exit;
}
?>

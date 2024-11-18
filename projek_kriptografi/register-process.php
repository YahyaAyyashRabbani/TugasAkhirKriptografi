<?php
include 'connect.php';

$id = ''; // Biarkan kosong jika diatur otomatis oleh database
$username = trim($_POST['username']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);

// Validasi input kosong
if (empty($username) || empty($email) || empty($password)) {
    echo "<script>alert('Semua field harus diisi!'); window.location.href='register-form.php';</script>";
    exit;
}

// Hash password menggunakan password_hash()
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert user ke database
$stmt = $koneksi->prepare("INSERT INTO users (user_id, username, email, password) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $id, $username, $email, $hashed_password);
$stmt->execute();

if ($stmt) {
    header("location: login.php");
} else {
    echo "Gagal menyimpan data: " . $koneksi->error;
}
?>

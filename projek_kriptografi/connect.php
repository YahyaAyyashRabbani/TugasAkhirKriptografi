<?php
$koneksi = new mysqli('localhost', 'root', '', 'db_cr');

// Cek koneksi
if ($koneksi->connect_error) {
    die('Koneksi gagal: ' . $koneksi->connect_error);
}
?>

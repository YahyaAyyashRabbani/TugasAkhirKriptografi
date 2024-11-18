<?php
if (isset($_POST['submit-btn'])) {
    include "connect.php";
    include "steganografi.php"; // Menambahkan file steganografi


    $id = trim($_POST['id']);
    $judul = trim($_POST['judul']);
    $owner = trim($_POST['owner']);

    if (empty($id) || empty($judul) || empty($owner) || empty($_FILES['image']['name'])) {
        die("Semua field harus diisi!");
    }

    $key = "kript";

    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fileName = trim($_FILES['image']['name']);
    $fileTmpName = $_FILES['image']['tmp_name'];
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

    $originalFileName = "image_" . $id . "." . $fileExtension;

    // Bersihkan nama file
    $originalFileName = preg_replace('/[^a-zA-Z0-9._-]/', '', $originalFileName);

    $uploadFilePath = $uploadDir . $originalFileName;

    if (move_uploaded_file($fileTmpName, $uploadFilePath)) {
        // Menambahkan watermark ke gambar
        $outputPath = "image_" . $id . ".png"; // Gambar hasil steganografi
        embedWatermark($uploadFilePath, $outputPath, $owner); // Owner sebagai watermark
    
        // Enkripsi nama file hasil watermarking
        $encryptedFileName = vigenere_encrypt($outputPath, $key);

        $query = mysqli_query($koneksi, "INSERT INTO deck (deck_id, judul, konten, owner) VALUES ('$id', '$judul', '$encryptedFileName', '$owner')");

        if ($query) {
            echo "File berhasil diunggah dan data disimpan.";
            header("Location: page.php");
            exit();
        } else {
            echo "Gagal menyimpan data ke database: " . mysqli_error($koneksi);
        }
    } else {
        echo "Gagal mengunggah file.";
    }
}

function vigenere_encrypt($data, $key) {
    $keyLength = strlen($key);
    $encrypted = '';

    for ($i = 0, $j = 0; $i < strlen($data); $i++, $j++) {
        if ($j == $keyLength) {
            $j = 0;
        }

        $encrypted .= chr(ord($data[$i]) ^ ord($key[$j]));
    }

    return $encrypted;
}

function vigenere_decrypt($data, $key) {
    return vigenere_encrypt($data, $key); // XOR bersifat reversible
}
?>


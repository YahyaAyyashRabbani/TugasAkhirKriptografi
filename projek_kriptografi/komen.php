<?php
include "connect.php";

// Fungsi untuk enkripsi Caesar Cipher
function caesar_cipher($text, $shift) {
    $result = '';
    for ($i = 0; $i < strlen($text); $i++) {
        $char = $text[$i];
        // Jika huruf besar
        if (ctype_upper($char)) {
            $result .= chr((ord($char) + $shift - 65) % 26 + 65);
        } 
        // Jika huruf kecil
        else if (ctype_lower($char)) {
            $result .= chr((ord($char) + $shift - 97) % 26 + 97);
        }
        else {
            $result .= $char; // Untuk karakter lain (seperti spasi, tanda baca)
        }
    }
    return $result;
}

// Fungsi untuk enkripsi AES
function aes_encrypt($text, $key) {
    $method = 'aes-128-cbc';
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($method)); // IV untuk AES
    $encrypted = openssl_encrypt($text, $method, $key, 0, $iv);
    return base64_encode($encrypted . '::' . $iv); // Simpan ciphertext dan IV
}


// Ambil data dari form
$komen = $_POST['komen'];
$deck_id = $_POST['deck_id'];  // Ambil deck_id dari form
$comment_key = "thisisaverysecretkey"; // Gantilah dengan kunci yang lebih aman untuk AES

// Pastikan komentar tidak kosong
if (isset($_POST['submit-komen']) && !empty($komen)) {
    // Enkripsi komentar menggunakan Caesar Cipher dengan kunci 12
    $caesar_encrypted_comment = caesar_cipher($komen, 12);

    // Enkripsi komentar menggunakan AES
    $aes_encrypted_comment = aes_encrypt($caesar_encrypted_comment, $comment_key);

    // Menyisipkan komentar terenkripsi ke dalam tabel komentar
    $query = mysqli_query($koneksi, "INSERT INTO komentar VALUES ('', '$aes_encrypted_comment')");

    if ($query) {
        // Jika komentar berhasil disimpan, arahkan kembali ke halaman lihat.php dengan deck_id
        echo "<script>window.location.href = 'lihat.php?id=$deck_id';</script>";
    } else {
        echo "Gagal menambahkan komentar: " . mysqli_error($koneksi);
    }
} else {
    echo "Komentar tidak boleh kosong!";
}
?>

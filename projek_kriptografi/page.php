
<?php
include 'connect.php';
session_start();
if (!isset($_SESSION['username'])) {
    echo "<script>alert('Anda harus login terlebih dahulu!'); window.location.href='login.php';</script>";
    exit;
}
$username = $_SESSION['username'];

// Fungsi untuk mendekripsi data menggunakan Vigenere Cipher
function vigenere_decrypt($data, $key) {
    $keyLength = strlen($key);
    $decrypted = '';

    for ($i = 0, $j = 0; $i < strlen($data); $i++, $j++) {
        if ($j == $keyLength) {
            $j = 0; // Reset key index jika melebihi panjang kunci
        }

        // Dekripsi setiap byte
        $decrypted .= chr(ord($data[$i]) ^ ord($key[$j]));
    }

    return $decrypted;
}

// Pastikan direktori 'temp/' ada
$tempDir = __DIR__ . 'temp/';
if (!is_dir($tempDir)) {
    mkdir($tempDir, 0777, true);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page</title>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid" style="margin-left : 80px">
    Hai, <?= htmlspecialchars($username); ?>
    <div class="collapse navbar-collapse" id="navbarSupportedContent" style="margin-right : 80px">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="page.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="add_deck.php">Add Deck</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<?php
$key = "kript"; // Gunakan kunci yang sama dengan yang digunakan untuk enkripsi nama file

$query = mysqli_query($koneksi, "SELECT * FROM deck ORDER BY deck_id ASC");
while ($data = mysqli_fetch_array($query)) {
    // Dekripsi nama file dari database
    $encryptedFileName = $data['konten'];
    $decryptedFileName = vigenere_decrypt($encryptedFileName, $key);

    // Path file terenkripsi
    $encryptedFilePath = 'uploads/' . $decryptedFileName;


    // Pastikan file ada sebelum diproses
    if (!file_exists($encryptedFilePath)) {
        echo "<p>File tidak ditemukan di path: $encryptedFilePath</p>";
        continue;
    }

    // Baca file terenkripsi
    $encryptedData = file_get_contents($encryptedFilePath);

    // Dekripsi file gambar
    $decryptedData = vigenere_decrypt($encryptedData, $key);

    // Simpan sementara file yang didekripsi
    $tempDecryptedFile = $tempDir . 'decrypted_' . basename($decryptedFileName);
    file_put_contents($tempDecryptedFile, $decryptedData);

    // Tampilkan gambar yang telah didekripsi
    ?>
    <div class="card shadow mb-3">
        <div class="row g-0">
            <div class="col-md-3">
                <img src="uploads/<?php echo basename($decryptedFileName); ?>" class="img-fluid rounded-start mx-auto d-block h-100" alt="...">
            </div>
            <div class="col-md-9">
                <div class="card-body">
                    <a href="lihat.php?id=<?php echo $data['deck_id']; ?>" class="text-link">
                        <h5 class="card-title"><?php echo htmlspecialchars($data['judul']); ?></h5>
                    </a>
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="card-text"><small class="text-muted"><?php echo htmlspecialchars($data['owner']) . ', '; ?></small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>
</body>
</html>
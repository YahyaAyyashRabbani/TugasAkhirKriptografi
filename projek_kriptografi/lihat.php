<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kabar Kuliner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="New folder/kabar-kuliner-favicon-white.png" />
</head>
<?php
include 'connect.php';
session_start();
if (!isset($_SESSION['username'])) {
    echo "<script>alert('Anda harus login terlebih dahulu!'); window.location.href='login.php';</script>";
    exit;
}
$username = $_SESSION['username'];

// Vigenère Decrypt Function
function vigenere_decrypt($data, $key) {
    $keyLength = strlen($key);
    $decrypted = '';

    for ($i = 0, $j = 0; $i < strlen($data); $i++, $j++) {
        if ($j == $keyLength) {
            $j = 0; // Reset key index if it exceeds key length
        }

        // Decrypt each byte
        $decrypted .= chr(ord($data[$i]) ^ ord($key[$j]));
    }

    return $decrypted;
}

// Caesar Cipher Decrypt Function (Shift by 12)
// Caesar Cipher Decrypt Function (Shift by 12)
function caesar_decrypt($data, $shift = 12) {
    $decrypted = '';
    foreach (str_split($data) as $char) {
        if (ctype_alpha($char)) {
            $ascii_offset = (ord($char) >= 65 && ord($char) <= 90) ? 65 : 97;
            $new_char = chr((ord($char) - $ascii_offset - $shift + 26) % 26 + $ascii_offset);
            $decrypted .= $new_char;
        } else {
            $decrypted .= $char;
        }
    }
    return $decrypted;
}



// AES Decrypt Function
// Fungsi untuk dekripsi AES
function aes_decrypt($encrypted_text, $key) {
    $method = 'aes-128-cbc';
    list($encrypted_data, $iv) = explode('::', base64_decode($encrypted_text), 2); // Pisahkan data dan IV
    $decrypted = openssl_decrypt($encrypted_data, $method, $key, 0, $iv);
    return $decrypted;
}


?>

<style>
    article {
        margin: 10% 10% 5% 10%;
        border : 3px #000000 solid;
        padding: 10px 30px;
        border-radius: 40px;
    }
    .comment {
        border: 1px solid #000000;
        float: left;
        border-radius: 5px;
        padding: 5px 30px;
        width: 100%; 
        overflow: hidden; 
    }
    .form-group input, .form-group textarea {
        border-radius: 12px;
    }
    form {
        background-color: #000000;
        color : white;
        border-radius: 10px;
        padding: 20px;
    }
</style>

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
$key = "kript";  // Encryption key for Vigenère
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM deck WHERE deck_id = $id;");
$data = mysqli_fetch_array($query);

$encryptedFileName = $data['konten'];
$decryptedFileName = vigenere_decrypt($encryptedFileName, $key);

?> 
<article class="article-card">
    <h2 style="text-align: center;"><?php echo $data['judul'];?></h2>
    <p class="card-text text-muted" style="text-align: center;"><?php echo $data['owner'];?></p>
    <div class="col-md-12 d-flex align-items-center justify-content-center">
        <img src="uploads/<?php echo basename($decryptedFileName); ?>" class="img-fluid rounded-start" style="height: 400px;" alt="...">
    </div>
</article>

<!-- Main Body -->
<section style="margin-bottom: 5%;">
    <div class="container">
        <div class="row">
            <div class="col-sm-5 col-md-6 col-12 pb-4">
                <h1>Comments</h1>
                <?php
                $query = mysqli_query($koneksi, "SELECT * FROM komentar");
                while ($data = mysqli_fetch_array($query)) {
                    // Decrypt comment
                    $decrypted_comment = aes_decrypt($data['komen'], 'thisisaverysecretkey');
                    $decrypted_comment = caesar_decrypt($decrypted_comment, 12);
                     // AES decryption
                ?>
                <div class="comment mt-4 text-justify float-left">
                    <br>
                    <p><?php echo $decrypted_comment; ?></p>
                </div>
                <?php } ?>
            </div>

            <!-- Formulir untuk mengirim komentar -->
            <div class="col-lg-4 col-md-5 col-sm-4 offset-md-1 offset-sm-1 col-12 mt-4">
                <form method="POST" action="komen.php">
                    <input type="hidden" name="deck_id" value="<?php echo $id; ?>"> <!-- Kirimkan deck_id ke komen.php -->
                    <div class="form-group">
                        <h4>Leave a comment</h4>
                        <label for="message" style="color: antiquewhite;">Message</label>
                        <textarea name="komen" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <input name="submit-komen" class="btn btn-secondary" type="submit" value="Post Comment" style="margin-top: 10px; text-align : center">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

</body>
</html>

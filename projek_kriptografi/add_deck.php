<?php
include 'connect.php';
session_start();
if (!isset($_SESSION['username'])) {
    // Jika session username tidak ada, arahkan ke login
    echo "<script>alert('Anda harus login terlebih dahulu!'); window.location.href='login.php';</script>";
    exit;
}
$username = $_SESSION['username'];
?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="shortcut icon" href="chat-right-quote.svg">
    
    <style> 
        .container-fluid{
        margin: 0 10% 0 10%;
        }
        .card{
            margin: 2% 10% 4% 10%;
        }
        .card-header{
            background-color: #000000;
            color: white;
        }
        .card-body{
            background-color: #F8F8FF;
        }
        .btn {
        background-color: #000000;
        color: white;
        transition: background-color 0.3s ease;
        }
    .btn:hover {
        background-color: #E5812B;
        color: white; 
        }
    </style>
    </head>
<body>
<?php
include 'connect.php';

$query = mysqli_query($koneksi, "SELECT MAX(deck_id) as max_id FROM deck");
$data = mysqli_fetch_array($query);
$id = $data['max_id'] +1;
?>
</body>
<main>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid" style="margin-left : 80px">
    Hai, <?= $username ?>
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

    <div class="card shadow" style="margin-top: 8%;">
        <h5 class="card-header">Tambah Deck</h5>
        <div class="card-body">

          <form action="sqlcode.php" method="post" enctype="multipart/form-data">

          <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group row p-2 g-col-6">
              <label for="inputauthor" class="col-sm-2 col-form-label">Judul</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputjudul" name="judul" placeholder="Silakan isi Judul">
              </div>
            </div>
            <div class="form-group row p-2 g-col-6">
                <label for="inputtahun" class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-10">
                <input class="form-control" type="file" id="formFile" name="image">
                </div>
            </div>
            <div class="form-group row p-2 g-col-6">
              <label for="inputauthor" class="col-sm-2 col-form-label">Owner</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputowner" name="owner" placeholder="Silakan isi pemilik deck">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12 d-flex flex-row-reverse bd-highlight">
                <button type="submit" value="submit" name="submit-btn" class="btn btn-submit" >Submit</button>
              </div>
            </div>
          </form>
        </div>
      </div>

</main>
</html>
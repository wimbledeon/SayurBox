<?php
session_start();

include "config.php";

if(isset($_SESSION['id'])){
    $id_user = $_SESSION['id'];
}

if(isset($_POST['kirim'])) {
    $nama=$_POST['nama'];
    $email=$_POST['email'];
    $subjek=$_POST['subjek'];
    $pesan=$_POST['pesan'];

    $hasil=mysqli_query($conn, "INSERT INTO tb_pesan SET nama_pengirim='$nama', email_pengirim='$email', subjek='$subjek', pesan='$pesan'");
    if($hasil){
        echo '<script>alert("Pesan berhasil terkirim")</script>';
    }
} 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <?php include 'title.php'; ?>

    <link rel="shortcut icon" type="image/png" href="images/favicon.png"/>

    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container">

    <div class=padding: 20px 20px 20px 20px;>
      <div class="row mb-4 mt-4">
        <div class="col-sm-8 mt-4">
        <img src="images/home-main.png" style="width: 100%;" />
          <p>Sayur Box memudahkan petani untuk menyalurkan sayuran ke seluruh Indonesia.</p>         
          </p>
        </div>
        <div class="col-sm-4">
          <h2 class="mt-4">Hubungi Kami</h2>
          <div class="card-body">
                <form method="post">
                    <div class="form-group">
                        <label for="nama">Nama Lengkap :</label>
                        <input name="nama" class="form-control" id="nama" type="text" aria-describedby="namaHelp" placeholder="Masukkan Nama Lengkap">
                    </div>
                    <div class="form-group">
                        <label for="email">Email :</label>
                        <input name="email" class="form-control" id="email" type="text" aria-describedby="emailHelp" placeholder="Masukkan Email">
                    </div>
                    <div class="form-group">
                        <label for="subjek">Subjek :</label>
                        <input name="subjek" class="form-control" id="subjek" type="text" aria-describedby="subjekHelp" placeholder="Masukkan Subjek">
                    </div>
                    <div class="form-group">
                        <label for="pesan">Pesan :</label>
                        <textarea name="pesan" class="form-control" id="pesan" type="text" aria-describedby="alamatHelp" placeholder="Masukkan Pesan" rows="4"></textarea>
                    </div>
                    <button name="kirim" class="btn btn-primary btn-block">Kirim</button>
                </form>
            </div>
        </div>
      </div>
    </div>

    </div>

    <?php include 'footer.php'; ?>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<?php
session_start();

include "config.php";

if(isset($_SESSION['id'])){
    $id_user = $_SESSION['id'];
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
        <?php

        if(isset($_GET['id'])){
            $id_transaksi = $_GET['id'];
        }

        ?>

        <h2 class="mb-3" style="margin-top: 4%;">Detail Transaction </h2>
        <h4 class="text-center">(ID #<?php echo $id_transaksi; ?>)</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card-body">
                    <div class="table-responsive text-center">
                        <table class="table table-bordered" id="dataTable" cellspacing="0" style="width: 80%; margin: 0 10% 0;">
                            <thead>
                                <tr>
                                    <th width="30%">Nama Sayur</th>
                                    <th width="15%">Kategori</th>
                                    <th width="15%">penerima</th>
									<th width="15%">Quantity</th>

                                    <th width="15%">Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if(isset($_GET['id'])){
                                    $total = 0;
                                    $sql=mysqli_query($conn,"SELECT * FROM tb_produk, tb_transaksi WHERE tb_produk.id_produk=tb_transaksi.id_produk AND id_transaksi='$id_transaksi'");
                                    while($data=mysqli_fetch_array($sql)){
                                ?>
                                <tr>
                                    <td><?php echo $data['nama_sayur']; ?></td>
                                    <td>
                                    <?php 
                                    $id_kategori = $data['id_kategori'];
                                    $kate=mysqli_query($conn,"SELECT * FROM tb_kategori WHERE id_kategori='$id_kategori'");
                                    $gori=mysqli_fetch_array($kate);
                                    echo $gori['nama_kategori']; 
                                    ?>
                                    </td>
                                    <td><?php echo $data['penerima']; ?></td>
									<td><?php echo $data['qty']; ?></td>
                                    <td><?php echo number_format($data['harga'] * $data['qty']); ?></td>
                                </tr>
                                <?php
                                    $total = $total + ($data["harga"] * $data["qty"]);
                                    }

                                ?>
                                <tr>
                                    <td colspan="4">Total</td>
                                    <td >Rp. <?php echo number_format($total, 2); ?></td>
                                </tr>
                                <?php
                                }
                                
                                ?>
                            </tbody>
                        </table>
                    </div>
               
                <p class="text-center">Dengan memasukkan 3 digit terakhir kode unik id transaksi (#<?php echo "$id_transaksi"; ?>) kemudian menunjukkan ke admin untuk menerima pembayaran :</p>
                <div class="col-lg-12 col-md-12 mb-4 text-center" style="width: 20%;margin-left: 40%; margin-right: 40%;">
                    <div class="card text-center">
                        <div class="card-body">
                        <?php
                        $total_first = substr($total, 0, (strlen($total)-3));
                        $kode_unik = substr($id_transaksi, (strlen($id_transaksi)-3));
                        $total_price = $total_first.$kode_unik;

                        ?>
                            <h5><b>Rp. <?php echo number_format($total_price); ?></b></h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 text-center">
                    <a style="width: 10%; margin-bottom: 5%;" class="btn btn-info text-center" href="my-transaction.php" >Back</a>
                </div>
            </div>
        </div>
        
    </div>

    <?php include 'footer.php'; ?>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>
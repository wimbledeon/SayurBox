<?php 

include('../config.php');

if(isset($_GET['hapus'])) {
    $id_produk=$_GET['hapus'];

    $hasil=mysqli_query($conn,"DELETE FROM tb_produk WHERE id_produk='$id_produk'");
    if($hasil){
        header("location:manage.php?page=produk");
    }
}

?>

<div class="container">

    <h2 class="mt-4 mb-3">Manage Produk</h2>
    <br>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">manage</a>
        </li>
        <li class="breadcrumb-item active"><?php echo $page;?></li>
    </ol>

    <div class="row">
        <div class="col-md-12">
            <div class="card-body">
                <a class="btn btn-primary" href="manage.php?tambah=tambah-produk"> Tambah Data </a>
                <br><br>
                <div class="table-responsive text-center">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="5%">No.</th>
                                <th width="10%">ID Sayuran</th>
                                <th>Nama Sayuran</th>
                                <th>Kategori</th>
                                <th>penerima</th>
                                <th>Harga (KG)</th>
                                <th>Image</th>
                                <th width="20%">&nbsp;Action&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql=mysqli_query($conn,"SELECT * FROM tb_produk");
                            $no=1;
                            while($data=mysqli_fetch_array($sql)){
                            ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $data['id_produk']; ?></td>
                                <td><?php echo $data['nama_sayur']; ?></td>
                                <td>
                                <?php 
                                $id_kategori = $data['id_kategori'];
                                $kate=mysqli_query($conn,"SELECT * FROM tb_kategori WHERE id_kategori='$id_kategori'");
                                $gori=mysqli_fetch_array($kate);
                                echo $gori['nama_kategori']; 
                                ?></td>
                                <td><?php echo $data['penerima']; ?></td>
                                <td><?php echo $data['harga']; ?></td>
                                <td><?php echo $data['image_sayur']; ?></td>
                                <td>
                                    <a class="btn btn-primary" href="manage.php?tambah=tambah-produk&id_produk=<?php echo $data['id_produk'];?>">
                                        <i class="glyphicon glyphicon-pencil"></i>Ubah
                                    </a>
                                    <a class="btn btn-danger" href="manage.php?page=produk&hapus=<?php echo $data['id_produk'];?>">
                                        <i class="glyphicon glyphicon-remove"></i>Hapus
                                    </a>
                                </td>
                            </tr>
                            <?php 
                            $no++;
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
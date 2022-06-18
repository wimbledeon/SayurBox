<?php

if(isset($_POST['tambah_produk'])) {
    $nama_sayur=$_POST['nama_sayur'];
    $id_kategori=$_POST['id_kategori'];
    $penerima=$_POST['penerima'];
    $harga=$_POST['harga'];
    $image_sayur = rand(1000,100000)."-".$_FILES['image_sayur']['name'];
    $image_loc = $_FILES['image_sayur']['tmp_name'];
    $folder="../images/sayur/";
    move_uploaded_file($image_loc,$folder.$image_sayur);

    $hasil=mysqli_query($conn,"INSERT INTO tb_produk SET nama_sayur='$nama_sayur', id_kategori='$id_kategori', penerima='$penerima', harga='$harga', image_sayur='$image_sayur'");
    if($hasil){
        header("location:manage.php?page=produk");
    }
}

if(isset($_GET['id_produk'])) {
    $id_produk=$_GET['id_produk'];

    $hasil=mysqli_query($conn,"SELECT * FROM tb_produk WHERE id_produk='$id_produk'");
    $c=mysqli_fetch_array($hasil);
    $nama_sayur=$c['nama_sayur'];
    $id_kategori=$c['id_kategori'];
    $penerima=$c['penerima'];
    $harga=$c['harga'];
    $gambar_sayur=$c['image_sayur'];
    
}

if(isset($_POST['edit_produk'])) {
    $nama_sayur=$_POST['nama_sayur'];
    $id_kategori=$_POST['id_kategori'];
    $penerima=$_POST['penerima'];
    $harga=$_POST['harga'];
    $image_sayur = rand(1000,100000)."-".$_FILES['image_sayur']['name'];
    $image_loc = $_FILES['image_sayur']['tmp_name'];
    $folder="../images/sayur/";
    move_uploaded_file($image_loc,$folder.$image_sayur);

    $hasil=mysqli_query($conn,"UPDATE tb_produk SET nama_sayur='$nama_sayur' ,id_kategori='$id_kategori', penerima='$penerima', harga='$harga', image_sayur='$image_sayur' WHERE id_produk='$id_produk'");
    if($hasil){
        header("location:manage.php?page=produk");
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

    <title>Website Cari Lawan</title>

    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container mb-4 mt-4">
        <h1 class="mt-4">New Product</h1>
        <div class="row">
            <div class="col-lg-8 mb-4">
                <hr/>
                <form id="contactForm" action="" method="post" enctype="multipart/form-data" novalidate>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Nama sayur : </label>
                            <input name="nama_sayur" type="text" class="form-control" id="name" value="<?php
                            if(isset($_GET['id_produk'])){
                                echo $nama_sayur;
                            } ?>">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Kategori : </label>
                            <select name="id_kategori" class="form-control" id="kategori">
                                <?php

                                $cat=mysqli_query($conn,"SELECT * FROM tb_kategori");

                                while($c=mysqli_fetch_array($cat)){
                                    $id_kategori = $c['id_kategori'];
                                    $nama_kategori = $c['nama_kategori'];
                                ?>
                                <option value="<?php echo $id_kategori;?>"><?php echo $nama_kategori;?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Nama penerima : </label>
                            <input name="penerima" type="text" class="form-control" id="name" value="<?php
                            if(isset($_GET['id_produk'])){
                                echo $penerima;
                            } ?>">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Harga : </label>
                            <input name="harga" type="text" class="form-control" id="name" value="<?php
                            if(isset($_GET['id_produk'])){
                                echo $harga;
                            } ?>">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Image sayur :</label>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <span class="btn btn-default btn-file">
                                        <input name="image_sayur" type="file" id="foto">
                                        <?php 
                                            if(isset($_GET['id_produk'])){
                                                 echo $gambar_sayur;
                                            }
                                        ?>
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div id="success"></div>
                    <?php if(isset($_GET['id_produk'])){
                        echo "<button name=\"edit_produk\" type=\"submit\" class=\"btn btn-primary\" id=\"edit\">Edit Product</button>";
                    }
                    else {
                        echo "<button name=\"tambah_produk\" type=\"submit\" class=\"btn btn-primary\" id=\"tambah\">Tambah Produk</button>";
                    } ?>
                    
                </form>
            </div>
        </div>
    </div>

</body>
</html>
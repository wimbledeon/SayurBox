<div class="row text-center">
	<?php

	include('config.php');

	if(isset($_GET['search_sayur'])){
		if($_GET['search_sayur']==""){
			$all=mysqli_query($conn,"SELECT * FROM tb_produk, tb_kategori WHERE tb_kategori.id_kategori=tb_produk.id_kategori ORDER BY id_produk ASC");
		}
		else{
			$query = $_GET['search_sayur'];
	        $all = mysqli_query($conn,"SELECT * FROM tb_produk, tb_kategori WHERE tb_kategori.id_kategori=tb_produk.id_kategori AND tb_kategori.nama_kategori='$query' ORDER BY id_produk ASC");
	        if(!mysqli_num_rows($all)>0){
	        	echo "<p class=\"text-center\" style=\"width:100%; margin-bottom: 40px;\">(TIDAK ADA KATEGORI YANG DIMAKSUD)</p>";
	        }
		}		
	}
	else{
		$all=mysqli_query($conn,"SELECT * FROM tb_produk, tb_kategori WHERE tb_kategori.id_kategori=tb_produk.id_kategori ORDER BY id_produk ASC");
	}



	while($c=mysqli_fetch_array($all)){
		$id_produk = $c['id_produk'];
		$nama_sayur = $c['nama_sayur'];
		$kategori = $c['nama_kategori'];
		$penerima = $c['penerima'];
		$harga = $c['harga'];
		$image_sayur = $c['image_sayur'];

	
	?>
	<div class="col-lg-3 col-md-6 mb-4">
	<form method="post" action="product.php?action=add&id_produk=<?php echo $c["id_produk"]; ?>">
		<div class="card" id="<?php echo $id_produk;?>">
			<img class="card-img-top" style="height: 350px;" src="images/sayur/<?php echo $image_sayur;?>" alt="<?php echo $image_sayur ?>" />
			<div class="card-body">
				<h4 class="card-title"><?php echo $nama_sayur;?></h4>
                <h6 class="my-3"><i><?php echo $kategori;?></i></h6>
				<p class="card-text">By : <?php echo $penerima;?><br/>
                Rp. <?php echo number_format($harga); ?></p><br/>
				<input type="text" name="quantity" class="form-control" value="1" />
			</div>
			<input type="hidden" name="hidden_name" value="<?php echo $nama_sayur; ?>" />
			<input type="hidden" name="hidden_kategory" value="<?php echo $kategori; ?>" />
			<input type="hidden" name="hidden_penerima" value="<?php echo $penerima; ?>" />
			<input type="hidden" name="hidden_price" value="<?php echo $harga; ?>" />
			
			<div class="card-footer">
				<?php
	            if(isset($_SESSION['id'])){
	            	echo "<button name=\"add_cart\" type=\"submit\" class=\"btn btn-success\" id=\"add\">Tambah ke Keranjang</button>";
	            }
	            else{
	                echo "<a href=\"\" onClick=\"onCartClick()\" class=\"btn btn-success\">Kirim</a>";
	            }
	            ?>
			</div>
		</div>
	</form>
	</div>
	<?php } ?>

	<script type="text/javascript">
	function onCartClick() {
	 
	  var confirmmessage = "Untuk melakukan transaksi anda harus login";
	  var go = "login.php";
	 
	  if (confirm(confirmmessage)) {
	      window.location = go;
	  }
	 
	}
	</script>
	
</div>
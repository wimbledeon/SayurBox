<?php

if(isset($_POST["add_cart"])){
	
	if(isset($_SESSION["shopping_cart"])){
		$item_array_id = array_column($_SESSION["shopping_cart"], "item_id");

		if(!in_array($_GET["id_produk"], $item_array_id)){
			$count = count($_SESSION["shopping_cart"]);
			$item_array = array(
				'item_id' => $_GET["id_produk"],
				'item_name' => $_POST["hidden_name"],
				'item_kategory' => $_POST["hidden_kategory"],
				'item_penerima' => $_POST["hidden_penerima"],
				'item_price' => $_POST["hidden_price"],
				'item_quantity'          =>     $_POST["quantity"]  

			);
			$_SESSION["shopping_cart"][$count] = $item_array;
		}
		else{
			echo '<script>alert("Item Already Added")</script>';
		}
	}
	else{
		$item_array = array(
			'item_id' => $_GET["id_produk"],
			'item_name' => $_POST["hidden_name"],
			'item_kategory' => $_POST["hidden_kategory"],
			'item_penerima' => $_POST["hidden_penerima"],
			'item_price' => $_POST["hidden_price"],
			'item_quantity'          =>     $_POST["quantity"]  

		);
		$_SESSION["shopping_cart"][0] = $item_array;
	}
	echo '<script>window.location="#cart"</script>';
}

if(isset($_GET["action"])){

	if($_GET["action"] == "delete"){
		foreach($_SESSION["shopping_cart"] as $keys => $values){
			if($values["item_id"] == $_GET["id_produk"]){
				unset($_SESSION["shopping_cart"][$keys]);
				sort($_SESSION["shopping_cart"]);
				// echo '<script>alert("Item Removed")</script>';
				echo '<script>window.location="#cart"</script>';
			}
		}
	}
	else if($_GET["action"] == "send"){
		$id_transaksi = rand(1000,100000);
		foreach($_SESSION["shopping_cart"] as $keys => $values){
			$id_produk = $values['item_id'];
			$quantity =    $values['item_quantity'];  

			$id_user = $_SESSION['id'];
			unset($_SESSION["shopping_cart"]);
			$hasil=mysqli_query($conn,"INSERT INTO tb_transaksi SET id_transaksi=$id_transaksi, id_user='$id_user', id_produk='$id_produk', qty='$quantity'");
		}
		echo '<script>window.location="detail-transaction.php?id='.$id_transaksi.'"</script>';
	}
	else if($_GET["action"] == "clear"){
		unset($_SESSION["shopping_cart"]);
		echo '<script>window.location="#cart"</script>';
	}
}



?>

<h2 id="cart" class="text-center" style="margin-top: 56px; margin-bottom: 40px;">Keranjang</h2>
<div class="row text-center" style="margin-bottom: 10%;">
	<div class="table-responsive text-center">
        <table class="table table-bordered" id="dataTable" cellspacing="0" style="width: 80%; margin: 0 10% 0;">
            <thead>
                <tr>
                    <th width="30%">Nama Sayur</th>
                    <th width="15%">Kategori</th>
                    <th width="15%">Penerima</th>
					<th width="15%">Quantity (KG)</th>

                    <th width="15%">Harga</th>
                    <th width="15%">&nbsp;Action&nbsp;</th>
                </tr>
            </thead>
            <tbody>
						
			
                <?php
							
							
				if(!empty($_SESSION["shopping_cart"])){
					$total = 0;
					foreach($_SESSION["shopping_cart"] as $keys => $values){
				?>
                <tr>
                    <td><?php echo $values['item_name']; ?></td>
                    <td><?php echo $values['item_kategory']; ?></td>
                    <td><?php echo $values['item_penerima']; ?></td>
                    <td><?php echo $values["item_quantity"]; ?></td>  
                    <td><?php echo $values['item_price']; ?></td>
                    <td>
                        <a class="btn btn-danger" href="product.php?action=delete&id_produk=<?php echo $values['item_id'];?>">
                            <i class="glyphicon glyphicon-remove"></i>Remove
                        </a>
                    </td>
                </tr>
                <?php
                	$total = $total + ($values["item_quantity"] * $values["item_price"]) ;
                	}

                ?>
                <tr>
					<td colspan="4">Total</td>
                    <td >Rp. <?php echo number_format($total, 2); ?></td>
					<td><a style="width: auto; margin: 3% 0 0;" class="btn btn-danger" href="product.php?action=clear">Remove All</a></td>
				</tr>
				<?php
				}
				
				?>
            </tbody>
			
			</form>
			
        </table>
        <?php 
        	if(!empty($_SESSION["shopping_cart"])){ ?>
        		<a style="width: auto; margin: 3% 0 0;" class="btn btn-success" href="product.php" >Tambah Barang</a>
				<a style="width: auto; margin: 3% 0 0;" class="btn btn-success" href="#" onclick="sendAll()">Kirim Barang</a>
        		<?php
        	}
        	else{
        		echo "<p class=\"text-center\" style=\"width:100%; margin-top: 10px;\">(KERANJANG KOSONG)</p>";
        	}
        ?>
    </div>
</div>
<script type="text/javascript">
	function sendAll() {
	 
	  var confirmmessage = "Apakah anda yakin ingin mengirim semua ?";
	  var go = "product.php?action=send";
	 
	  if (confirm(confirmmessage)) {
	      window.location = go;
	  }
	 
	}
</script>
<?php
    include('config.php');
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
	<div class="container">
		<a class="navbar-brand" href="index.php">		
			<img src="images/logo.png" width="150px">

		</a>
    	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
    		<span class="navbar-toggler-icon"></span>
    	</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">
				<li class="nav-link"><a class="nav-link" href="index.php">HOME<span class="sr-only">(current)</span></a></li>
				<li class="nav-link"><a class="nav-link" href="product.php">SAYURAN YANG INGIN DI JUAL</a></li>
				<li class="nav-link"><a class="nav-link" href="about.php">HUBUNGI KAMI</a></li>
				<?php
				if(@$_SESSION['level']=="user"){
					$id=$_SESSION['id'];

					$nama=mysqli_query($conn,"SELECT nama FROM tb_user WHERE id=$id");
					$c=mysqli_fetch_array($nama);

					$nama_pelanggan=$c['nama'];

				?>
					<li class="nav-link dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><b><?php echo $nama_pelanggan; ?></b></a>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">
							<a class="dropdown-item" href="my-transaction.php">Transaksi</a>
	                        <a class="dropdown-item" href="logout.php">Logout</a>
						</div>
					</li>
				<?php
				}
				else{
				?>
					<li class="nav-link dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ACCOUNT</a>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">
		                    <a class="dropdown-item" href="login.php">LOGIN</a>
		                    <a class="dropdown-item" href="register.php">REGISTER</a>
						</div>
					</li>
				<?php } ?>
				
			</ul>
		</div>
	</div>
</nav>
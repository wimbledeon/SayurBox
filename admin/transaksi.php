<?php 


if(isset($_GET['hapus'])) {
    $id_transaksi=$_GET['hapus'];

    $hasil=mysqli_query($conn,"DELETE FROM tb_transaksi WHERE id_transaksi='$id_transaksi'");
    if($hasil){
        header("location:manage.php?page=transaksi");
    }
}

?>

<div class="container">

	<h2 class="mt-4 mb-3">Manage Transaksi</h2>
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
	                <div class="table-responsive text-center">
	                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
	                        <thead>
	                            <tr>
	                                <th width="5%">No.</th>	
	                                <th width="10%">ID Transaksi</th>
	                                <th width="15%">Tanggal Transaksi</th>
	                                <th width="20%">Nama Pelanggan</th>
									<th width="20%">Jenis Sayuran</th>
	                                <th>Banyaknya (KG)</th>
	                                <th width="20%">&nbsp;Action&nbsp;</th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                            <?php
	                            $sql=mysqli_query($conn,"SELECT * FROM tb_transaksi GROUP BY id_transaksi ORDER BY tanggal_transaksi DESC");
	                            $no=1;
	                            while($data=mysqli_fetch_array($sql)){
	                                $id_transaksi = $data['id_transaksi'];
	                                $count = mysqli_query($conn,"SELECT *, count(id_transaksi), sum(harga) FROM tb_transaksi, tb_produk, tb_user WHERE tb_transaksi.id_produk=tb_produk.id_produk AND tb_transaksi.id_user=tb_user.id AND id_transaksi='$id_transaksi'");
	                                $c = mysqli_fetch_array($count);
	                            ?>
	                            <tr>
	                                <td><?php echo $no; ?></td>
	                                <td><?php echo $data['id_transaksi']; ?></td>
	                                <td><?php echo $data['tanggal_transaksi']; ?></td>
	                                <td><?php echo $c['nama']; ?></td>
									<td><?php echo $c['nama_sayur']; ?></td>
	                                <td><?php echo $c['count(id_transaksi)']; ?></td>
	                                <td>
									
									
	                                    <a class="btn btn-primary" href="detail-transaction.php?id=<?php echo $data['id_transaksi'];?>&nama=<?php echo $c['nama'];?>">
	                                        <i class="glyphicon glyphicon-pencil"></i>Detail
										</a>
										
										<a class="btn btn-danger" href="manage.php?page=transaksi&hapus=<?php echo $data['id_transaksi'];?>">
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
</div>
<?php 

if(isset($_GET['hapus'])) {
    $id_pesan=$_GET['hapus'];

    $hasil=mysqli_query($conn,"DELETE FROM tb_pesan WHERE id_pesan='$id_pesan'");
    if($hasil){
        header("location:manage.php?page=pesan");
    }
}

?>

<div class="container">

    <h2 class="mt-4 mb-3">Manage Pesan</h2>
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
                                <th width="20%">Nama Pengirim</th>
                                <th width="15%">Email</th>
                                <th width="20%">Subjek</th>
                                <th width="25%">Pesan</th>
                                <th width="15%">Tanggal</th>
                                <th width="10%">&nbsp;Action&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql=mysqli_query($conn,"SELECT * FROM tb_pesan ORDER BY tanggal_kirim DESC");
                            $no=1;
                            while($data=mysqli_fetch_array($sql)){
                            	$id_pesan = $data['id_pesan'];
                                $nama_pengirim = $data['nama_pengirim'];
                                $email_pengirim = $data['email_pengirim'];
                                $subjek = $data['subjek'];
                                $tanggal = $data['tanggal_kirim'];
                                $pesan = $data['pesan'];
                            ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $nama_pengirim; ?></td>
                                <td><?php echo $email_pengirim; ?></td>
                                <td><?php echo $subjek; ?></td>
                                <td><?php echo $pesan; ?></td>
                                <td><?php echo $tanggal; ?></td>
                                <td>
                                    <a class="btn btn-danger" href="manage.php?page=pesan&hapus=<?php echo $id_pesan;?>">
                                        <i class="glyphicon glyphicon-pencil"></i>Hapus
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
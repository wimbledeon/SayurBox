<?php 

if(isset($_GET['hapus'])) {
    $id=$_GET['hapus'];

    $hasil=mysqli_query($conn,"DELETE FROM tb_user WHERE id='$id'");
    if($hasil){
        header("location:manage.php?page=pelanggan");
    }
}

?>

<div class="container">

    <h2 class="mt-4 mb-3">Manage Pelanggan</h2>
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
                                <th width="10%">No.</th>
                                <th width="10%">ID</th>
                                <th>Nama Pelanggan</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>No. HP</th>
                                <th width="10%">&nbsp;Action&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql=mysqli_query($conn,"SELECT * FROM tb_user WHERE level='user'");
                            $no=1;
                            while($data=mysqli_fetch_array($sql)){
                            ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $data['id']; ?></td>
                                <td><?php echo $data['nama']; ?></td>
                                <td><?php echo $data['email']; ?></td>
                                <td><?php echo $data['alamat']; ?></td>
                                <td><?php echo $data['no_hp']; ?></td>
                                <td>
                                    <a class="btn btn-danger" href="manage.php?page=pelanggan&hapus=<?php echo $data['id'];?>">
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
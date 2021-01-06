<?php
// Create database connection using config file
include_once("conf/connection.php");
require_once("auth.php");
// Fetch all users data from database
if (isset($db)) {
    $userId = $_SESSION['user']['id'];
    $result = mysqli_query($db, "
        SELECT
	        p.id as peserta_id,
            p.order_id,
            u.name AS fullname,
            e.name AS pelatihan,
            e.id AS pelatihan_id,
            e.harga AS pelatihan_harga,
            p.email,
            p.status,
            p.filename 
        FROM
            peserta p
            INNER JOIN users u ON p.user_id = u.id
            INNER JOIN pelatihan e ON p.pelatihan_id = e.id 
        WHERE p.user_id = '$userId'
    ");
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Daftar Pelatihan
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Daftar Pelatihan</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <a href="index.php?page=pelatihan-create" class="btn btn-success pull-right" role="button" title="Tambah Data"><i
                                    class="glyphicon glyphicon-plus"></i> Tambah Pelatihan</a>
                    </div>
                    <div class="box-body">
                        <table id="workshop" class="table table-bordered table-hover table-responsive">
                            <thead>
                            <tr>
                                <th width="10%">#</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th width="10%">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                $no=0;
                                while($row = mysqli_fetch_array($result)) {
                                    ?>

                                    <tr>
                                        <td><?= $no=$no+1;?></td>
                                        <td><?= $row['pelatihan'];?></td>
                                        <td><?= "Rp " . number_format($row['pelatihan_harga'],2,',','.');?></td>
                                        <td>
                                            <a href="index.php?page=pelatihan-view&id=<?=$row['pelatihan_id'];?>" class="btn btn-sm btn-primary" role="button" title="Lihat Pelatihan"><i class="glyphicon glyphicon-eye-open"></i></a>
                                        </td>
                                    </tr>

                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Javascript Datatable -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#workshop').DataTable();
    });
</script>
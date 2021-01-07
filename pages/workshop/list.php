<?php
// Create database connection using config file
include_once("conf/connection.php");
require_once("auth.php");
// Fetch all users data from database
if (isset($db)) {
    $result = mysqli_query($db, "SELECT * FROM pelatihan ORDER BY id DESC");
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Master Workshop
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Master Workshop</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <a href="index.php?page=workshop-create" class="btn btn-success pull-right" role="button" title="Tambah Data"><i
                                class="glyphicon glyphicon-plus"></i> Tambah</a>
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
                                if ($result) while($row = mysqli_fetch_array($result)) {
                                    ?>

                                    <tr>
                                        <td><?= $no=$no+1;?></td>
                                        <td><?= $row['name'];?></td>
                                        <td><?= "Rp " . number_format($row['harga'],2,',','.');?></td>
                                        <td>
                                            <a href="index.php?page=workshop-edit&id=<?=$row['id'];?>" class="btn btn-sm btn-warning" role="button" title="Ubah Data"><i class="glyphicon glyphicon-edit"></i></a>
                                            <a href="pages/workshop/hapus.php?id=<?=$row['id'];?>" onclick="return confirm('Anda yakin akan menghapus data ' + '<?=$row['name'];?>' + ' ini ?');" class="btn btn-sm btn-danger" role="button" title="Hapus Data"><i class="glyphicon glyphicon-trash"></i></a>
                                        </td>
                                    </tr>

                                <?php } else {
                                    ?>
                                    <tr>
                                        <td colspan="5" align="center">Data Tidak Ditemukan</td>
                                    </tr>
                                    <?php
                                }?>
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
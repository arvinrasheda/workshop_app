<?php
// Create database connection using config file
include_once("conf/connection.php");
include 'helper/GeneralHelper.php';
require_once("auth.php");
// Fetch all users data from database
if (isset($db)) {
    $result = mysqli_query($db, "
        SELECT
	        p.id as peserta_id,
            p.order_id,
            u.name AS fullname,
            e.name AS pelatihan,
            p.email,
            p.status,
            p.filename 
        FROM
            peserta p
            INNER JOIN users u ON p.user_id = u.id
            INNER JOIN pelatihan e ON p.pelatihan_id = e.id 
        ORDER BY
            u.NAME
    ");
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            List Peserta Pendaftar
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">List Peserta Pendaftar</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <table id="peserta" class="table table-bordered table-hover table-responsive">
                            <thead>
                            <tr>
                                <th width="10%">#</th>
                                <th>OrderID</th>
                                <th>Nama</th>
                                <th>Pelatihan</th>
                                <th>Status</th>
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
                                        <td><?= $row['order_id'];?></td>
                                        <td><?= $row['fullname'];?></td>
                                        <td><?= $row['pelatihan'];?></td>
                                        <td>
                                            <?php
                                                if ($row["status"] == GeneralHelper::ORDER_NEW) {
                                                    echo '<small class="badge bg-green"> NEW</small>';
                                                } else if ($row["status"] == GeneralHelper::ORDER_ONPROGRESS) {
                                                    echo '<small class="badge bg-yellow"> ONPROGRESS</small>';
                                                } else if ($row["status"] == GeneralHelper::ORDER_CANCEL) {
                                                    echo '<small class="badge bg-red"> CANCEL</small>';
                                                } else {
                                                    echo '<small class="badge bg-blue"> DONE</small>';
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php if ($row["filename"] != null) { ?>
                                                <a target="_blank" href="file/proof/<?=$row['filename'];?>" class="btn btn-sm btn-primary" role="button" title="Lihat Bukti transfer"><i class="glyphicon glyphicon-download"></i></a>
                                            <?php } ?>
                                            <?php if ($row["status"] == GeneralHelper::ORDER_ONPROGRESS) { ?>
                                            <a href="pages/peserta/store.php?id=<?=$row['peserta_id'];?>&status=accept" onclick="return confirm('Anda yakin akan approve peserta ' + '<?=$row['fullname'];?>' + ' ini ?');" class="btn btn-sm btn-success" role="button" title="Approve Data"><i class="glyphicon glyphicon-check"></i></a>
                                            <a href="pages/peserta/store.php?id=<?=$row['peserta_id'];?>&status=cancel" onclick="return confirm('Anda yakin akan menolak peserta ' + '<?=$row['fullname'];?>' + ' ini ?');" class="btn btn-sm btn-warning" role="button" title="Tolak Data"><i class="glyphicon glyphicon-ban-circle"></i></a>
                                            <?php } ?>
                                            <?php if ($row["status"] == GeneralHelper::ORDER_NEW) { ?>
                                                <a href="pages/peserta/hapus.php?id=<?=$row['peserta_id'];?>" onclick="return confirm('Anda yakin akan menghapus peserta dengan nama ' + '<?=$row['fullname'];?>' + ' ini ?');" class="btn btn-sm btn-danger" role="button" title="Hapus Data"><i class="glyphicon glyphicon-trash"></i></a>
                                            <?php } ?>
                                        </td>
                                    </tr>

                                <?php } else { ?>
                                <tr>
                                    <td colspan="5" align="center">Data Tidak Ditemukan</td>
                                </tr>
                                <?php }?>
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
        $('#peserta').DataTable();
    });
</script>
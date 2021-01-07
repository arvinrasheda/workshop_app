<?php
// Create database connection using config file
include_once("conf/connection.php");
include 'helper/GeneralHelper.php';
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
            List Order
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">List Order</li>
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
                                <th>Pelatihan</th>
                                <th>Status</th>
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
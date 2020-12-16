<?php

//session_start();
include_once("conf/connection.php");
require_once("auth.php");

$data = [];
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = /** @lang sql */
        "SELECT * FROM materi WHERE id = '$id'";

    if (isset($db)) {
        $query = mysqli_query($db, $sql);
        $data = mysqli_fetch_array($query);
        if (!$data) {
            echo "<script>
            window.location.href='index.php?page=users';
            alert('Data Tidak Ditemukan');
            </script>";
        }
    }
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Edit Materi
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Edit Materi</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <!-- /.box-header -->

                    <!-- form start -->
                    <form role="form" method="post" action="pages/workshop/store.php">
                        <div class="box-body">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="name" class="form-control" placeholder="Nama"
                                       value="<?= $data['name'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Harga</label>
                                <input type="text" name="harga" class="form-control number-format" placeholder="Harga"
                                       value="<?= $data['harga'] ?>" required>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                            <input type="hidden" name="type" value="update">
                            <button type="submit" name="pelatihan" class="btn btn-primary" title="Simpan Data"><i
                                        class="glyphicon glyphicon-floppy-disk"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
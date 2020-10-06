<?php

//session_start();
include_once("conf/connection.php");
require_once("auth.php");

$data = [];
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = /** @lang sql */
        "SELECT * FROM users WHERE id = '$id'";

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


if (isset($_POST['users'])) {
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);

    $sql = /** @lang sql */
        "UPDATE users SET username='$username', name='$name' WHERE id='$id'";

    if (isset($db)) {
        $query = mysqli_query($db, $sql);
    }
    if ($query) {
        echo "<script>
         window.location.href='index.php?page=users';
         alert('Data Berhasil diupdate!');
         </script>";
    } else {
        var_dump($query->error);
        die;
    }

}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Tambah User
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Tambah User</li>
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
                    <form role="form" method="post" action="">
                        <div class="box-body">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="name" class="form-control" placeholder="Nama"
                                       value="<?= $data['name'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" placeholder="User Name"
                                       value="<?= $data['username'] ?>" required>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                            <button type="submit" name="users" class="btn btn-primary" title="Simpan Data"><i
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
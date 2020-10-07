<?php
include_once("conf/connection.php");
require_once("auth.php");
if(isset($_POST['users'])){
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    // enkripsi password
    $password = password_hash(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING), PASSWORD_DEFAULT);

    $sql = /** @lang sql */
        "INSERT INTO users (name, username, password) VALUE ('$name', '$username', '$password')";

    if (isset($db)) {
        $query = mysqli_query($db, $sql);
    }
    if ($query) {
        $_SESSION['toastr'] = array(
            'type' => 'success', // or 'success' or 'info' or 'warning'
            'message' => 'Data berhasil ditambah!',
            'title' => 'Sukses'
        );
        echo "<script>
         window.location.href='index.php?page=users';
         </script>";
    } else {
        var_dump($query->error);die;
    }

}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Tambah Workshop
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Tambah Workshop</li>
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
                                <input type="text" name="name" class="form-control" placeholder="Nama" required>
                            </div>
                            <div class="form-group">
                                <label>Harga</label>
                                <input type="text" name="harga" class="form-control number-format" placeholder="Harga" required>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <input type="hidden" name="type" value="create">
                            <button type="submit" name="pelatihan" class="btn btn-primary" title="Simpan Data"> <i class="glyphicon glyphicon-floppy-disk"></i> Simpan</button>
                        </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
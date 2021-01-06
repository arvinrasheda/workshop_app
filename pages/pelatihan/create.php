<?php
include_once("conf/connection.php");
require_once("auth.php");

if (isset($db)) {
    $result = mysqli_query($db, "SELECT * FROM pelatihan ORDER BY id DESC");
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Tambah Pelatihan
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Tambah Pelatihan</li>
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
                    <form role="form" method="post" action="pages/pelatihan/store.php">
                        <div class="box-body">
                            <div class="form-group">
                                <label>Pelatihan</label>
                                <select class="form-control" name="pelatihan_id" autocomplete="off" required>
                                <option selected disabled> - Pilih Pelatihan -</option>
                                <?php while ($row = mysqli_fetch_array($result)) { ?>
                                    <option value="<?= $row['id'] ?>"><?= $row['name']; ?></option>
                                <?php } ?>
                                </select>
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
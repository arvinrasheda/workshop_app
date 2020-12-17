<?php

//session_start();
include_once("conf/connection.php");
require_once("auth.php");

include "helper/GeneralHelper.php";

$helper = new GeneralHelper();

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
            window.location.href='index.php?page=materi';
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
                    <form role="form" method="post" action="pages/materi/store.php">
                        <div class="box-body">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="nama" class="form-control" placeholder="Nama" value="<?= $data['nama'] ?>"  required>
                            </div>
                            <div class="form-group">
                                <label>Jenis</label>
                                <select id="jenis" name="jenis" class="form-control" onchange="checkJenis();">
                                    <option selected disabled> - Pilih Jenis - </option>
                                    <option value="DOKUMEN" <?= $data['jenis'] == "DOKUMEN" ? 'selected' : ""?>>File Dokumen Materi</option>
                                    <option value="DARING" <?= $data['jenis'] == "DARING" ? 'selected' : ""?>>Daring Online Link</option>
                                </select>
                            </div>
                            <div id="daring" class="form-group hidden">
                                <label>Link</label>
                                <input type="text" name="link" class="form-control" placeholder="link" value="<?= $data['link'] ?>" >
                            </div>
                            <div id="dokumen" class="form-group hidden">
                                <label>File</label>
                                <input type="file" name="file" class="form-control">
                                <a target="_blank" href="download.php?file=<?= $data['link'] ?>">Download File</a>
                            </div>
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea placeholder="Deskripsi Materi" name="description" class="form-control"><?= $data['description'] ?></textarea>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <input type="hidden" name="id" value="<?= $data['id'] ?>">
                            <input type="hidden" name="pelatihan_id" value="<?= $data['pelatihan_id'] ?>">
                            <input type="hidden" name="type" value="update">
                            <button type="submit" name="materi" class="btn btn-primary" title="Simpan Data"><i
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

<script type="text/javascript">
    checkJenis();
    function checkJenis() {
        var jenis = $("#jenis").val();
        if (jenis == "DOKUMEN") {
            $("#dokumen").removeClass("hidden")
            $("#daring").addClass("hidden")
        } else {
            $("#daring").removeClass("hidden")
            $("#dokumen").addClass("hidden")
        }
    }
</script>
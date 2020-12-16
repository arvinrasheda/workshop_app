<?php
include_once("conf/connection.php");
require_once("auth.php");
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Tambah Materi
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Tambah Materi</li>
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
                    <form role="form" method="post" action="pages/materi/store.php" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="name" class="form-control" placeholder="Nama" required>
                            </div>
                            <div class="form-group">
                                <label>Jenis</label>
                                <select id="jenis" name="jenis" class="form-control" onchange="checkJenis();">
                                    <option selected disabled> - Pilih Jenis - </option>
                                    <option value="DOKUMEN">File Dokumen Materi</option>
                                    <option value="DARING">Daring Online Link</option>
                                </select>
                            </div>
                            <div id="daring" class="form-group hidden">
                                <label>Link</label>
                                <input type="text" name="link" class="form-control" placeholder="link">
                            </div>
                            <div id="dokumen" class="form-group hidden">
                                <label>File</label>
                                <input type="file" name="file" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea placeholder="Deskripsi Materi" name="description" class="form-control"></textarea>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <input type="hidden" name="pelatihan_id" value="<?= $_GET['pelatihan_id'] ?>">
                            <input type="hidden" name="type" value="create">
                            <button type="submit" name="materi" class="btn btn-primary" title="Simpan Data"> <i class="glyphicon glyphicon-floppy-disk"></i> Simpan</button>
                        </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

<script type="text/javascript">
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
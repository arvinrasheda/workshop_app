<?php

//session_start();
include_once("conf/connection.php");
require_once("auth.php");

$data = [];
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sqlPelatihan = /** @lang sql */
        "SELECT * FROM pelatihan WHERE id = '$id'";

    $sqlMateri = /** @lang sql */
        "SELECT * FROM materi WHERE pelatihan_id = '$id'";

    if (isset($db)) {
        $queryPelatihan = mysqli_query($db, $sqlPelatihan);
        $dataPelatihan = mysqli_fetch_array($queryPelatihan);

        $dataMateri = mysqli_query($db, $sqlMateri);

        if (!$dataPelatihan) {
            echo "<script>
            window.location.href='index.php?page=workshop';
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
            Edit Workshop
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Edit Workshop</li>
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
                                       value="<?= $dataPelatihan['name'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Harga</label>
                                <input type="text" name="harga" class="form-control number-format" placeholder="Harga"
                                       value="<?= $dataPelatihan['harga'] ?>" required>
                            </div>
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">List Materi</h3>
                                    <a href="index.php?page=materi-create&pelatihan_id=<?= $dataPelatihan['id'] ?>" class="btn btn-success pull-right" role="button" title="Tambah Data"><i
                                                class="glyphicon glyphicon-plus"></i> Tambah</a>
                                </div>
                                <div class="box-body">
                                    <table id="workshop" class="table table-bordered table-hover table-responsive">
                                        <thead>
                                        <tr>
                                            <th width="10%">#</th>
                                            <th>Nama</th>
                                            <th>Jenis</th>
                                            <th>Link</th>
                                            <th width="10%">Aksi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
//                                        var_export($dataMateri);die;
                                        $no=0;
                                        if ($dataMateri) while($row = mysqli_fetch_array($dataMateri)) {
                                            ?>
                                            <tr>
                                                <td><?= $no=$no+1;?></td>
                                                <td><?= $row['nama'];?></td>
                                                <td><?= $row['jenis'];?></td>
                                                <td>
                                                    <?php if ($row['jenis'] == 'DOKUMEN') { ?>
                                                        <a href="download.php?file=<?= $row['link'];?>" target="_blank" class="btn btn-primary"><i class="glyphicon glyphicon-download"> Download</i></a>
                                                    <?php } else if ($row['jenis'] == 'DARING') { ?>
                                                        <a href="<?= $row['link'];?>" target="_blank" class="btn btn-primary"> <i class="glyphicon glyphicon-fast-forward"> Menuju Link</i></a>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <a href="index.php?page=materi-edit&id=<?=$row['id'];?>" class="btn btn-sm btn-warning" role="button" title="Ubah Data"><i class="glyphicon glyphicon-edit"></i></a>
                                                    <a href="pages/materi/hapus.php?id=<?=$row['id'];?>" onclick="return confirm('Anda yakin akan menghapus data ' + '<?=$row['nama'];?>' + ' ini ?');" class="btn btn-sm btn-danger" role="button" title="Hapus Data"><i class="glyphicon glyphicon-trash"></i></a>
                                                </td>
                                            </tr>

                                        <?php } else {
                                            ?>
                                            <tr>
                                                <td colspan="5" align="center">Data Tidak Ditemukan</td>
                                            </tr>
                                            <?php
                                        }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.box-body -->
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
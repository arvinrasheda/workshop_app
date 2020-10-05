<?php
// Create database connection using config file
include_once("conf/connection.php");
require_once("auth.php");
// Fetch all users data from database
if (isset($mysqli)) {
    $result = mysqli_query($mysqli, "SELECT * FROM users ORDER BY id DESC");
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Master Users
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Master Users</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <a href="index.php?page=tambah_mahasiswa" class="btn btn-success pull-right" role="button" title="Tambah Data"><i
                                class="glyphicon glyphicon-plus"></i> Tambah</a>
                    </div>
                    <div class="box-body">
                        <table id="users" class="table table-bordered table-hover table-responsive">
                            <thead>
                            <tr>
                                <th width="10%">#</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th width="10%">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                $no=0;
                                while($row = mysqli_fetch_array($result)) {
                                    ?>

                                    <tr>
                                        <td><?php echo $no=$no+1;?></td>
                                        <td><?php echo $row['name'];?></td>
                                        <td><?php echo $row['username'];?></td>
                                        <td>
                                            <a href="index.php?page=ubah_mahasiswa&id=<?=$row['id'];?>" class="btn btn-sm btn-warning" role="button" title="Ubah Data"><i class="glyphicon glyphicon-edit"></i></a>
                                            <a href="pages/mahasiswa/hapus_mahasiswa.php?id=<?=$row['id'];?>" class="btn btn-sm btn-danger" role="button" title="Hapus Data"><i class="glyphicon glyphicon-trash"></i></a>
                                        </td>
                                    </tr>

                                <?php } ?>
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
        $('#users').DataTable();
    });
</script>
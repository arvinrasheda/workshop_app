
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <?php require_once("auth.php"); ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Selamat datang !</small>
        </h1>
        <ol class="breadcrumb">
            <li class="active"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="box box-default">
            <div class="box-body">
                <h4> Selamat Datang <?= $_SESSION['user']['name'] ?> !</h4>
            </div>
        </div>
    </section>
    <!-- /.Main content -->
</div>
<!-- /.content-wrapper -->
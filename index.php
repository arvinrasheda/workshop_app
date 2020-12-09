<?php
session_start();
include "conf/connection.php";
require_once("auth.php");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <!-- jQuery 2.2.3 -->
    <script src="plugins/jQuery/jQuery-2.2.0.min.js"></script>

    <style>
        table.dataTable td.dataTables_empty{
            text-align:center;
        }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

    <header class="main-header">

        <!-- Logo -->
        <a href="index.php" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>A</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Admin</b>WSP</span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                            <span class="hidden-xs"><?= $_SESSION['user']['name'] ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                                <p>
                                    <?= $_SESSION['user']['name'] ?>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>

        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p><?= $_SESSION['user']['name'] ?></p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">MENU</li>
                <li class="treeview">
                <li <?php if (!isset($_GET['page']) == 1) echo "class='active'"; ?>><a href="index.php"><i
                                class="glyphicon glyphicon-dashboard"></i> <span>Dashboard</span></a></li>
                </li>
                <li class="treeview <?php if(strpos($_GET['page'], 'master') !== false) echo "active";?>">
                    <a href="#">
                        <i class="glyphicon glyphicon-briefcase"></i> <span>Master</span>
                        <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                    </a>
                    <ul class="treeview-menu">
                        <li <?php if(isset($_GET['page']) && $_GET['page'] == "workshop") echo "class='active'";?>><a href="index.php?page=workshop"><i class="glyphicon glyphicon-education"></i>
                                <span>Master Workshop</span></a></li>
                    </ul>
                </li>
                <li class="treeview <?php if(strpos($_GET['page'], 'peserta') !== false) echo "active";?>">
                    <a href="#">
                        <i class="glyphicon glyphicon-user"></i> <span>Peserta</span>
                        <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                    </a>
                    <ul class="treeview-menu">
                        <li  <?php if(isset($_GET['page']) && $_GET['page'] == "peserta") echo "class='active'";?>><a href="index.php?page=peserta"><i class="glyphicon glyphicon-user"></i> <span>Daftar Peserta</span></a></li>
                        </li>
                        <li><a target="_blank" href="pages/register.php"><i class="glyphicon glyphicon-education"></i>
                                <span>Link Register Peserta</span></a></li>
                    </ul>
                </li>
                <li class="header">SETTING</li>
                <li class="treeview">
                <li  <?php if(isset($_GET['page']) && $_GET['page'] == "users") echo "class='active'";?>><a href="index.php?page=users"><i class="glyphicon glyphicon-user"></i> <span>Users</span></a></li>
                </li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content -->
    <?php include "conf/route.php"; ?>
    <!-- /Content -->

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.3.3
        </div>
        <strong>Copyright &copy; 2020 <a href="#">Kelompok 6</a>.</strong> All rights
        reserved.
    </footer>

</div>
<!-- ./wrapper -->

<script>
    $(function(){
        <?php
        if(isset($_SESSION['toastr']))
        {
            echo 'toastr.'.$_SESSION['toastr']['type'].'("'.$_SESSION['toastr']['message'].'", "'.$_SESSION['toastr']['title'].'")';
            unset($_SESSION['toastr']);
        }
        ?>
    });
</script>
<!-- jQuery 2.2.0 -->
<script src="plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="plugins/chartjs/Chart.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script type="text/javascript">
    function refreshNumberFormat() {
        $('.number-format').on('keypress', function(e){
            return (e.charCode >= 48 && e.charCode <= 57);
        }).on('keyup', function(){
            var n = parseInt($(this).val().replace(/\D/g,''));
            $(this).val($(this).val() == '' ? '' : n.toLocaleString('ID'));
        });
    }
    $(document).ready(function($){

        // Format mata uang.
        refreshNumberFormat();

    })
</script>
</body>

</html>

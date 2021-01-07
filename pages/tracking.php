<?php
session_start();
require_once("../conf/connection.php");
include '../helper/GeneralHelper.php';
$data = "";
if (isset($db)) {
    if (isset($_GET["id"])) {
        $orderId =  $_GET['id'];
        $result = mysqli_query($db, "
            SELECT
                p.id as peserta_id,
                p.order_id,
                u.name AS fullname,
                e.name AS pelatihan,
                e.harga,
                p.email,
                p.status 
            FROM
                peserta p
                INNER JOIN users u ON p.user_id = u.id
                INNER JOIN pelatihan e ON p.pelatihan_id = e.id 
            WHERE order_id = '$orderId'
        ");

        $data = mysqli_fetch_array($result);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tracking WSP</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../plugins/iCheck/square/blue.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition register-page">
<div class="register-box">
    <div class="register-logo">
        <a href="#"><b>Tracking Order </b>WSP</a>
    </div>

    <div class="register-box-body">
        <p class="login-box-msg">Track Status Your Order</p>

        <form action="tracking.php" autocomplete="off" method="get">
            <div class="form-group has-feedback">
                <input type="text" name="id" class="form-control" placeholder="Order ID / Invoice" autocomplete="off" value="<?= isset($_GET['id']) ? $_GET['id'] : '' ?>" required>
                <span class="glyphicon glyphicon-barcode form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <a class="btn btn-danger btn-block btn-flat" href="confirmation.php">Upload Bukti Pembayaran</a>
                </div>
                <!-- /.col -->
                <div class="col-xs-4"><button type="submit" class="btn btn-primary btn-block btn-flat <?php if ($data != null) {  if(isset($_GET['id']) && $_GET['id'] != '') { echo 'hidden'; } } ?>">Check</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
        <div style="margin-top: 10px; " class="box collapsed-box">
            <div class="box-header with-border">
                <h3 class="box-title">Transfer Manual Rekening WSP</h3>
                <div class="box-tools pull-right">
                    <!-- Collapse Button -->
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body text-center ">
                <p style="font-size: medium;">Bank Mandiri A.N WSP <br>
                    13234758000009</p>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
                <span style="color: #e25555;">&hearts;</span>
            </div>
        </div>
        <?php if ($data != null) { ?>
            <div style="margin-top: 10px; " class="callout callout-warning">
                <h4>Information</h4>

                <p>Harap Simpan Nomor Invoice Anda.</p>
            </div>
            <table id="layout-skins-list" class="table table-striped bring-up nth-2-center">
                <thead>
                <tr>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Invoice</td>
                    <td><?= $data["order_id"] ?></td>
                </tr>
                <tr>
                    <td>Peserta</td>
                    <td><?= $data["fullname"] ?></td>
                </tr>
                <tr>
                    <td>Pelatihan</td>
                    <td><?= $data["pelatihan"] ?></td>
                </tr>
                <tr>
                    <td>Jumlah Pembayaran</td>
                    <td><?= "Rp " . number_format($data['harga'],2,',','.');?></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <?php
                        if ($data["status"] == GeneralHelper::ORDER_NEW) {
                            echo '<small class="badge bg-green"> NEW</small>';
                        } else if ($data["status"] == GeneralHelper::ORDER_ONPROGRESS) {
                            echo '<small class="badge bg-yellow"> ONPROGRESS</small>';
                        } else {
                            echo '<small class="badge bg-blue"> DONE</small>';
                        }
                        ?>
                    </td>
                </tr>
                </tbody>
            </table>
        <?php } else {
            if (isset($_GET['id'])) {
                $_SESSION['toastr'] = array(
                    'type' => 'error', // or 'success' or 'info' or 'warning'
                    'message' => 'Error: Data Tidak Ditemukan!',
                    'title' => 'Peringatan'
                );
            }
        };?>
    </div>
    <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 2.2.0 -->
<script src="../plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../plugins/iCheck/icheck.min.js"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
        <?php
        if(isset($_SESSION['toastr']))
        {
            echo 'toastr.'.$_SESSION['toastr']['type'].'("'.$_SESSION['toastr']['message'].'", "'.$_SESSION['toastr']['title'].'")';
            unset($_SESSION['toastr']);
        }
        ?>
    });
</script>
<!-- AdminLTE App -->
<script src="../dist/js/app.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>

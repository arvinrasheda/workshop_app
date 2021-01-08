<?php
session_start();
require_once("../conf/connection.php");
include '../helper/GeneralHelper.php';

$helper = new GeneralHelper();
$status = $helper::ORDER_ONPROGRESS;
if (isset($db)) {
    if (isset($_POST)) {
        $orderId = filter_input(INPUT_POST, 'order_id', FILTER_SANITIZE_STRING);
        $file_tmp = $_FILES['file']['tmp_name'];
        $file_name = $_FILES['file']['name'];
        $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $newFile = $orderId . "." . $ext;

        $sql = /** @lang sql */
            "UPDATE peserta SET filename='$newFile', status='$status' WHERE order_id='$orderId'";

        if (isset($db)) {
            $query = mysqli_query($db, $sql);
        }
        if ($query) {
            move_uploaded_file($file_tmp, '../file/proof/' . $newFile);
            $_SESSION['toastr'] = array(
                'type' => 'success', // or 'success' or 'info' or 'warning'
                'message' => 'Data berhasil disimpan!',
                'title' => 'Sukses'
            );
            header('Location: tracking.php?id=' . $orderId);
        } else {
            $_SESSION['toastr'] = array(
                'type' => 'error', // or 'success' or 'info' or 'warning'
                'message' => 'Data gagal disimpan!',
                'title' => 'Error'
            );
            echo "<script>
            window.location.href='confirmation.php';
            </script>";
        }
    }
}


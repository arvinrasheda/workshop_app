<?php

session_start();

include_once("../../conf/connection.php");
require_once("../../auth.php");
include '../../helper/GeneralHelper.php';

$helper = new GeneralHelper();
$done = $helper::ORDER_DONE;
$cancel = $helper::ORDER_CANCEL;

// Get id from URL to delete that user
$id = $_GET['id'];
$status = $_GET['status'];

// Delete user row from table based on given id
if (isset($db)) {
    $check = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM peserta WHERE id = '$id'"));
    $userId = $check["user_id"];
    if ($check) {
        if ($status == "accept") {
            $sqlPeserta = /** @lang sql */
                "UPDATE peserta SET status='$done' WHERE id='$id'";
            $sqlUsers = /** @lang sql */
                "UPDATE users SET is_active=1 WHERE id='$userId'";
            $peserta = mysqli_query($db, $sqlPeserta);
            $user = mysqli_query($db, $sqlUsers);

            if (!$user && !$peserta) {
                $_SESSION['toastr'] = array(
                    'type' => 'warning', // or 'success' or 'info' or 'warning'
                    'message' => $db->error,
                    'title' => 'Error'
                );
            }
        } else {
            $sqlPeserta = /** @lang sql */
                "UPDATE peserta SET status='$cancel' WHERE id='$id'";
            $peserta = mysqli_query($db, $sqlPeserta);
            if (!$peserta) {
                $_SESSION['toastr'] = array(
                    'type' => 'warning', // or 'success' or 'info' or 'warning'
                    'message' => $db->error,
                    'title' => 'Error'
                );
            }
        }
        $_SESSION['toastr'] = array(
            'type' => 'success', // or 'success' or 'info' or 'warning'
            'message' => 'Data berhasil disimpan!',
            'title' => 'Sukses'
        );
    } else {
        $_SESSION['toastr'] = array(
            'type' => 'warning', // or 'success' or 'info' or 'warning'
            'message' => 'Data tidak ditemukan!',
            'title' => 'Peringatan'
        );
    }

    echo "<script>
         window.location.href='../../index.php?page=peserta';
         </script>";
}
?>
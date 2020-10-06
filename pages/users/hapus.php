<?php

session_start();
include_once("../../conf/connection.php");
require_once("../../auth.php");

// Get id from URL to delete that user
$id = $_GET['id'];

// Delete user row from table based on given id
if (isset($db)) {
    $check = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM users WHERE id = '$id'"));
    if ($check) {
        $result = mysqli_query($db, "DELETE FROM users WHERE id='$id'");
        $_SESSION['toastr'] = array(
            'type' => 'success', // or 'success' or 'info' or 'warning'
            'message' => 'Data berhasil dihapus!',
            'title' => 'Sukses'
        );
        echo "<script>
         window.location.href='../../index.php?page=users';
         </script>";
    } else {
        $_SESSION['toastr'] = array(
            'type' => 'warning', // or 'success' or 'info' or 'warning'
            'message' => 'Data tidak ditemukan!',
            'title' => 'Peringatan'
        );
        echo "<script>
         window.location.href='../../index.php?page=users';
         </script>";
    }
}
?>
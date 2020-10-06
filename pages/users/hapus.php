<?php

session_start();
include_once("../../conf/connection.php");
require_once("../../auth.php");

// Get id from URL to delete that user
$id = $_GET['id'];

// Delete user row from table based on given id
if (isset($db)) {
    $result = mysqli_query($db, "DELETE FROM users WHERE id='$id'");
    if ($result) {
        $_SESSION['toastr'] = array(
            'type' => 'success', // or 'success' or 'info' or 'warning'
            'message' => 'Data berhasil dihapus!',
            'title' => 'Sukses'
        );
        echo "<script>
         window.location.href='../../index.php?page=users';
         </script>";
    }
}
?>
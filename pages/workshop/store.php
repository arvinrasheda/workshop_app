<?php

session_start();

include_once("../../conf/connection.php");
require_once("../../auth.php");
if (isset($_POST['pelatihan'])) {
    $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING);
    switch ($type) {
        case 'create':
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
            $harga = filter_input(INPUT_POST, 'harga', FILTER_SANITIZE_STRING);
            $harga = preg_replace('/\./', '', $harga);

            $sql = /** @lang sql */
                "INSERT INTO pelatihan (name, harga) VALUE ('$name', '$harga')";

            if (isset($db)) {

                /*
                 * untuk transaction
                 * $db->autocommit(false);*/
                $query = mysqli_query($db, $sql);
            }
            if ($query) {
//                $db->commit();
//                var_export($query);die;
                $_SESSION['toastr'] = array(
                    'type' => 'success', // or 'success' or 'info' or 'warning'
                    'message' => 'Data berhasil ditambah!',
                    'title' => 'Sukses'
                );
                echo "<script>
                window.location.href='../../index.php?page=workshop';
                </script>";
            } else {
                $_SESSION['toastr'] = array(
                    'type' => 'warning', // or 'success' or 'info' or 'warning'
                    'message' => 'Error: ' . $db->error,
                    'title' => 'Peringatan'
                );
                echo "<script>
                window.location.href='../../index.php?page=workshop';
                </script>";
            }
            break;
        case 'update':
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
            $harga = filter_input(INPUT_POST, 'harga', FILTER_SANITIZE_STRING);
            $harga = preg_replace('/\./', '', $harga);

            $sql = /** @lang sql */
                "UPDATE pelatihan SET harga='$harga', name='$name' WHERE id='$id'";

            if (isset($db)) {
                $query = mysqli_query($db, $sql);
            }
            if ($query) {
                $_SESSION['toastr'] = array(
                    'type' => 'success', // or 'success' or 'info' or 'warning'
                    'message' => 'Data berhasil diupdate!',
                    'title' => 'Sukses'
                );
                echo "<script>
                window.location.href='../../index.php?page=workshop';
                </script>";
            } else {
                $_SESSION['toastr'] = array(
                    'type' => 'warning', // or 'success' or 'info' or 'warning'
                    'message' => 'Error: ' . $db->error,
                    'title' => 'Peringatan'
                );
                echo "<script>
                window.location.href='../../index.php?page=workshop';
                </script>";
            }
            break;
    }


}
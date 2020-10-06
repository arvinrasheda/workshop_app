<?php

session_start();

include_once("../../conf/connection.php");
require_once("../../auth.php");
if (isset($_POST['users'])) {
    $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING);
    switch ($type) {
        case 'create':
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            // enkripsi password
            $password = password_hash(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING), PASSWORD_DEFAULT);

            $sql = /** @lang sql */
                "INSERT INTO users (name, username, password) VALUE ('$name', '$username', '$password')";

            if (isset($db)) {
                $query = mysqli_query($db, $sql);
            }
            if ($query) {
                $_SESSION['toastr'] = array(
                    'type' => 'success', // or 'success' or 'info' or 'warning'
                    'message' => 'Data berhasil ditambah!',
                    'title' => 'Sukses'
                );
                echo "<script>
                 window.location.href='../../index.php?page=users';
                 </script>";
            } else {
                var_dump($query->error);
                die;
            }
            break;
        case 'update':
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);

            $sql = /** @lang sql */
                "UPDATE users SET username='$username', name='$name' WHERE id='$id'";

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
         window.location.href='../../index.php?page=users';
         </script>";
            } else {
                var_dump($query->error);
                die;
            }
            break;
    }


}
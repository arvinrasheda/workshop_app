<?php

session_start();

include_once("../../conf/connection.php");
require_once("../../auth.php");
if (isset($_POST['pelatihan'])) {
    $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING);
    switch ($type) {
        case 'create':
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
            $jenis = filter_input(INPUT_POST, 'jenis', FILTER_SANITIZE_STRING);
            $link = filter_input(INPUT_POST, 'link', FILTER_SANITIZE_STRING);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
            $pelatihan_id = filter_input(INPUT_POST, 'pelatihan_id', FILTER_SANITIZE_STRING);

            $sql = /** @lang sql */
                "INSERT INTO materi (nama, jenis, link, description, pelatihan_id) VALUE ('$name', '$jenis', '$link', '$description', '$pelatihan_id')";

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
                 window.location.href='../../index.php?page=materi';
                 </script>";
            } else {
                $_SESSION['toastr'] = array(
                    'type' => 'warning', // or 'success' or 'info' or 'warning'
                    'message' => 'Error: ' . $db->error,
                    'title' => 'Peringatan'
                );
                echo "<script>
                 window.location.href='../../index.php?page=materi';
                 </script>";
            }
            break;
        case 'update':
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
            $jenis = filter_input(INPUT_POST, 'jenis', FILTER_SANITIZE_STRING);
            $link = filter_input(INPUT_POST, 'link', FILTER_SANITIZE_STRING);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
            $pelatihan_id = filter_input(INPUT_POST, 'pelatihan_id', FILTER_SANITIZE_STRING);

            $sql = /** @lang sql */
                "UPDATE pelatihan SET jenis='$jenis', nama='$name', link='$link$', description='$description$', pelatihan_id='$pelatihan_id' WHERE id='$id'";

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
                window.location.href='../../index.php?page=materi';
                </script>";
            } else {
                $_SESSION['toastr'] = array(
                    'type' => 'warning', // or 'success' or 'info' or 'warning'
                    'message' => 'Error: ' . $db->error,
                    'title' => 'Peringatan'
                );
                echo "<script>
                window.location.href='../../index.php?page=materi';
                </script>";
            }
            break;
    }


}
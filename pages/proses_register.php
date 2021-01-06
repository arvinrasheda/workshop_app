<?php

session_start();
require_once("../conf/connection.php");
include '../helper/GeneralHelper.php';

$helper = new GeneralHelper();
$newOrder = $helper::ORDER_NEW;
if (isset($db)) {
    if (isset($_POST['register'])) {
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password = password_hash(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING), PASSWORD_DEFAULT);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
        $nohp = filter_input(INPUT_POST, 'nohp', FILTER_SANITIZE_STRING);
        $pelatihan_id = filter_input(INPUT_POST, 'pelatihan_id', FILTER_SANITIZE_STRING);

        $userQuery = /** @lang sql */
            "INSERT INTO users (name, username, password, is_active, is_admin) VALUE ('$name', '$username', '$password', 0, 0)";

        if (isset($db)) {

            /*
             * untuk transaction
             * $db->autocommit(false);*/
            $db->autocommit(false);
            $user = mysqli_query($db, $userQuery);

            $userId = $db->insert_id;
            $orderId = 'INV' . $helper->random(7, true);

            $pesertaQuery = /** @lang sql */
                "INSERT INTO peserta (user_id, pelatihan_id, email, nohp, order_id, status) VALUE ('$userId', '$pelatihan_id', '$email', '$nohp', '$orderId', '$newOrder')";
            $peserta = mysqli_query($db, $pesertaQuery);

            if ($user && $peserta) {
                $db->commit();
                $_SESSION['toastr'] = array(
                    'type' => 'success', // or 'success' or 'info' or 'warning'
                    'message' => 'Registrasi Berhasil!',
                    'title' => 'Sukses'
                );
                header('Location: tracking.php?id=' . $orderId);
            } else {
                $db->rollback();
                $_SESSION['toastr'] = array(
                    'type' => 'error', // or 'success' or 'info' or 'warning'
                    'message' => $db->error,
                    'title' => 'Error'
                );
                echo "<script>
                window.location.href='register.php';
                </script>";
            }
        }
    }
}
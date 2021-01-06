<?php

session_start();

include_once("../../conf/connection.php");
require_once("../../auth.php");
include '../../helper/GeneralHelper.php';

$helper = new GeneralHelper();
$newOrder = $helper::ORDER_NEW;

if (isset($_POST['pelatihan'])) {
    $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING);
    switch ($type) {
        case 'create':
            $userId = $_SESSION['user']['id'];
            $orderId = 'INV' . $helper->random(7, true);
            $pelatihan_id = filter_input(INPUT_POST, 'pelatihan_id', FILTER_SANITIZE_STRING);

            $pesertaQuery = /** @lang sql */
                "INSERT INTO peserta (user_id, pelatihan_id, email, nohp, order_id, status) VALUE ('$userId', '$pelatihan_id', '', '', '$orderId', '$newOrder')";

            if (isset($db)) {
                $check = mysqli_query($db, "SELECT * FROM peserta WHERE user_id = '$userId' AND pelatihan_id = '$pelatihan_id'");
                if (mysqli_num_rows($check) > 0) {
                    $_SESSION['toastr'] = array(
                        'type' => 'warning', // or 'success' or 'info' or 'warning'
                        'message' => 'Error: Maaf Anda Sudah mengikuti Pelatihan yang dipilih!',
                        'title' => 'Peringatan'
                    );
                    echo "<script>
                            window.location.href='../../index.php?page=pelatihan-create';
                            </script>";
                } else {
                    $peserta = mysqli_query($db, $pesertaQuery);
                    if ($peserta) {
                        $_SESSION['toastr'] = array(
                            'type' => 'success', // or 'success' or 'info' or 'warning'
                            'message' => 'Data berhasil ditambah!',
                            'title' => 'Sukses'
                        );
                        header('Location: ../../pages/tracking.php?id=' . $orderId);
                    } else {
                        $_SESSION['toastr'] = array(
                            'type' => 'warning', // or 'success' or 'info' or 'warning'
                            'message' => 'Error: ' . $db->error,
                            'title' => 'Peringatan'
                        );
                        echo "<script>
                            window.location.href='../../index.php?page=pelatihan-create';
                            </script>";
                    }
                }
            }
            break;
    }


}
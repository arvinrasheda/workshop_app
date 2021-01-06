<?php
/*
 * Halaman Routing
 */
$id = 0;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
if (isset($_GET['page'])) {
    $page = $_GET['page']; // init variable $page jika ada
    if ($_SESSION["user"]['is_admin'] == 1) {
        switch ($page) {
            case 'users':
                include 'pages/users/list.php';
                break;
            case 'users-create':
                include 'pages/users/create.php';
                break;
            case 'users-edit':
                include 'pages/users/edit.php';
                break;
            case 'workshop':
                include 'pages/workshop/list.php';
                break;
            case 'workshop-create':
                include 'pages/workshop/create.php';
                break;
            case 'workshop-edit':
                include 'pages/workshop/edit.php';
                break;
            case 'materi':
                include 'pages/materi/list.php';
                break;
            case 'materi-create':
                include 'pages/materi/create.php';
                break;
            case 'materi-edit':
                include 'pages/materi/edit.php';
                break;
            case 'peserta':
                include 'pages/peserta/list.php';
                break;
            case 'peserta-create':
                include 'pages/peserta/create.php';
                break;
            case 'peserta-edit':
                include 'pages/peserta/edit.php';
                break;
            default:
                include "pages/beranda.php";
                break;
        }
    } else {
        switch ($page) {
            case 'pelatihan':
                include 'pages/pelatihan/list.php';
                break;
            case 'pelatihan-view':
                include 'pages/pelatihan/edit.php';
                break;
            case 'pelatihan-create':
                include 'pages/pelatihan/create.php';
                break;
            default:
                include "pages/beranda.php";
                break;
        }
    }
} else { // jika tidak ada param page
    include "pages/beranda.php";
}
?>
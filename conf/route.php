<?php
// Halaman Routing
// cek parameter page ada atau tidak
$id = 0;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
if (isset($_GET['page'])) {
    $page = $_GET['page']; // init variable $page jika ada
    switch ($page) {
        case 'master_workshop':
            include 'pages/workshop/list.php';
            break;
        case 'users':
            include 'pages/users/list.php';
            break;
        case 'users-create':
            include 'pages/users/create.php';
            break;
        case 'users-edit':
            include 'pages/users/edit.php';
            break;
    }
} else { // jika tidak ada param page
    include "pages/beranda.php";
}
?>
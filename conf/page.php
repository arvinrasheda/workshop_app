<?php
if(isset($_GET['page'])){
  $page = $_GET['page'];
switch ($page) {
// Beranda
  case 'master_workshop':
    include 'pages/workshop/list.php';
    break;
//   case 'register':
//     include 'pages/register.php';
//     break;
  }
}else{
    include "pages/beranda.php";
  }
?>
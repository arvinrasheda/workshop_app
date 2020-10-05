<?php
if(isset($_GET['page'])){
  $page = $_GET['page'];
switch ($page) {
// Beranda
  case 'master_workshop':
    include 'pages/workshop/list.php';
    break;
   case 'users':
     include 'pages/users/list.php';
     break;
  }
}else{
    include "pages/beranda.php";
  }
?>
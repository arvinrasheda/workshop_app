<?php
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = "workshop";

try {
    $mysqli = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
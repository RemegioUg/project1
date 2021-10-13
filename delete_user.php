<?php
require_once 'connection.php';
$con->query("DELETE FROM `users` WHERE `email` = '$_GET[users]'") or die();

header('location:Admin.php');
?>


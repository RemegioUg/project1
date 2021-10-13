<?php
require_once 'connection.php';
$con->query("DELETE FROM `food_category` WHERE `food` = '$_GET[food_category]'") or die();

header('location:Food.php');
?>


<?php
require_once "db/config.php";
check_login();

$id = $_GET['id'];
$status = $_GET['status'];
$query = "UPDATE users SET status = $status WHERE id=$id";
mysqli_query($conn,$query);
header("Location: users.php");


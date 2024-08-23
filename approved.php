<?php
require_once "db/config.php";
check_login();

$id = $_GET['id'];
$status = $_GET['status'];
$query = "UPDATE receipts SET status = $status WHERE id=$id";
mysqli_query($conn,$query);
header("Location: receipts.php");


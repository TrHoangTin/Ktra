<?php
include '../config/config.php';

$MaDK = $_GET['MaDK'];
$MaHP = $_GET['MaHP'];

$conn->query("DELETE FROM ChiTietDangKy WHERE MaDK='$MaDK' AND MaHP='$MaHP'");
header("Location: cart.php");
?>


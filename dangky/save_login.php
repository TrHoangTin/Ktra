<?php
include '../config/config.php';
session_start();

if (!isset($_SESSION['MaSV'])) {
    header("Location: ../auth/login.php");
    exit();
}

$MaSV = $_SESSION['MaSV'];
$NgayDK = date("Y-m-d");

// Kiểm tra sinh viên đã có đăng ký chưa
$check_sql = "SELECT * FROM DangKy WHERE MaSV = '$MaSV'";
$check_result = $conn->query($check_sql);

if ($check_result->num_rows == 0) {
    $conn->query("INSERT INTO DangKy (NgayDK, MaSV) VALUES ('$NgayDK', '$MaSV')");
}

header("Location: thongbao.php");
?>

<?php
include '../config/config.php';
session_start();

if (!isset($_SESSION['MaSV'])) {
    header("Location: ../auth/login.php");
    exit();
}

$MaSV = $_SESSION['MaSV'];
$MaHP = $_GET['MaHP'];

// Kiểm tra số lượng còn chỗ không
$check_slot = $conn->query("SELECT Soluong FROM HocPhan WHERE MaHP='$MaHP'");
$row = $check_slot->fetch_assoc();
if ($row['Soluong'] <= 0) {
    die("Học phần đã hết chỗ!");
}

// Kiểm tra đăng ký
$check_sql = "SELECT * FROM DangKy WHERE MaSV = '$MaSV'";
$check_result = $conn->query($check_sql);

if ($check_result->num_rows == 0) {
    $conn->query("INSERT INTO DangKy (NgayDK, MaSV) VALUES (CURDATE(), '$MaSV')");
    $MaDK = $conn->insert_id;
} else {
    $row = $check_result->fetch_assoc();
    $MaDK = $row['MaDK'];
}

// Thêm học phần vào ChiTietDangKy
$conn->query("INSERT INTO ChiTietDangKy (MaDK, MaHP) VALUES ('$MaDK', '$MaHP')");

// Giảm số lượng sinh viên
$conn->query("UPDATE HocPhan SET Soluong = Soluong - 1 WHERE MaHP = '$MaHP'");

header("Location: ../hocphan/dangkyhocphan.php");
?>

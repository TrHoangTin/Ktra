<?php
include '../config/config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $MaSV = $_SESSION['MaSV'];
    $conn->query("DELETE FROM ChiTietDangKy WHERE MaDK IN (SELECT MaDK FROM DangKy WHERE MaSV = '$MaSV')");
    header("Location: cart.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận xóa</title>
    <script>
        function confirmDelete() {
            if (confirm("Bạn có chắc chắn muốn xóa tất cả không?")) {
                document.getElementById("deleteForm").submit();
            }
        }
    </script>
</head>
<body>
    <form id="deleteForm" method="POST">
        <button type="button" onclick="confirmDelete()">Xóa tất cả</button>
    </form>
</body>
</html>

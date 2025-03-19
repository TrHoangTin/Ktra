<?php
include '../config/config.php';
session_start();

if (!isset($_SESSION['MaSV'])) {
    header("Location: ../auth/login.php");
    exit();
}

$MaSV = $_SESSION['MaSV'];
$sql = "SELECT dk.MaDK, hp.MaHP, hp.TenHP, hp.SoTinChi 
        FROM ChiTietDangKy cdk
        JOIN HocPhan hp ON cdk.MaHP = hp.MaHP
        JOIN DangKy dk ON cdk.MaDK = dk.MaDK
        WHERE dk.MaSV = '$MaSV'";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Giỏ Hàng Học Phần</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        /* ======= Thiết lập chung ======= */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        /* ======= Tiêu đề ======= */
        h2 {
            font-weight: bold;
            margin-bottom: 20px;
        }

        /* ======= Bảng ======= */
        .table {
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .table th {
            text-align: center;
            background-color: #007bff !important;
            color: white !important;
            font-size: 16px;
        }

        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }

        /* ======= Căn giữa nội dung cột ======= */
        .table td, .table th {
            text-align: center;
            vertical-align: middle;
        }

        /* ======= Nút bấm ======= */
        .btn {
            padding: 10px 15px;
            font-size: 14px;
            border-radius: 5px;
            transition: all 0.3s ease-in-out;
        }

        .btn-danger:hover {
            background-color: #dc3545;
            opacity: 0.85;
        }

        .btn-success:hover {
            background-color: #28a745;
            opacity: 0.85;
        }

        .btn-warning:hover {
            background-color: #ffc107;
            opacity: 0.85;
        }

        /* ======= Chỉnh khoảng cách giữa các nút ======= */
        .text-center a {
            margin: 5px;
        }

        /* ======= Responsive cho thiết bị nhỏ ======= */
        @media (max-width: 768px) {
            .table {
                font-size: 14px;
            }

            .btn {
                font-size: 12px;
                padding: 8px 10px;
            }
        }
    </style>
</head>
<body class="container mt-4">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Test1</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="http://localhost/PHP/KtraGiuaKi/sinhvien/">Sinh Viên</a></li>
                    <li class="nav-item"><a class="nav-link" href="http://localhost/PHP/KtraGiuaKi/hocphan/dangkyhocphan.php">Học Phần</a></li>
                    <li class="nav-item"><a class="nav-link active" href="http://localhost/PHP/KtraGiuaKi/hocphan/dangkyhocphan.php">Đăng Kí</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Đăng Nhập</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <h2 class="text-center text-info">Học Phần Đã Đăng Ký</h2>
    <table class="table table-bordered table-hover">
        <thead class="table-primary">
            <tr>
                <th>Mã HP</th>
                <th>Tên Học Phần</th>
                <th>Số Tín Chỉ</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['MaHP'] ?></td>
                    <td><?= $row['TenHP'] ?></td>
                    <td><?= $row['SoTinChi'] ?></td>
                    <td><a href="xoa_hocphan.php?MaDK=<?= $row['MaDK'] ?>&MaHP=<?= $row['MaHP'] ?>" class="btn btn-danger">Xóa</a></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    
    <div class="text-center">
        <a href="luu_dangky.php" class="btn btn-success">Lưu Đăng Ký</a>
        <a href="xoa_toan_bo.php" class="btn btn-warning" onclick="return confirm('Bạn có chắc chắn muốn xóa tất cả không?')">Xóa Tất Cả</a>
    </div>

</body>
</html>

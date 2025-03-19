<?php
include '../config/config.php';

$sql = "SELECT sv.MaSV, sv.HoTen, sv.GioiTinh, sv.NgaySinh, sv.Hinh, nh.TenNganh 
        FROM SinhVien sv 
        JOIN NganhHoc nh ON sv.MaNganh = nh.MaNganh";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách sinh viên</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

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

    <div class="container mt-4">
        <h2 class="text-center text-primary">Danh sách sinh viên</h2>
        <a href="create.php" class="btn btn-success mb-3">Thêm sinh viên</a>
        <table class="table table-bordered table-hover">
            <thead class="table-primary">
                <tr>
                    <th>Mã SV</th>
                    <th>Họ Tên</th>
                    <th>Giới Tính</th>
                    <th>Ngày Sinh</th>
                    <th>Hình Ảnh</th>
                    <th>Ngành</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['MaSV'] ?></td>
                        <td><?= $row['HoTen'] ?></td>
                        <td><?= $row['GioiTinh'] ?></td>
                        <td><?= $row['NgaySinh'] ?></td>
                        <td><img src="../uploads/<?= basename($row['Hinh']) ?>" width="50"></td>
                        <td><?= $row['TenNganh'] ?></td>
                        <td>
                            <a href="edit.php?MaSV=<?= $row['MaSV'] ?>" class="btn btn-warning btn-sm">Sửa</a> 
                            <a href="delete.php?MaSV=<?= $row['MaSV'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa sinh viên này không?');">Xóa</a>
                            <a href="detail.php?MaSV=<?= $row['MaSV'] ?>" class="btn btn-info btn-sm">Chi tiết</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

</body>
</html>

<?php
include '../config/config.php';
session_start();

if (!isset($_SESSION['MaSV'])) {
    header("Location: ../auth/login.php");
    exit();
}

$MaSV = $_SESSION['MaSV'];
$sql = "SELECT * FROM HocPhan";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng Ký Học Phần</title>
    <link rel="stylesheet" href="../assets/css/style.css">

</head>
<body>
    <table border="1">
        <tr>
            <th>Mã Học Phần</th>
            <th>Tên Học Phần</th>
            <th>Số Tín Chỉ</th>
            <th>Số lượng dự kiến</th>
            <th>Hành động</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['MaHP'] ?></td>
                <td><?= $row['TenHP'] ?></td>
                <td><?= $row['SoTinChi'] ?></td>
                <td><?= $row['Soluong'] ?></td>
                <td>
                    <?php if ($row['Soluong'] > 0): ?>
                        <a href="../hocphan/xulydangky.php?MaHP=<?= $row['MaHP'] ?>">Đăng Ký</a>
                    <?php else: ?>
                        Hết chỗ
                    <?php endif; ?>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

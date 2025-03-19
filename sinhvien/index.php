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
</head>
<body>
    <h2>Danh sách sinh viên</h2>
    <a href="create.php">Thêm sinh viên</a>
    <table border="1">
        <tr>
            <th>Mã SV</th>
            <th>Họ Tên</th>
            <th>Giới Tính</th>
            <th>Ngày Sinh</th>
            <th>Hình Ảnh</th>
            <th>Ngành</th>
            <th>Hành động</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['MaSV'] ?></td>
                <td><?= $row['HoTen'] ?></td>
                <td><?= $row['GioiTinh'] ?></td>
                <td><?= $row['NgaySinh'] ?></td>
                <td><img src="../uploads/<?= basename($row['Hinh']) ?>" width="50"></td>
                <td><?= $row['TenNganh'] ?></td>
                <td>
                    <a href="edit.php?MaSV=<?= $row['MaSV'] ?>">Sửa</a> | 
                    <a href="delete.php?MaSV=<?php echo $row['MaSV']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa sinh viên này không?');">Xóa</a>

                    <a href="detail.php?MaSV=<?= $row['MaSV'] ?>">Chi tiết</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

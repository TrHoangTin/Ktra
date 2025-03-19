<?php
include '../config/config.php';

// Kiểm tra nếu MaSV được truyền qua URL
if (isset($_GET['MaSV'])) {
    $MaSV = $_GET['MaSV'];

    $sql = "SELECT sv.*, nh.TenNganh FROM SinhVien sv 
            JOIN NganhHoc nh ON sv.MaNganh = nh.MaNganh
            WHERE MaSV='$MaSV'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Không tìm thấy sinh viên!";
        exit();
    }
} else {
    echo "Mã sinh viên không hợp lệ!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chi Tiết Sinh Viên</title>
    <style>
        /* Thiết lập chung */
        body {
            background-color: #f4f7fc;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        /* Khung chứa thông tin */
        .container {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 50px auto;
            text-align: left;
        }

        /* Tiêu đề */
        h2 {
            color: #007bff;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Định dạng thông tin */
        p {
            font-size: 16px;
            margin: 8px 0;
        }

        strong {
            color: #333;
        }

        /* Ảnh */
        img {
            display: block;
            margin: 10px auto;
            border-radius: 5px;
            border: 2px solid #ddd;
        }

        /* Nút sửa */
        .btn-edit {
            display: block;
            background-color: #28a745;
            color: white;
            padding: 10px;
            text-decoration: none;
            text-align: center;
            border-radius: 5px;
            font-weight: bold;
            transition: 0.3s;
            margin-top: 15px;
        }

        .btn-edit:hover {
            background-color: #218838;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .container {
                padding: 20px;
            }

            p {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Thông Tin Chi Tiết Sinh Viên</h2>
        <p><strong>Mã SV:</strong> <?= $row['MaSV'] ?></p>
        <p><strong>Họ Tên:</strong> <?= $row['HoTen'] ?></p>
        <p><strong>Giới Tính:</strong> <?= $row['GioiTinh'] ?></p>
        <p><strong>Ngày Sinh:</strong> <?= $row['NgaySinh'] ?></p>
        <p><strong>Ngành:</strong> <?= $row['TenNganh'] ?></p>
        <p><img src="../uploads/<?= basename($row['Hinh']) ?>" width="150"></p>
        <a href="edit.php?MaSV=<?= $row['MaSV'] ?>" class="btn-edit">Sửa</a>
    </div>
</body>
</html>

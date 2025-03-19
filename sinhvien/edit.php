<?php
include '../config/config.php';

// Kiểm tra nếu MaSV được truyền qua URL
if (isset($_GET['MaSV'])) {
    $MaSV = $_GET['MaSV'];

    $sql = "SELECT * FROM SinhVien WHERE MaSV='$MaSV'";
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $HoTen = $_POST['HoTen'];
    $GioiTinh = $_POST['GioiTinh'];
    $NgaySinh = $_POST['NgaySinh'];
    $MaNganh = $_POST['MaNganh'];

    $sql = "UPDATE SinhVien SET HoTen='$HoTen', GioiTinh='$GioiTinh', NgaySinh='$NgaySinh', MaNganh='$MaNganh' WHERE MaSV='$MaSV'";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sửa Sinh Viên</title>
    <style>
        /* Thiết lập chung */
        body {
            background-color: #f4f7fc;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Khung chứa form */
        .container {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 50px auto;
            text-align: center;
        }

        /* Tiêu đề */
        h2 {
            color: #007bff;
            font-weight: bold;
            margin-bottom: 20px;
        }

        /* Nhãn */
        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
            text-align: left;
        }

        /* Input và Select */
        input[type="text"], 
        input[type="date"], 
        select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: 0.3s;
        }

        input:focus, select:focus {
            border-color: #007bff;
            box-shadow: 0px 0px 5px rgba(0, 123, 255, 0.5);
            outline: none;
        }

        /* Nút */
        .button-group {
            margin-top: 20px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
            width: 48%;
            text-align: center;
            transition: 0.3s;
            cursor: pointer;
            border: none;
        }

        .btn-save {
            background-color: #28a745;
            color: white;
        }

        .btn-save:hover {
            background-color: #218838;
        }

        .btn-cancel {
            background-color: #dc3545;
            color: white;
        }

        .btn-cancel:hover {
            background-color: #c82333;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .container {
                padding: 20px;
            }

            .btn {
                width: 100%;
                margin-top: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Sửa Thông Tin Sinh Viên</h2>
        <form method="post">
            <label for="HoTen">Họ Tên:</label>
            <input type="text" id="HoTen" name="HoTen" value="<?= $row['HoTen'] ?>" required>

            <label for="GioiTinh">Giới Tính:</label>
            <select id="GioiTinh" name="GioiTinh">
                <option value="Nam" <?= $row['GioiTinh'] == 'Nam' ? 'selected' : '' ?>>Nam</option>
                <option value="Nữ" <?= $row['GioiTinh'] == 'Nữ' ? 'selected' : '' ?>>Nữ</option>
            </select>

            <label for="NgaySinh">Ngày Sinh:</label>
            <input type="date" id="NgaySinh" name="NgaySinh" value="<?= $row['NgaySinh'] ?>" required>

            <label for="MaNganh">Ngành:</label>
            <input type="text" id="MaNganh" name="MaNganh" value="<?= $row['MaNganh'] ?>" required>

            <div class="button-group">
                <button type="submit" class="btn btn-save">Lưu</button>
                <a href="index.php" class="btn btn-cancel">Hủy</a>
            </div>
        </form>
    </div>
</body>
</html>

<?php
include '../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $MaSV = $_POST['MaSV'];
    $HoTen = $_POST['HoTen'];
    $GioiTinh = $_POST['GioiTinh'];
    $NgaySinh = $_POST['NgaySinh'];
    $MaNganh = $_POST['MaNganh'];
    $Hinh = $_FILES['Hinh']['name'];

    // Đường dẫn lưu ảnh
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($Hinh);
    move_uploaded_file($_FILES["Hinh"]["tmp_name"], $target_file);

    // Thêm dữ liệu vào database
    $sql = "INSERT INTO SinhVien (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh)
            VALUES ('$MaSV', '$HoTen', '$GioiTinh', '$NgaySinh', '$Hinh', '$MaNganh')";

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
    <title>Thêm Sinh Viên</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container mt-5">
        <div class="form-container">
            <h2 class="text-center text-primary">Thêm Sinh Viên</h2>
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="MaSV" class="form-label">Mã Sinh Viên</label>
                    <input type="text" name="MaSV" class="form-control" id="MaSV" required>
                </div>

                <div class="mb-3">
                    <label for="HoTen" class="form-label">Họ Tên</label>
                    <input type="text" name="HoTen" class="form-control" id="HoTen" required>
                </div>

                <div class="mb-3">
                    <label for="GioiTinh" class="form-label">Giới Tính</label>
                    <select name="GioiTinh" class="form-select" id="GioiTinh" required>
                        <option value="Nam">Nam</option>
                        <option value="Nữ">Nữ</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="NgaySinh" class="form-label">Ngày Sinh</label>
                    <input type="date" name="NgaySinh" class="form-control" id="NgaySinh" required>
                </div>

                <div class="mb-3">
                    <label for="Hinh" class="form-label">Ảnh</label>
                    <input type="file" name="Hinh" class="form-control" id="Hinh" required>
                </div>

                <div class="mb-3">
                    <label for="MaNganh" class="form-label">Ngành</label>
                    <select name="MaNganh" class="form-select" id="MaNganh" required>
                        <option value="CNTT">Công nghệ thông tin</option>
                        <option value="QTKD">Quản trị kinh doanh</option>
                    </select>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success">Thêm</button>
                    <a href="index.php" class="btn btn-danger">Quay lại</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

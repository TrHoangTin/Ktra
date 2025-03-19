<?php
include '../config/config.php';
session_start();

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $MaSV = trim($_POST['MaSV']);
    
    $stmt = $conn->prepare("SELECT * FROM SinhVien WHERE MaSV = ?");
    $stmt->bind_param("s", $MaSV);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $_SESSION['MaSV'] = $MaSV;
        header("Location: ../hocphan/dangkyhocphan.php");
        exit();
    } else {
        $error = "Mã Sinh Viên không hợp lệ!";
    }
    
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #fff;
        }
        .container {
            margin-top: 50px;
        }
        .navbar {
            background-color: #222;
        }
        .navbar a {
            color: #fff !important;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Test1</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#">Sinh Viên</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Học Phần</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#">Đăng Kí</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Đăng Nhập</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <h2 class="mt-4">ĐĂNG NHẬP</h2>
        <form method="post" class="mt-3">
            <div class="mb-3">
                <label for="MaSV" class="form-label"><strong>MaSV</strong></label>
                <input type="text" id="MaSV" name="MaSV" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-light border">Đăng Nhập</button>
        </form>
        <a href="#" class="mt-3 d-block">Back to List</a>
    </div>
</body>
</html>
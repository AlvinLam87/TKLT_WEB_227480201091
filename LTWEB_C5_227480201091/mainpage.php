<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (!isset($_SESSION['username']) || !isset($_SESSION['email'])) {
    header("Location: login.html"); // Quay lại trang đăng nhập nếu chưa đăng nhập
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chính</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; padding: 20px; }
        .container { margin: auto; width: 400px; padding: 20px; border: 1px solid #ccc; border-radius: 10px; background-color: #f9f9f9; }
        a { text-decoration: none; color: #007bff; }
        a:hover { color: #0056b3; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Chào mừng!</h2>
        <p>Người dùng đã đăng nhập với tên: <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong></p>
        <p>Email: <strong><?php echo htmlspecialchars($_SESSION['email']); ?></strong></p>
        <p><a href="logout.php">Đăng xuất</a></p>
    </div>
</body>
</html>

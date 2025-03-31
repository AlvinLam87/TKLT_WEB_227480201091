<?php

$customer_name = $_COOKIE['customer_name'] ?? 'Chưa có tên khách hàng';
$customer_phone = $_COOKIE['customer_phone'] ?? 'Chưa có số điện thoại';

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Tin Khách Hàng</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 50px; }
        .container { width: 300px; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; background-color: #f9f9f9; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Thông Tin Khách Hàng</h2>
        <p><strong>Tên khách hàng:</strong> <?php echo htmlspecialchars($customer_name); ?></p>
        <p><strong>Số điện thoại:</strong> <?php echo htmlspecialchars($customer_phone); ?></p>
        <a href="login2.html">Quay lại trang đăng nhập</a>
    </div>
</body>
</html>

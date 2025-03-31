<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f9; margin: 0; padding: 0; text-align: center; }
        .container { width: 400px; margin: 50px auto; padding: 20px; background-color: #fff; border: 1px solid #ccc; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { color: #333; }
        input { margin: 10px 0; padding: 10px; width: 90%; border: 1px solid #ddd; border-radius: 5px; }
        button { padding: 10px 20px; background-color: #007bff; color: #fff; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background-color: #0056b3; }
        .message { margin-top: 20px; padding: 10px; border-radius: 5px; }
        .success { background-color: #e7f4e4; border: 1px solid #c6e0c0; color: #3c763d; }
        .error { background-color: #f8d7da; border: 1px solid #f5c6cb; color: #842029; }
    </style>
</head>
<body>

<div class="container">
    <h2>Đăng Nhập</h2>
    <form method="post">
        <input type="text" name="username" placeholder="Tên đăng nhập" required><br>
        <input type="password" name="password" placeholder="Mật khẩu" required><br>
        <button type="submit" name="login">Đăng Nhập</button>
    </form>

    <?php
    // Kiểm tra thông tin đăng nhập
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
        $username = trim($_POST["username"]);
        $password = trim($_POST["password"]);

        // Đọc file users.ini để kiểm tra thông tin người dùng
        $users = parse_ini_file("users.ini", true);

        if (isset($users[$username]) && $users[$username]["password"] == $password) {
            // Tạo cookie để duy trì đăng nhập trong 5 phút
            setcookie("loggedInUser", $username, time() + 300); // Cookie hết hạn sau 300 giây
            echo "<div class='message success'>Đăng nhập thành công! Xin chào, $username.</div>";
        } else {
            echo "<div class='message error'>Đăng nhập thất bại! Vui lòng kiểm tra lại thông tin.</div>";
        }
    }

    // Kiểm tra trạng thái cookie
    if (isset($_COOKIE["loggedInUser"])) {
        echo "<div class='message success'>Xin chào, " . $_COOKIE["loggedInUser"] . ". Cookie vẫn còn hiệu lực.</div>";
    } else {
        echo "<div class='message error'>Cookie đã hết hạn. Vui lòng đăng nhập lại.</div>";
    }
    ?>
</div>

</body>
</html>

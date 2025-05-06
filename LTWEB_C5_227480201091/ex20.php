<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }
        .login-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        .login-container label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .login-container input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .login-container button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .login-container button:hover {
            background-color: #0056b3;
        }
        .message {
            color: green;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <?php
            // Check if cookie exists and display stored info
            if (isset($_COOKIE['userEmail']) && isset($_COOKIE['userPassword'])) {
                echo "<div class='message'>Thông tin đăng nhập trước đó:<br>";
                echo "Email: " . htmlspecialchars($_COOKIE['userEmail']) . "<br>";
                echo "Mật khẩu: " . htmlspecialchars($_COOKIE['userPassword']) . "</div>";
            }

            // Handle form submission
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $email = htmlspecialchars($_POST['email']);
                $password = htmlspecialchars($_POST['password']);
                $captcha = htmlspecialchars($_POST['captcha']);

                // Basic captcha validation (for demo purposes, assuming "123" is correct)
                if ($captcha !== "123") {
                    echo "<div class='message' style='color: red;'>Mã số không đúng!</div>";
                } elseif (!empty($email) && !empty($password)) {
                    // Set cookies for 3 days (3 * 24 * 60 * 60 seconds)
                    setcookie('userEmail', $email, time() + (3 * 24 * 60 * 60));
                    setcookie('userPassword', $password, time() + (3 * 24 * 60 * 60));
                    echo "<div class='message'>Đăng nhập thành công!<br>Email: $email<br>Mật khẩu: $password</div>";
                } else {
                    echo "<div class='message' style='color: red;'>Vui lòng điền đầy đủ thông tin!</div>";
                }
            }
        ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">Mật khẩu:</label>
            <input type="password" id="password" name="password" required>

            <label for="captcha">Mã số:</label>
            <input type="text" id="captcha" name="captcha" required>
            
            <button type="submit">Đăng nhập</button>
        </form>
    </div>
</body>
</html>
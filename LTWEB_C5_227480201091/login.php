<?php
session_start();

$username = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';


$valid_user = 'lamdien';
$valid_email = 'lamdien@gmail.com';
$valid_password = '123456';

if ($username === $valid_user && $email === $valid_email && $password === $valid_password) {
   
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;


    echo "<p style='color:green; text-align: center;'>Đăng nhập thành công! Chào mừng $username.</p>";
    echo "
    <form action='mainpage.php' method='get' style='text-align: center;'>
        <button type='submit' style='padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;'>Chuyển tới trang chính</button>
    </form>
    ";
} else {
    echo "<p style='color:red; text-align: center;'>Thông tin đăng nhập không hợp lệ. Vui lòng thử lại!</p>";
    echo "<p style='text-align: center;'><a href='login.html'>Quay lại trang đăng nhập</a></p>";
}
?>

<?php
session_start();
session_destroy(); // Xóa session để đăng xuất
header("Location: login.html"); // Quay lại trang đăng nhập
exit();
?>

<?php
$host = "localhost";
$dbname = "quan_ly_nhan_su";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec("SET CHARACTER SET utf8");
} catch (PDOException $e) {
    echo "Kết nối thất bại: " . $e->getMessage();
}
?>
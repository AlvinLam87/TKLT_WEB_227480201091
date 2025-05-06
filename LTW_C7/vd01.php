<?php
$servername = "localhost";
$database = "quanlysinhvien";
$username = "root";
$password = "123456";
//create connection
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("connection failed: ".mysqli_connect_error());
}
echo " connection successfully";
mysqli_close($conn);
?>
<?php 
$username = "student";
$password = "123456";
$servername = "localhost";
$database = "quanlysinhvien";
$connection = mysqli_connect($servername, $username, $password, $database);
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
    exit();
}
$msv="";
$hoten="";
$ngaysinh="";
$nganhhoc="";
$tongdiem="";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $msv = $_POST["msv"];
    $hoten = $_POST["hoten"];
    $ngaysinh = $_POST["ngaysinh"];
    $nganhhoc = $_POST["nganhhoc"];
    $tongdiem = $_POST["tongdiem"];
}
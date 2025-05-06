<?php
$sql = "SELECT msv, hoten FROM danhsach";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    echo("Mã SV: " . $row['msv'] . ", Họ tên: " . $row['hoten'] . "<br/>");
}

mysqli_free_result($result);
mysqli_close($conn);
?>
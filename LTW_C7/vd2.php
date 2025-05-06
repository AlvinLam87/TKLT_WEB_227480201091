<?php
// Thực hiện câu lệnh SELECT
$sql = "SELECT * FROM danhsach";
$result = mysqli_query($conn, $sql);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            echo $row["masv"];
            echo $row["hoten"];
            echo $row["ngaysinh"];
            echo $row["nganhhoc"];
            echo $row["tongdiem"];
        }
        // Giải phóng bộ nhớ của biến
        mysqli_free_result($result);
    } else {
        echo "NO Records";
    }
} else {
    echo "Truy vấn thất bại: " . mysqli_error($link);
}

// Đóng kết nối
mysqli_close($conn);
?>
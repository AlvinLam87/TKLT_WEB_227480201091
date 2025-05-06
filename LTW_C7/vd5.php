<?php
$sql = "UPDATE danhsach SET hoten='Ngô Phương' WHERE msv='14DTH1'";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "Cập nhật thành công";
} else {
    echo "Cập nhật thất bại";
}
?>
<?php
$sql = "INSERT INTO danhsach VALUES('14TH01', 'Nguyễn Thị Lan', '12/08/2000', 'Tin học', '25.5')";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "Mẫu tin đã được thêm.";
} else {
    echo "Không thêm được";
}
?>
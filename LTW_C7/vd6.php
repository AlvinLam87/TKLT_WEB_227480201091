<?php
$sql = "DELETE FROM danhsach WHERE msv='14TH01'";
$result = mysqli_query($conn, $sql);
if($result) {
    echo "Xóa thành công";
} else {
    echo "Xóa thất bại";
}

?>
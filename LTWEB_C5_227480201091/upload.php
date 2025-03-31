<?php

$target_dir = "Tailieu/";


if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
}


$target_file = $target_dir . basename($_FILES["uploaded_file"]["name"]);
$upload_ok = 1;


if (file_exists($target_file)) {
    echo "<p style='color:red; text-align:center;'>File đã tồn tại trên server.</p>";
    $upload_ok = 0;
}


if ($upload_ok == 1) {
    if (move_uploaded_file($_FILES["uploaded_file"]["tmp_name"], $target_file)) {
        echo "<p style='color:green; text-align:center;'>File đã được upload thành công: " . htmlspecialchars(basename($_FILES["uploaded_file"]["name"])) . "</p>";
    } else {
        echo "<p style='color:red; text-align:center;'>Có lỗi xảy ra khi upload file. Vui lòng thử lại!</p>";
    }
}
?>

<?php
$target_dir = "BoSuuTap/"; 


if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
}

$files = $_FILES['uploaded_files'];
$total_files = count($files['name']);

echo "<h2 style='text-align:center;'>Kết quả upload file</h2>";
for ($i = 0; $i < $total_files; $i++) {
    $target_file = $target_dir . basename($files["name"][$i]);
    $upload_ok = 1;

  
    if (file_exists($target_file)) {
        echo "<p style='color:red; text-align:center;'>File đã tồn tại: " . htmlspecialchars(basename($files["name"][$i])) . "</p>";
        $upload_ok = 0;
    }

  
    if ($upload_ok == 1) {
        if (move_uploaded_file($files["tmp_name"][$i], $target_file)) {
            echo "<p style='color:green; text-align:center;'>File đã được upload thành công: " . htmlspecialchars(basename($files["name"][$i])) . "</p>";
        } else {
            echo "<p style='color:red; text-align:center;'>Có lỗi xảy ra khi upload file: " . htmlspecialchars(basename($files["name"][$i])) . "</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Hàng Hóa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .form-container {
            width: 300px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-container label {
            display: block;
            margin-bottom: 5px;
        }
        .form-container input, .form-container select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-container button {
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .form-container button:hover {
            background-color: #0056b3;
        }
        .message {
            margin-top: 10px;
            color: green;
        }
        .error {
            margin-top: 10px;
            color: red;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Thêm Hàng Hóa</h2>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                include 'connection.php'; // Include the connection file from Exercise 1

                $ma_hang = htmlspecialchars($_POST['ma_hang']);
                $ten_hang = htmlspecialchars($_POST['ten_hang']);
                $hang_hoa = htmlspecialchars($_POST['hang_hoa']);
                $khach_hang = htmlspecialchars($_POST['khach_hang']);
                $nha_san_xuat = htmlspecialchars($_POST['nha_san_xuat']);
                $hoa_don = htmlspecialchars($_POST['hoa_don']);

                $sql = "INSERT INTO HANGHOA (Ma_hang, Ten_hang, Hang_hoa, Khach_hang, Nha_san_xuat, Hoa_don) 
                        VALUES ('$ma_hang', '$ten_hang', '$hang_hoa', '$khach_hang', '$nha_san_xuat', '$hoa_don')";

                if (mysqli_query($conn, $sql)) {
                    echo "<div class='message'>Thêm hàng hóa thành công!</div>";
                } else {
                    echo "<div class='error'>Lỗi: " . mysqli_error($conn) . "</div>";
                }

                mysqli_close($conn);
            }
        ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="ma_hang">Mã hàng:</label>
            <input type="text" id="ma_hang" name="ma_hang" required>

            <label for="ten_hang">Tên hàng:</label>
            <input type="text" id="ten_hang" name="ten_hang" required>

            <label for="hang_hoa">Hàng hóa:</label>
            <input type="text" id="hang_hoa" name="hang_hoa" required>

            <label for="khach_hang">Khách hàng:</label>
            <input type="text" id="khach_hang" name="khach_hang" required>

            <label for="nha_san_xuat">Nhà sản xuất:</label>
            <input type="text" id="nha_san_xuat" name="nha_san_xuat" required>

            <label for="hoa_don">Hóa đơn:</label>
            <input type="text" id="hoa_don" name="hoa_don" required>

            <button type="submit">Thêm</button>
        </form>
    </div>
</body>
</html>
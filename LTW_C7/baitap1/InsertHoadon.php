<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Hóa Đơn</title>
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
        <h2>Thêm Hóa Đơn</h2>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                include 'connection.php'; // Include the connection file from Exercise 1

                $ma_so = htmlspecialchars($_POST['ma_so']);
                $ten = htmlspecialchars($_POST['ten']);
                $ma_hang = htmlspecialchars($_POST['ma_hang']);
                $gia = htmlspecialchars($_POST['gia']);

                $sql = "INSERT INTO HOADON (Ma_so, Ten, Ma_hang, Gia) 
                        VALUES ('$ma_so', '$ten', '$ma_hang', '$gia')";

                if (mysqli_query($conn, $sql)) {
                    echo "<div class='message'>Thêm hóa đơn thành công!</div>";
                } else {
                    echo "<div class='error'>Lỗi: " . mysqli_error($conn) . "</div>";
                }

                mysqli_close($conn);
            }
        ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="ma_so">Mã số:</label>
            <input type="text" id="ma_so" name="ma_so" required>

            <label for="ten">Tên:</label>
            <input type="text" id="ten" name="ten" required>

            <label for="ma_hang">Mã hàng:</label>
            <input type="text" id="ma_hang" name="ma_hang" required>

            <label for="gia">Giá:</label>
            <input type="number" id="gia" name="gia" required>

            <button type="submit">Thêm</button>
        </form>
    </div>
</body>
</html>
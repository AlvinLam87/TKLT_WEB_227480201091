<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tính USCLN và BSCNN</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        .container { width: 350px; margin: auto; padding: 20px; border: 1px solid #000; border-radius: 10px; }
        input { margin: 5px; padding: 5px; }
        button { margin: 5px; padding: 10px; cursor: pointer; }
    </style>
</head>
<body>

<div class="container">
    <h2>TÍNH USCLN VÀ BSCNN</h2>
    <form method="post">
        Số thứ 1: <input type="number" name="num1" required><br>
        Số thứ 2: <input type="number" name="num2" required><br>
        <button type="submit" name="uscln">USCLN</button>
        <button type="submit" name="bscnn">BSCNN</button>
    </form>

    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $num1 = intval($_POST["num1"]);
    $num2 = intval($_POST["num2"]);

    if (isset($_POST["uscln"])) {
        echo "<p>Kết quả USCLN: " . uscln($num1, $num2) . "</p>";
    }

    if (isset($_POST["bscnn"])) {
        echo "<p>Kết quả BSCNN: " . bscnn($num1, $num2) . "</p>";
    }
}
?>

</div>

</body>
</html>

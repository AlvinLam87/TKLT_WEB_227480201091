<?php
$employees = [
    ["id" => 1, "ho_ten" => "Nguyễn Văn A", "chuc_vu" => "Giảng viên", "don_vi" => "Khoa KT & CN", "ngay_sinh" => "1985-03-15", "dia_chi" => "123 Đường A, TP. Bạc Liêu", "ngay_tao" => "2023-01-10"],
    ["id" => 2, "ho_ten" => "Trần Thị B", "chuc_vu" => "Phó trưởng khoa", "don_vi" => "Khoa Sư phạm", "ngay_sinh" => "1980-07-22", "dia_chi" => "456 Đường B, TP. Bạc Liêu", "ngay_tao" => "2023-02-15"],
    ["id" => 3, "ho_ten" => "Lê Văn C", "chuc_vu" => "Giảng viên", "don_vi" => "Khoa NN&TS", "ngay_sinh" => "1990-11-10", "dia_chi" => "789 Đường C, TP. Bạc Liêu", "ngay_tao" => "2023-03-20"]
];
$salary_records = [];
if (file_exists('salary_records.json')) {
    $salary_records = json_decode(file_get_contents('salary_records.json'), true) ?: [];
}
$results = [];
$search_name = '';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ho_ten'])) {
    $search_name = strtolower(trim($_POST['ho_ten']));
    $employee_ids = array_column(array_filter($employees, function($e) use ($search_name) {
        return strpos(strtolower($e['ho_ten']), $search_name) !== false;
    }), 'id');
    $current_month = date('m');
    $current_year = date('Y');
    $results = array_filter($salary_records, function($r) use ($employee_ids, $current_month, $current_year) {
        return in_array($r['nhanvien_id'], $employee_ids) && $r['thang'] == $current_month && $r['nam'] == $current_year;
    });
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm kiếm hồ sơ lương</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Open+Sans:wght@300;400&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Open Sans', Arial, sans-serif;
            background: linear-gradient(135deg, #f5f8fb, #e6eef7);
            color: #2d3748;
            line-height: 1.8;
        }

        .container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: linear-gradient(90deg, #1a365d, #4dabf7);
            padding: 20px 40px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
            color: white;
            position: sticky;
            top: 0;
            z-index: 1000;
            backdrop-filter: blur(8px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .logo img {
            height: 90px;
            margin-right: 25px;
            border-radius: 10px;
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
        }

        .logo img:hover {
            transform: scale(1.08);
            box-shadow: 0 0 20px rgba(77, 171, 247, 0.5);
        }

        .title h1 {
            font-family: 'Poppins', sans-serif;
            font-size: 32px;
            font-weight: 600;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
        }

        .title h2 {
            font-family: 'Poppins', sans-serif;
            font-size: 20px;
            font-weight: 400;
            color: #f0f4f8;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-profile i {
            font-size: 26px;
            color: #f0f4f8;
            cursor: pointer;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .user-profile i:hover {
            color: #a0aec0;
            transform: scale(1.1);
        }

        .sidebar {
            width: 260px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            background: linear-gradient(180deg, #ffffff, #e6eef7);
            border-right: 1px solid #d1dfe8;
            padding: 35px 20px;
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.08);
            overflow-y: auto;
            transition: transform 0.4s ease;
            animation: sidebarFadeIn 0.6s ease-in-out;
        }

        @keyframes sidebarFadeIn {
            from { opacity: 0; transform: translateX(-20px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .sidebar h3 {
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
            font-weight: 600;
            color: #1a365d;
            margin: 25px 0 12px;
            padding-bottom: 8px;
            border-bottom: 2px solid #2a6eb8;
            display: flex;
            align-items: center;
            transition: color 0.3s ease;
        }

        .sidebar h3 i {
            margin-right: 12px;
            color: #2a6eb8;
            font-size: 18px;
            transition: transform 0.3s ease;
        }

        .sidebar h3:hover i {
            transform: rotate(10deg);
        }

        .sidebar ul {
            list-style: none;
            margin-bottom: 20px;
        }

        .sidebar li {
            padding: 5px 0;
        }

        .sidebar a {
            text-decoration: none;
            color: #4a5568;
            font-size: 14px;
            font-weight: 400;
            display: flex;
            align-items: center;
            padding: 12px 15px;
            border-radius: 10px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .sidebar a:hover {
            background: #2a6eb8;
            color: white;
            transform: translateX(8px);
            box-shadow: 0 4px 15px rgba(42, 110, 184, 0.3);
        }

        .sidebar a i {
            margin-right: 12px;
            font-size: 16px;
            transition: color 0.3s ease;
        }

        .sidebar a:hover i {
            color: white;
        }

        .sidebar a.active {
            background: #2a6eb8;
            color: white;
            box-shadow: 0 4px 15px rgba(42, 110, 184, 0.3);
        }

        .sidebar a.active i {
            color: white;
        }

        main {
            margin-left: 260px;
            padding: 50px;
            flex: 1;
            background: #f5f8fb;
        }

        main h2 {
            font-family: 'Poppins', sans-serif;
            font-size: 24px;
            color: #1a365d;
            margin-bottom: 25px;
            border-bottom: 3px solid #2a6eb8;
            padding-bottom: 10px;
            position: relative;
        }

        main h2::after {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 0;
            width: 50px;
            height: 3px;
            background: #4dabf7;
            transition: width 0.3s ease;
        }

        main h2:hover::after {
            width: 100px;
        }

        form {
            background: rgba(255, 255, 255, 0.9);
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(209, 223, 232, 0.5);
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        form:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(77, 171, 247, 0.2);
            background: rgba(255, 255, 255, 0.95);
        }

        form::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
            background: #2a6eb8;
            transition: transform 0.4s ease;
            transform: scaleY(0);
        }

        form:hover::before {
            transform: scaleY(1);
        }

        form p {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            color: #1a365d;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            font-family: 'Open Sans', sans-serif;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        input:focus {
            border-color: #2a6eb8;
            box-shadow: 0 0 5px rgba(42, 110, 184, 0.3);
            outline: none;
        }

        input[type="submit"] {
            background: #2a6eb8;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        input[type="submit"]:hover {
            background: #1a365d;
            transform: scale(1.05);
        }

        .results {
            background: rgba(255, 255, 255, 0.9);
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            margin-top: 20px;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(209, 223, 232, 0.5);
        }

        .results table {
            width: 100%;
            border-collapse: collapse;
        }

        .results th, .results td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }

        .results th {
            background: #2a6eb8;
            color: white;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
        }

        .results tr:hover {
            background: #f0f4f8;
        }

        .no-results {
            background: rgba(248, 215, 218, 0.9);
            color: #721c24;
            padding: 15px;
            border-radius: 10px;
            margin-top: 20px;
            box-shadow: 0 4px 15px rgba(114, 28, 36, 0.1);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(114, 28, 36, 0.2);
            transition: transform 0.3s ease;
        }

        .no-results:hover {
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 220px;
                transform: translateX(-100%);
                transition: transform 0.4s ease;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            main {
                margin-left: 0;
                padding: 30px 20px;
            }

            header {
                padding: 15px 20px;
            }

            header::before {
                content: "\f0c9";
                font-family: "Font Awesome 5 Free";
                font-weight: 900;
                font-size: 24px;
                margin-right: 15px;
                cursor: pointer;
            }

            .logo img {
                height: 70px;
            }

            .title h1 {
                font-size: 26px;
            }

            .title h2 {
                font-size: 16px;
            }

            .results table {
                font-size: 14px;
            }

            .results th, .results td {
                padding: 8px;
            }

            form {
                padding: 20px;
            }

            input {
                padding: 8px;
            }

            input[type="submit"] {
                padding: 10px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <div style="display: flex; align-items: center;">
                <div class="logo">
                    <img src="logo_baclieu.png" alt="Logo Đại học Bạc Liêu">
                </div>
                <div class="title">
                    <h1>BAC LIEU UNIVERSITY</h1>
                    <h2>QUẢN LÝ NHÂN SỰ</h2>
                </div>
            </div>
            <div class="user-profile">
                <i class="fas fa-user-circle"></i>
            </div>
        </header>

        <nav class="sidebar">
            <h3><i class="fas fa-home"></i><a href="index.php">Trang chủ</a></h3>
            <h3><i class="fas fa-building"></i>Đơn vị trực thuộc</h3>
            <ul>
                <li><a href="khoa_ktcn.php"><i class="fas fa-cogs"></i>Khoa KT & CN</a></li>
                <li><a href="khoa_supham.php"><i class="fas fa-chalkboard-teacher"></i>Khoa Sư phạm</a></li>
                <li><a href="khoa_nnts.php"><i class="fas fa-water"></i>Khoa NN&TS</a></li>
                <li><a href="khoa_kinhte.php"><i class="fas fa-balance-scale"></i>Khoa Kinh tế và Luật</a></li>
            </ul>

            <h3><i class="fas fa-users"></i>Hồ sơ nhân viên</h3>
            <ul>
                <li><a href="danh_sach_nhan_vien.php"><i class="fas fa-list"></i>Danh sách</a></li>
                <li><a href="xem_ho_so.php"><i class="fas fa-eye"></i>Xem hồ sơ</a></li>
                <li><a href="them_ho_so.php"><i class="fas fa-plus"></i>Thêm hồ sơ</a></li>
                <li><a href="sua_ho_so.php"><i class="fas fa-edit"></i>Sửa hồ sơ</a></li>
                <li><a href="xoa_ho_so.php"><i class="fas fa-trash"></i>Xóa hồ sơ</a></li>
                <li><a href="tim_ho_so.php"><i class="fas fa-search"></i>Tìm hồ sơ</a></li>
            </ul>

            <h3><i class="fas fa-money-bill-wave"></i>Quản lý tiền lương</h3>
            <ul>
                <li><a href="bang_luong.php"><i class="fas fa-table"></i>Bảng lương</a></li>
                <li><a href="cap_nhat_ho_so_luong.php"><i class="fas fa-sync-alt"></i>Cập nhật hồ sơ</a></li>
                <li><a href="tim_kiem_luong.php" class="active"><i class="fas fa-search"></i>Tìm kiếm</a></li>
                <li><a href="tinh_luong.php"><i class="fas fa-calculator"></i>Tính lương</a></li>
                <li><a href="tinh_thuong.php"><i class="fas fa-gift"></i>Tính thưởng</a></li>
            </ul>
        </nav>

        <main>
            <h2>Tìm kiếm hồ sơ lương - Tháng <?php echo $current_month; ?>/<?php echo $current_year; ?></h2>
            <form action="tim_kiem_luong.php" method="post">
                <p>
                    <label>Họ tên:</label>
                    <input type="text" name="ho_ten" value="<?php echo htmlspecialchars($search_name); ?>" required>
                </p>
                <p><input type="submit" value="Tìm kiếm"></p>
            </form>

            <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
                <div class="results">
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Họ tên</th>
                            <th>Lương cơ bản (VND)</th>
                            <th>Thưởng (VND)</th>
                            <th>Tổng lương (VND)</th>
                        </tr>
                        <?php if (!empty($results)): ?>
                            <?php foreach ($results as $record): ?>
                                <?php $employee = array_filter($employees, function($e) use ($record) { return $e['id'] == $record['nhanvien_id']; }); ?>
                                <?php $employee = reset($employee); ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($record['nhanvien_id']); ?></td>
                                    <td><?php echo htmlspecialchars($employee['ho_ten']); ?></td>
                                    <td><?php echo number_format($record['luong_co_ban']); ?></td>
                                    <td><?php echo number_format($record['thuong']); ?></td>
                                    <td><?php echo number_format($record['luong_co_ban'] + $record['thuong']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="5">Không tìm thấy hồ sơ lương nào phù hợp với từ khóa "<?php echo htmlspecialchars($search_name); ?>" trong tháng <?php echo $current_month; ?>/<?php echo $current_year; ?>.</td></tr>
                        <?php endif; ?>
                    </table>
                </div>
            <?php endif; ?>
        </main>
    </div>

    <script>
        document.querySelector('header').addEventListener('click', function(e) {
            if (window.innerWidth <= 768) {
                document.querySelector('.sidebar').classList.toggle('active');
            }
        });
    </script>
</body>
</html>
<?php
$employees = [];
if (file_exists('employees.json')) {
    $employees = json_decode(file_get_contents('employees.json'), true) ?: [];
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newEmployee = [
        "id" => count($employees) + 1,
        "ho_ten" => htmlspecialchars($_POST['ho_ten']),
        "chuc_vu" => htmlspecialchars($_POST['chuc_vu']),
        "don_vi" => htmlspecialchars($_POST['don_vi']),
        "ngay_sinh" => htmlspecialchars($_POST['ngay_sinh']),
        "dia_chi" => htmlspecialchars($_POST['dia_chi']),
        "ngay_tao" => date('Y-m-d')
    ];
    $employees[] = $newEmployee;
    file_put_contents('employees.json', json_encode($employees));
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm hồ sơ nhân viên</title>
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
            background: #4dabf7;
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

        .success {
            background: rgba(212, 237, 218, 0.9);
            color: #155724;
            padding: 15px;
            border-radius: 10px;
            margin-top: 20px;
            box-shadow: 0 4px 15px rgba(21, 87, 36, 0.1);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(21, 87, 36, 0.2);
            transition: transform 0.3s ease;
        }

        .success:hover {
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
                <li><a href="cap_nhat_luong.php"><i class="fas fa-sync-alt"></i>Cập nhật hồ sơ</a></li>
                <li><a href="tim_kiem_luong.php"><i class="fas fa-search"></i>Tìm kiếm</a></li>
                <li><a href="tinh_luong.php"><i class="fas fa-calculator"></i>Tính lương</a></li>
                <li><a href="tinh_thuong.php"><i class="fas fa-gift"></i>Tính thưởng</a></li>
            </ul>
        </nav>

        <main>
            <h2>Thêm hồ sơ nhân viên</h2>
            <form action="them_ho_so.php" method="post">
                <p><label>Họ tên:</label><input type="text" name="ho_ten" required></p>
                <p><label>Chức vụ:</label><input type="text" name="chuc_vu" required></p>
                <p><label>Đơn vị:</label><input type="text" name="don_vi" required></p>
                <p><label>Ngày sinh:</label><input type="date" name="ngay_sinh" required></p>
                <p><label>Địa chỉ:</label><input type="text" name="dia_chi" required></p>
                <p><input type="submit" value="Thêm"></p>
            </form>
            <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
                <div class="success">Đã thêm nhân viên: <?php echo htmlspecialchars($_POST['ho_ten']); ?></div>
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
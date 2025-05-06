<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý nhân sự - Đại học Bạc Liêu</title>
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
            background-color: #f5f8fb;
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
            background: linear-gradient(90deg, #1a365d, #3182ce);
            padding: 15px 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            color: white;
            position: sticky;
            top: 0;
            z-index: 1000;
            backdrop-filter: blur(5px);
        }

        .logo img {
            height: 80px;
            margin-right: 20px;
            border-radius: 8px;
            transition: transform 0.3s ease;
        }

        .logo img:hover {
            transform: scale(1.05);
        }

        .title h1 {
            font-family: 'Poppins', sans-serif;
            font-size: 30px;
            font-weight: 600;
        }

        .title h2 {
            font-family: 'Poppins', sans-serif;
            font-size: 18px;
            font-weight: 300;
            color: #e2e8f0;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-profile i {
            font-size: 24px;
            color: #e2e8f0;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .user-profile i:hover {
            color: #a0aec0;
        }

        .sidebar {
            width: 260px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            background: linear-gradient(180deg, #ffffff, #f1f5f9);
            border-right: 1px solid #e2e8f0;
            padding: 30px 20px;
            box-shadow: 3px 0 15px rgba(0, 0, 0, 0.05);
            overflow-y: auto;
            transition: transform 0.3s ease;
        }

        .sidebar h3 {
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
            font-weight: 600;
            color: #1a365d;
            margin: 20px 0 10px;
            padding-bottom: 8px;
            border-bottom: 2px solid #3182ce;
            display: flex;
            align-items: center;
        }

        .sidebar h3 i {
            margin-right: 10px;
            color: #3182ce;
            font-size: 18px;
        }

        .sidebar ul {
            list-style: none;
            margin-bottom: 15px;
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
            padding: 10px 15px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .sidebar a:hover {
            background-color: #3182ce;
            color: white;
            transform: translateX(5px);
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
            padding: 40px;
            flex: 1;
            background: #f5f8fb;
        }

        .intro, .functions {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            margin-bottom: 25px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .intro:hover, .functions:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.1);
        }

        .intro p, .functions p {
            margin-bottom: 15px;
            font-size: 15px;
            color: #4a5568;
        }

        .intro img {
            margin-top: 15px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            width: 100%;
            max-width: 400px;
            height: auto;
            transition: transform 0.3s ease;
        }

        .intro img:hover {
            transform: scale(1.02);
        }

        .functions h2 {
            font-family: 'Poppins', sans-serif;
            font-size: 22px;
            color: #1a365d;
            margin-bottom: 15px;
            border-bottom: 2px solid #3182ce;
            padding-bottom: 8px;
        }

        footer {
            margin-left: 260px;
            padding: 25px 40px;
            background: #1a365d;
            color: #e2e8f0;
            font-size: 14px;
            border-top: 1px solid #2d3748;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        footer p {
            margin-bottom: 5px;
        }

        .footer-socials {
            display: flex;
            gap: 15px;
        }

        .footer-socials a {
            color: #e2e8f0;
            font-size: 18px;
            transition: color 0.3s ease;
        }

        .footer-socials a:hover {
            color: #3182ce;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 220px;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            main, footer {
                margin-left: 0;
            }

            header::before {
                content: "\f0c9";
                font-family: "Font Awesome 5 Free";
                font-weight: 900;
                font-size: 24px;
                margin-right: 15px;
                cursor: pointer;
            }

            .intro img {
                max-width: 100%;
            }

            footer {
                flex-direction: column;
                text-align: center;
                gap: 15px;
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
            <section class="intro">
                <p><strong>Tên tiếng Anh:</strong> BAC LIEU UNIVERSITY</p>
                <p><strong>Tên viết tắt:</strong> Tiếng Việt ĐHBL - Tiếng Anh BLU</p>
                <p>
                    Trường ĐHBL (ĐHBL) là trường đại học công lập, là cơ sở giáo dục đại học đa ngành, đa hệ,
                    được thành lập theo Quyết định số 1558/QĐ-TTg ngày 24/11/2006 của Thủ tướng Chính phủ.
                    Việc thành lập Trường ĐHBL là phù hợp theo ý chí, nguyện vọng của Đảng bộ và nhân dân tỉnh Bạc Liêu...
                </p>
                <img src="truong.jpg" alt="Trường ĐH Bạc Liêu">
            </section>

            <section class="functions">
                <h2>II. CHỨC NĂNG NHIỆM VỤ</h2>
                <p>
                    Về đào tạo: Tổ chức đào tạo đa dạng các cấp trình độ từ cao đẳng, đại học đến sau đại học
                    và tổ chức các loại hình liên thông, vừa học vừa làm, liên kết... nhằm đáp ứng nhu cầu đào tạo
                    ngày càng cao và đa dạng của xã hội, đặc biệt là nguồn nhân lực có chất lượng...
                </p>
                <p>
                    Về khoa học công nghệ: Tổ chức nghiên cứu khoa học định hướng ứng dụng, chú trọng giải quyết các
                    vấn đề cấp bách và lâu dài trong phát triển kinh tế xã hội của địa phương và vùng...
                </p>
            </section>
        </main>

        <footer>
            <div>
                <p><strong>TRƯỜNG ĐẠI HỌC BẠC LIÊU</strong> - Chất lượng - Sáng tạo - Trách nhiệm - Hội nhập</p>
                <p>Điện thoại: 02913822653 | Email: mail@blu.edu.vn</p>
                <p>Địa chỉ: Số 178 đường Võ Thị Sáu, P. 8, TP. Bạc Liêu, Tỉnh Bạc Liêu</p>
            </div>
            <div class="footer-socials">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </footer>
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
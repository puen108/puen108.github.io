<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ร้านอาหาร Eat at X</title>
    <link href="bootstrap5/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap5/jquery-3.4.1.min.js"></script>
    <script src="bootstrap5/js/bootstrap.min.js"></script>
    <style>
        .navbar-custom {
            background: linear-gradient(to right,rgb(12, 154, 249),rgb(123, 254, 210)), url('your-image.jpg') no-repeat center center;
            box-shadow: 0 4px 6px rgba(14, 14, 14, 0.73);
        }
        .navbar-custom .navbar-brand {
            color:rgb(255, 255, 255); /* สีของชื่อแบรนด์ */
        }
        .navbar-custom .navbar-brand img {
            border-radius: 50%;
            box-shadow: 0 4px 6px rgba(14, 14, 14, 0.73);
        }
        .navbar-custom .nav-link {
            color: #ffffff; /* สีของลิงค์เมนู */
            font-weight: bold;
            margin-left: 15px;
            margin-right: 15px;
            transition: color 0.3s ease;
        }
        .navbar-custom .nav-link:hover,
        .navbar-custom .nav-link.active {
            color: #f8f9fa; /* สีของลิงค์เมนูเมื่อวางเมาส์ */
            background-color: rgba(255, 255, 255, 0.2); /* สีพื้นหลังเมื่อวางเมาส์ */
            border-radius: 4px;
        }
        .navbar-custom .navbar-nav {
            flex-direction: row;
        }
        .navbar-custom .navbar-nav .nav-item {
            margin-left: 15px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom">
        <a class="navbar-brand" href="#">
        <img src="imgs/logo.png" alt="ร้านอาหาร Eat at X" width="100" height="100" style="margin-left: 20px;">
        </a>
        <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="index.php" style="color: black; text-shadow: 4px 4px 4px rgba(0, 0, 0, 0.3);">หน้าหลัก</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="ters.php" style="color: black; text-shadow: 4px 4px 4px rgba(0, 0, 0, 0.3);">ตัวอย่างเมนูอาหาร</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="register.php" style="color: black; text-shadow: 4px 4px 4px rgba(0, 0, 0, 0.3);">สมัครสมาชิก</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="login.php" style="color: black; text-shadow: 4px 4px 4px rgba(0, 0, 0, 0.3);">เข้าสู่ระบบ</a>
        </li>
        </ul>
        </div>
    </nav>
    <!-- เนื้อหาหลักของหน้า -->
    <div class="container mt-4">
        <!-- เนื้อหาจะไปที่นี่ -->
    </div>
</body>
</html>

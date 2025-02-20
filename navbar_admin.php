<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เปลี่ยนรูปภาพ</title>
    <link href="bootstrap5/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap5/jquery-3.4.1.min.js"></script>
    <script src="bootstrap5/js/bootstrap.min.js"></script>
    <style>
        .navbar-custom {
            background: linear-gradient(to right,rgb(12, 154, 249),rgb(123, 254, 210)), url('your-image.jpg') no-repeat center center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }
        .navbar-custom .navbar-brand {
            color: #330033; /* สีของชื่อแบรนด์ */
            font-weight: bold;
        }
        .navbar-custom .navbar-brand img {
            border-radius: 50%;
            margin-right: 10px;
        }
        .navbar-custom .nav-link {
            color: #ffffff; /* สีของลิงค์เมนู */
            margin-left: 15px;
            margin-right: 15px;
            transition: color 0.3s ease;
        }
        .navbar-custom .nav-link:hover,
        .navbar-custom .nav-link.active {
            color: #FFCC00; /* สีของลิงค์เมนูเมื่อวางเมาส์ */
            background-color: rgba(255, 255, 255, 0.2); /* สีพื้นหลังเมื่อวางเมาส์ */
            border-radius: 4px;
        }
        .navbar-custom .navbar-nav {
            flex-direction: row;
        }
        .navbar-custom .navbar-nav .nav-item {
            margin-left: 15px;
        }
        .container {
            padding: 20px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom">
        <a class="navbar-brand" href="#">
            <img src="photo/<?php echo $user_photo; ?>" class="img-circle" width="50" height="50" alt="User Photo">
            <span><?php echo $user_name; ?></span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="admin_user_edit.php" style="color: black; text-shadow: 4px 4px 4px rgba(0, 0, 0, 0.3);">ข้อมูลผู้ใช้งาน</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_photo.php" style="color: black; text-shadow: 4px 4px 4px rgba(0, 0, 0, 0.3);">เปลี่ยนรูปภาพ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_edit.php" style="color: black; text-shadow: 4px 4px 4px rgba(0, 0, 0, 0.3);">แก้ไขข้อมูลส่วนตัว</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php"style="color: black; text-shadow: 4px 4px 4px rgba(0, 0, 0, 0.3);">ออกจากระบบ</a>
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

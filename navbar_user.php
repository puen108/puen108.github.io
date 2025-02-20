<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ร้านอาหาร Eat at X</title>
    <link href="bootstrap5/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap5/jquery-3.4.1.min.js"></script>
    <script src="bootstrap5/js/bootstrap.min.js"></script>
    <!-- เชื่อม Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* Navbar Styling */
        .navbar-custom {
            background: linear-gradient(to right,rgb(12, 154, 249),rgb(123, 254, 210)), url('your-image.jpg') no-repeat center center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.65);
        }
        .navbar-custom .navbar-brand {
            color: #330033;
            font-weight: bold;
            display: flex;
            align-items: center;
        }
        .navbar-custom .navbar-brand img {
            border-radius: 50%;
            margin-right: 10px;
            border: 2px solid #fff;
        }
        .navbar-custom .nav-link {
            color: #fff;
            margin: 0 10px;
            font-size: 1rem;
            transition: color 0.3s ease, background-color 0.3s ease;
        }
        .navbar-custom .nav-link:hover,
        .navbar-custom .nav-link.active {
            color: #FFCC00;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 4px;
        }
        .navbar-custom .navbar-toggler {
            border: none;
        }
        /* Badge Styling */
        .badge-custom {
            background-color: #FFCC00;
            color: #000;
            font-size: 0.9rem;
        }
        /* Content Styling */
        .container {
            padding: 20px;
            background: linear-gradient(to right,rgba(12, 154, 249, 0),rgba(123, 254, 210, 0)), url('your-image.jpg') no-repeat center center;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="photo/<?php echo $user_photo; ?>" alt="User Photo" width="50" height="50">
                <span><?php echo $user_name; ?></span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index_user.php">เลือกดูเมนูอาหาร</a>
                        <?php
        // ตรวจสอบว่ามีการกำหนดตัวแปร $count_cart
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            $count_cart = count($_SESSION['cart']);
        } else {
            $count_cart = 0;
        }
                        if ($count_cart == 0) {
                            echo '<a class="nav-link" href="user_cart.php">ตะกร้าเมนู</a>';
                        } else {
                            echo '<a class="nav-link" href="user_cart.php">ตะกร้าเมนู [ ' . $count_cart . ' รายการ]</a>';
                        }
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="user_edit.php"><i class="bi bi-person"></i> แก้ไขข้อมูลส่วนตัว</a>
                    </li>
                    <li class="nav-item">
                </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php"><i class="bi bi-box-arrow-right"></i> ออกจากระบบ</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        <h1 class="text-center">ยินดีต้อนรับสู่ร้านอาหาร Eat at X</h1>
        <p class="text-center">สามารถเลือกเมนูอาหารได้ตามที่ต้องการ</p>
    </div>
</body>
</html>

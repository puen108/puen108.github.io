<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าหลัก</title>
    <link href="bootstrap5/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap5/jquery-3.4.1.min.js"></script>
    <script src="bootstrap5/js/bootstrap.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
            color: #495057;
            font-family: 'Arial', sans-serif;
        }
        .hero-section {
            background: linear-gradient(to right,rgb(12, 154, 249),rgb(123, 254, 210)), url('your-image.jpg') no-repeat center center;
            background-size: cover;
            height: 100vh;
            color:rgb(0, 0, 0);
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 20px;
        }
        .hero-section h1 {
            font-size: 4rem;
            margin-bottom: 1rem;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }
        .hero-section p {
            font-size: 1.5rem;
            margin-bottom: 2rem;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }
        .btn-custom {
            background-color: #ffffff;
            color: #ff7e5f;
            padding: 10px 20px;
            font-size: 1.2rem;
            border: 2px solid #ffffff;
            border-radius: 25px;
            transition: all 0.3s;
        }
        .btn-custom:hover {
            background-color:rgba(0, 183, 255, 0.61);
            color: #ffffff;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }
        .section-padding {
            padding: 60px 0;
            color:rgb(2, 116, 255)
        }
        .section-header h2 {
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            color:rgb(11, 249, 209);
            font-weight: bold;
        }
        .card {
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            
        }
        .card:hover {
            transform: translateY(-10px);
        }
        .card img {
            border-radius: 8px 8px 0 0;
        }
        .card-body {
            text-align: center;
        }
        .card-body h5 {
            font-size: 1.25rem;
            font-weight: bold;
            color: #495057;
        }
        footer {
            background-color: #343a40;
            color: #ffffff;
            padding: 20px;
        }
        footer p {
            margin: 0;
        }
    </style>
</head>
<body>
    <!-- Navbar Menu -->
    <?php include("navbar.php"); ?>

    <!-- Hero Section -->
    <section class="hero-section">
        <div>
            <h1>Welcome to Eat at X</h1>
            <p>ล็อกอินก่อนสั่งซื้ออาหาร</p>
            <a href="#about" class="btn btn-custom">ช่องทางการติดต่อ</a>
        </div>
    </section>

    <!-- About Section -->
    <section class="section-padding" id="about">
        <div class="container">
            <div class="section-header text-center">
                <h2>ช่องทางการติดต่อ</h2><br>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <img src="imgs/addrass.jpg" class="card-img-top" alt="Feature 1">
                        <div class="card-body">
                        <h5 class="card-title">
                        <a href="https://www.google.com/maps/place/%E0%B8%AA%E0%B8%99%E0%B8%B2%E0%B8%A1%E0%B8%9F%E0%B8%B8%E0%B8%95%E0%B8%9A%E0%B8%AD%E0%B8%A5%E0%B8%AB%E0%B8%8D%E0%B9%89%E0%B8%B2%E0%B9%80%E0%B8%97%E0%B8%B5%E0%B8%A2%E0%B8%A1+X-Arena/@19.8563847,99.8328477,17z/data=!3m1!4b1!4m6!3m5!1s0x30d7090b9ee04167:0x79b9795cef0012c7!8m2!3d19.8563847!4d99.8354226!16s%2Fg%2F11rcq1_3nz?entry=ttu&g_ep=EgoyMDI1MDIwNC4wIKXMDSoASAFQAw%3D%3D" style="text-decoration: none;">
                        แผนที่
                        </a></h5>

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="imgs/line.png" class="card-img-top" alt="Feature 2">
                        <div class="card-body">
                        <h5 class="card-title" style="color:rgb(2, 116, 255);">QRCode LINE</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="imgs/fanpage.png" class="card-img-top" alt="Feature 3">
                        <div class="card-body">
                        <h5 class="card-title">
                        <a href="https://web.facebook.com/eatatx/" style="text-decoration: none;">
                        เพจของทางร้าน
                        </a></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center">
        <p>&copy; 2024 เว็บนี้สร้างมาเพื่อการศึกษา หากผิดพลาดประการใดขออภัยไว้ ณ ที่นี้</p>
    </footer>
</body>
</html>

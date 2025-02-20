<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตัวอย่างเมนูอาหาร</title>
    <link href="bootstrap5/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap5/jquery-3.4.1.min.js"></script>
    <script src="bootstrap5/js/bootstrap.min.js"></script>
    <style>
        .content {
            padding: 20px;
        }
        .card {
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(34, 255, 226, 0.76);
        }
        .card img {
            border-radius: 8px 8px 0 0;
        }
        .card-body {
            text-align: center;
        }
        .btn-custom {
            margin: 5px;
        }
        .img-preview {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <!-- Navbar Menu -->
    <?php include("navbar.php"); ?>

    <!-- ส่วนเนื้อหา -->
    <div class="content">
        <div class="container">
            <div class="row">
                <?php
                // เชื่อมต่อฐานข้อมูล
                include("connect.php");

                // ตรวจสอบการเชื่อมต่อฐานข้อมูล
                if (!$db) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // ดึงข้อมูลเมนู
                $sql = "SELECT * FROM product";
                $result = mysqli_query($db, $sql);

                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $product_id = $row["product_id"];
                        $product_name = $row["product_name"];
                        $product_price = $row["product_price"];
                        $product_photo = $row["product_photo"];
                        $sto_id = $row["sto_id"];
                ?>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                        <img src="imgs/<?php echo $product_photo; ?>" alt="" style="width:100%;height:200px;">
                            <h5 class="card-title" style="margin-top: 15px;"><?php echo htmlspecialchars($product_name); ?></h5>
                            <p class="card-text" style="margin-top: 10px;"><?php echo htmlspecialchars($product_price); ?> -.</p>
                            <div class="mb-2">
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    }
                } else {
                    echo "<p>No products found.</p>";
                }

                // ปิดการเชื่อมต่อฐานข้อมูล
                mysqli_close($db);
                ?>
            </div>
        </div>
    </div>

    <script>
        // Function for previewing image before upload (if needed)
        function renderFile(event) {
            const preview = document.getElementById('preview');
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    </script>
</body>
</html>

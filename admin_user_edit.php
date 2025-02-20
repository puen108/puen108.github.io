<?php
    // เริ่มการทำงานการส่งข้อมูลแบบ Session
    session_start();

    // การเชื่อมต่อฐานข้อมูลที่ไฟล์ connect.php
    include("connect.php");

    // ตรวจสอบการเข้าถึงด้วยผู้ใช้ที่ล็อกอินอยู่
    if (!isset($_SESSION["login_username"])) {
        header("Location: login.php");
        exit();
    }

    // นำข้อมูลที่ส่งมาใส่ในตัวแปร
    $login_username = $_SESSION["login_username"];

    // ค้นหาข้อมูลของผู้ใช้ที่ล็อกอิน
    $sql = "SELECT * FROM user WHERE user_username='$login_username'";
    $result = mysqli_query($db, $sql);
    $user = mysqli_fetch_assoc($result);

    $user_name = $user["user_name"];
    $user_photo = $user["user_photo"];
    $db_type = $user["user_type"];

    // ตรวจสอบการแก้ไขข้อมูล
    if (isset($_GET["user_id_edit"])) {
        $user_id_edit = $_GET["user_id_edit"];

        // ค้นหาข้อมูลของผู้ใช้ที่ต้องการแก้ไข
        $sql = "SELECT * FROM user WHERE user_id='$user_id_edit'";
        $result = mysqli_query($db, $sql);
        $edit_user = mysqli_fetch_assoc($result);

        if (isset($_POST["update"])) {
            $username = $_POST["username"];
            $password = $_POST["password"];
            $name = $_POST["name"];

            // อัปเดตข้อมูลผู้ใช้
            $sql = "UPDATE user SET user_username='$username', user_password='$password', user_name='$name' WHERE user_id='$user_id_edit'";
            if (mysqli_query($db, $sql)) {
                header("Location: admin_user.php");
                exit();
            } else {
                echo "เกิดข้อผิดพลาดในการอัปเดตข้อมูล";
            }
        }
    } else {
        header("Location: admin_user.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลผู้ใช้งาน</title>
    <link href="bootstrap5/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap5/jquery-3.4.1.min.js"></script>
    <script src="bootstrap5/js/bootstrap.min.js"></script>
    <style>
        .container {
            margin-top: 20px;
        }
        .card-form {
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }
        .form-group label {
            font-weight: bold;
        }
    </style>
</head>
<body>

    <!-- Navbar Menu -->
    <?php include("navbar_admin.php"); ?>

    <!-- ส่วนเนื้อหา  -->
    <div class="container">
        <div class="card-form">
            <h3 class="mb-4 text-primary"><b>แก้ไขข้อมูลผู้ใช้งาน</b></h3>
            <hr>
            <form method="POST" action="">
                <div class="form-group mb-3">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($edit_user['user_username']); ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" value="<?php echo htmlspecialchars($edit_user['user_password']); ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($edit_user['user_name']); ?>" required>
                </div>
                <button type="submit" name="update" class="btn btn-primary">บันทึก</button>
                <a href="admin_user.php" class="btn btn-secondary">ยกเลิก</a>
            </form>
        </div>
    </div>

</body>
</html>

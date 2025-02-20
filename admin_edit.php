<?php
    // เริ่มการทำงานการส่งข้อมูลแบบ Session
    session_start();

    // การเชื่อมต่อฐานข้อมูลที่ไฟล์ connect.php
    include("connect.php");

    // นำข้อมูลที่ส่งมาใส่ในตัวแปร
    $login_username = $_SESSION["login_username"];
    $login_password = $_SESSION["login_password"];

    // ค้นหาข้อมูลในตารางข้อมูล user.user_username=$login_username
    $sql = "SELECT * FROM user WHERE user_username='$login_username'";
    $result = mysqli_query($db, $sql);
    $user = mysqli_fetch_assoc($result);

    $user_id = $user["user_id"];
    $user_username = $user["user_username"];
    $user_password = $user["user_password"];
    $user_name = $user["user_name"];
    $user_photo = $user["user_photo"];
    $db_type = $user["user_type"];

    // การแก้ไขข้อมูล
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $name = $_POST["name"];

        $sql = "UPDATE user SET user_username='$username', user_password='$password', user_name='$name' WHERE user_id='$user_id'";
        if (mysqli_query($db, $sql)) {
            $_SESSION["login_username"] = $username;
            header("Location: admin_user.php");
            exit();
        } else {
            echo "เกิดข้อผิดพลาดในการอัพเดตข้อมูล";
        }
    }
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลส่วนตัว</title>
    <link href="bootstrap5/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap5/jquery-3.4.1.min.js"></script>
    <script src="bootstrap5/js/bootstrap.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card-form {
            margin: 30px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(32, 222, 255, 0.73);
            background-color: #ffffff;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            font-weight: bold;
        }
        .btn-custom {
            background-color: #FF6600;
            color: #ffffff;
            border: none;
        }
        .btn-custom:hover {
            background-color:rgb(215, 215, 215);
        }
        .btn-reset {
            background-color:rgb(215, 215, 215);
            color: #ffffff;
            border: none;
        }
        .btn-reset:hover {
            background-color:rgb(215, 215, 215);
        }
    </style>
</head>
<body>

    <!-- Navbar Menu -->
    <?php include("navbar_admin.php"); ?>

    <!-- ส่วนเนื้อหา  -->
    <div class="container mt-4">
        <div class="card-form">
            <h3 class="text-center mb-4"><b> แก้ไขข้อมูลส่วนตัว </b></h3>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" value="<?php echo htmlspecialchars($user_username); ?>" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" value="<?php echo htmlspecialchars($user_password); ?>" required>
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($user_name); ?>" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-custom">บันทึก</button>
                    <button type="reset" class="btn btn-reset">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>

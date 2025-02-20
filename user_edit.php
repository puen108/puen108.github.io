<?php
    // เริ่มการทำงานการส่งข้อมูลแบบ Session
    session_start();

    // การเชื่อมต่อฐานข้อมูลที่ไฟล์ connect.php
    include("connect.php");

    // นำข้อมูลที่ส่งมาใส่ในตัวแปร
    $login_username=$_SESSION["login_username"];
    $login_password=$_SESSION["login_password"];

    // ค้นหาข้อมูลในตารางข้อมูล user.user_username=$login_username
    $sql="SELECT * FROM user WHERE user_username='$login_username'";
    $result=mysqli_query($db,$sql);
    while($row=mysqli_fetch_assoc($result)){
        $user_id=$row["user_id"];
        $user_username=$row["user_username"];
        $user_password=$row["user_password"];
        $user_name=$row["user_name"];
        $user_photo=$row["user_photo"];
        $db_type=$row["user_type"];
    }

    // การแก้ไขข้อมูล
    if(isset($_POST["username"])){
        $username=$_POST["username"];
        $password=$_POST["password"];
        $name=$_POST["name"];

        $sql="UPDATE user SET user_username='$username', user_password='$password', user_name='$name' WHERE user_id='$user_id'";
        $result=mysqli_query($db,$sql);
        $_SESSION["login_username"]=$username;
        header("Location: index_user.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลส่วนตัว</title>
    <link rel="stylesheet" href="css/style.css">
    
    <!-- Bootstrap CSS for better styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            padding-top: 30px;
        }
        .card-form {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 500px;
            margin: 0 auto;
        }
        .card-form h3 {
            text-align: center;
            color: #343a40;
            margin-bottom: 20px;
        }
        .card-form label {
            font-weight: bold;
            color: #495057;
        }
        .card-form input[type="text"], .card-form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            font-size: 16px;
        }
        .card-form input[type="submit"], .card-form input[type="reset"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            width: 48%;
            margin: 5px;
        }
        .card-form input[type="submit"]:hover, .card-form input[type="reset"]:hover {
            background-color: #0056b3;
        }
        .card-form .btn-link {
            color: #007bff;
            text-decoration: none;
        }
        .card-form .btn-link:hover {
            color: #0056b3;
        }
        .container {
            max-width: 600px;
            margin-top: 30px;
        }
    </style>
</head>
<body>

    <!-- Navbar Menu -->
    <?php include("navbar_user.php"); ?>

    <!-- ส่วนเนื้อหา  -->
    <div class="container">
        <div class="card-form">
            <h3><b> แก้ไขข้อมูลส่วนตัว</b></h3>
            <hr>
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="Username">Username</label>
                    <input type="text" name="username" value="<?php echo $user_username; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Password">Password</label>
                    <input type="password" name="password" value="<?php echo $user_password; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Name">Name</label>
                    <input type="text" name="name" value="<?php echo $user_name; ?>" required>
                </div>
                <div class="d-flex justify-content-center">
                    <input type="submit" value="บันทึก" class="btn btn-primary">
                    <a href="index_user.php" class="btn btn-secondary">ยกเลิก</a>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

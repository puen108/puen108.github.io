<?php
    // เริ่มการทำงานการส่งข้อมูลแบบ Session
    session_start();

    // การเชื่อมต่อฐานข้อมูลที่ไฟล์ connect.php
    include("connect.php");

    if(isset($_POST["username"])){
        // นำข้อมูลที่ส่งมาใส่ในตัวแปร
        $username=$_POST["username"];
        $password=$_POST["password"];
        $type=$_POST["type"];
        echo "$username / $password / $type";

        // กำหนดค่าเริ่มต้นเป็นค่าว่าง
        $db_username="";
        $db_password="";

        // ค้นหาข้อมูลในตารางข้อมูล user.user_username=$username
        $sql="select * from user where user_username='$username'";
        $result=mysqli_query($db,$sql);
        while($row=mysqli_fetch_assoc($result)){
            $db_username=$row["user_username"];
            $db_password=$row["user_password"];
            $db_type=$row["user_type"];
            echo "<br> $db_username / $db_password";
        }

        // ตรวจสอบตัวแปร
        if($db_username!=""){
            if($db_username==$username and $db_password==$password){
                $_SESSION["login_username"]=$db_username;
                $_SESSION["login_password"]=$db_password;
                if($db_type=="Admin"){
                    header("refresh:0; url=admin_user.php");
                }
                if($db_type=="User"){
                    header("refresh:0; url=index_user.php");
                }
            }else{
                header("refresh:0; url=login.php");
            }
        }else{
            header("refresh:0; url=login.php");
        }
    }

?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ล็อกอิน</title>
    <link href="bootstrap5/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap5/jquery-3.4.1.min.js"></script>
    <script src="bootstrap5/js/bootstrap.min.js"></script>
    <style>
        .card-login {
            background-color:rgb(36, 36, 36);
            border-radius: 8px;
            box-shadow: 0 4px 6px rgb(131, 121, 121);
            padding: 20px;
            max-width: 600px;
            margin: auto;
            margin-top: 50px;
        }
        .card-login img {
            max-width: 100%;
            height: auto;
            border-radius: 50%;
        }
        .button-danger {
            background-color:rgb(96, 96, 96);
            color: white;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
        }
        .button-danger:hover {
            background-color:rgb(52, 52, 52);
        }
    </style>
</head>
<body>

    <!-- Navbar Menu -->
    <?php include("navbar.php"); ?>

    <!-- ส่วนเนื้อหา -->
    <div class="content">
        <div class="container">
            <div class="card-login">
                <div class="row">
                    <div class="col-md-6 text-center">
                        <img src="imgs/logo.png" alt="Logo" width="300" height="300">
                    </div>
                    <div class="col-md-6" style="color: white;">
                        <h2 class="text-center mb-4" ><b> ํ ล็อกอิน  ํ</b></h2>
                        <form method="POST" action="login.php">
                            <div class="mb-3">
                                <label for="type" class="form-label">- ประเภท -</label>
                                <div>
                                    <input type="radio" id="user" name="type" value="User" required>
                                    <label for="user">ลูกค้า</label>
                                    <input type="radio" id="rest" name="type" value="Rest" required>
                                    <label for="rest">ร้านค้า</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="ชื่อผู้ใช้" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="รหัสผ่าน" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="button-danger">Login</button>
                            </div>
                        </form>
                        <?php if (isset($_GET['error']) && $_GET['error'] == 'invalid_credentials'): ?>
                            <div class="alert alert-danger mt-3" role="alert">
                                ข้อมูลการเข้าสู่ระบบไม่ถูกต้อง กรุณาลองอีกครั้ง
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>

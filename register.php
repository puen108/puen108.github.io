<?php
    // การเชื่อมต่อฐานข้อมูลที่ไฟล์ connect.php
    include("connect.php");

    // การบันทึกข้อมูลลงตารางข้อมูล
    if(isset($_POST["username"])){
        $username=$_POST["username"];
        $password=$_POST["password"];
        $name=$_POST["name"];

        if( $username!="" and $password!=""){
            // รับรูปภาพและอัพโหลดรูปภาพ
            $file_name=$_FILES['photo']['name'];
            $file_tmp=$_FILES['photo']['tmp_name'];
            move_uploaded_file($file_tmp,"photo/".$file_name);      

            $sql="INSERT INTO user VALUES(NULL,'$username','$password','$name','$file_name','User')";
            $result=mysqli_query($db,$sql);
            header("refresh:0; url=index.php");
        }else{
            header("refresh:0; url=register.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ลงทะเบียนสมาชิก</title>
    <link href="bootstrap5/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap5/jquery-3.4.1.min.js"></script>
    <script src="bootstrap5/js/bootstrap.min.js"></script>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f9;
        }

        .card-form {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .container {
            margin-top: 50px;
        }

        .form-group label {
            font-weight: bold;
            color: #495057;
        }

        .form-control {
            border-radius: 8px;
            padding: 12px;
            font-size: 16px;
        }

        .preview-img {
            width: 100%;
            max-width: 300px;
            border-radius: 8px;
            margin-top: 10px;
        }

        h3 {
            color: #007bff;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .btn {
            border-radius: 8px;
            padding: 10px 20px;
            font-size: 16px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #4e555b;
        }

        .card-form hr {
            border-top: 2px solid #007bff;
        }

        .text-center {
            margin-top: 20px;
        }

        .input-group-prepend i {
            font-size: 20px;
            color: #007bff;
        }

        .input-group {
            margin-bottom: 20px;
        }
    </style>
    <script>
        function renderFile(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var preview = document.getElementById('preview');
                preview.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</head>
<body>
    <!-- Navbar Menu -->
    <?php include("navbar.php"); ?>

    <!-- ส่วนเนื้อหา -->
    <div class="container">
        <div class="card-form">
            <h3><b>สมัครสมาชิก</b></h3>
            <hr>
            <form method="POST" action="register.php" enctype="multipart/form-data">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control" id="username" name="username" placeholder="ชื่อเข้าใช้งานระบบ" required>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    </div>
                    <input type="password" class="form-control" id="password" name="password" placeholder="รหัสผ่าน" required>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                    </div>
                    <input type="text" class="form-control" id="name" name="name" placeholder="ชื่อ-นามสกุล" required>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-image"></i></span>
                    </div>
                    <input type="file" class="form-control" id="photo" name="photo" accept="image/png, image/gif, image/jpeg" onchange="renderFile(event)">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">บันทึก</button>
                    <button type="reset" class="btn btn-secondary">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

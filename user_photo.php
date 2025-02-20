<?php
    // เริ่มการทำงานการส่งข้อมูลแบบ Session
    session_start();

    // การเชื่อมต่อฐานข้อมูลที่ไฟล์ connect.php
    include("connect.php");

    // ตรวจสอบว่าผู้ใช้ล็อกอินหรือไม่
    if (!isset($_SESSION["login_username"])) {
        header("Location: login.php");
        exit();
    }

    // นำข้อมูลที่ส่งมาใส่ในตัวแปร
    $login_username = $_SESSION["login_username"];
    $login_password = $_SESSION["login_password"];

    // ค้นหาข้อมูลในตารางข้อมูล user.user_username=$login_username
    $sql = "SELECT * FROM user WHERE user_username='$login_username'";
    $result = mysqli_query($db, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        $user_id = $row["user_id"];
        $user_username = $row["user_username"];
        $user_password = $row["user_password"];
        $user_name = $row["user_name"];
        $user_photo = $row["user_photo"];
        $db_type = $row["user_type"];
    } else {
        echo "<script>alert('ไม่พบข้อมูลผู้ใช้'); window.location.href='login.php';</script>";
        exit();
    }

    // การแก้ไขข้อมูลรูปภาพ
    if (isset($_FILES['photo']['name'])) {
        if ($_FILES['photo']['name'] != "") {
            // รับรูปภาพและอัพโหลดรูปภาพ
            $file_name = $_FILES['photo']['name'];
            $file_tmp = $_FILES['photo']['tmp_name'];

            // ตรวจสอบชนิดไฟล์
            $allowed_types = ['image/png', 'image/gif', 'image/jpeg'];
            $file_type = mime_content_type($file_tmp);
            if (in_array($file_type, $allowed_types)) {
                move_uploaded_file($file_tmp, "imgs/" . $file_name);

                $sql = "UPDATE user SET user_photo='$file_name' WHERE user_id='$user_id'";
                mysqli_query($db, $sql);
                echo "<script>alert('อัปโหลดรูปภาพสำเร็จ'); window.location.href='user_photo.php';</script>";
            } else {
                // แสดงไอคอนห้ามจาก Bootstrap
                echo "<script>alert('ไฟล์ที่อัปโหลดไม่ถูกต้อง');</script>";
                echo "<p><i class='bi bi-x-circle' style='color: red; font-size: 30px;'></i> ไฟล์ที่อัปโหลดไม่ถูกต้อง</p>";
            }
        }
    }
?>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    
    <!-- เชื่อมโยง Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- JavaScript แสดงภาพก่อน อัพโหลด-->
    <script>
        var renderFile = function(event) {
            var r = new FileReader();
            r.onload = function() {
                var preview = document.getElementById('preview');
                preview.src = r.result;
            };
            r.readAsDataURL(event.target.files[0]);
        };
    </script>
</head>
<body>

    <!-- Navbar Menu -->
    <?php 
        if (!isset($count_cart)) {
            $count_cart = 0; // กำหนดค่าเริ่มต้นให้ตัวแปร count_cart
        }
        include("navbar_user.php"); 
    ?>

    <!-- ส่วนเนื้อหา  -->
    <div class="content">
    <br><br><br><br>
        
    <!-- แสดง/เปลี่ยนรูปภาพ -->
    <div class="card-form">
        <div class="container">
            <h3><b> เปลี่ยนรูปภาพประจำตัว </b></h3> 
            <hr><br>
            <form method="POST" action="" enctype="multipart/form-data">
                <br><center>
                <img src="photo/<?php echo $user_photo; ?>" class="img-circle" width="300">
                </center><br><hr><br>
                <label for="Image-File">Photo</label>
                <input type="file" name="photo" accept="image/png, image/gif, image/jpeg" onchange="renderFile(event)">
                <center>
                <img id="preview" width="400">  <!-- ส่วนการแสดงรูปภาพที่เลือกมา -->
                </center>
                <br><br>
                <center>
                <input type="submit" value=" บันทึก ">
                <input type="reset" value=" ยกเลิก ">
                </center>
            </form>
        </div>
    </div>
    <br><br>
    <br><br>
    <br><br>

</body>
</html>

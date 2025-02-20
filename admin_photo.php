<?php
    // เริ่มการทำงานการส่งข้อมูลแบบ Session
    session_start();

    // การเชื่อมต่อฐานข้อมูลที่ไฟล์ connect.php
    include("connect.php");

    // นำข้อมูลที่ส่งมาใส่ในตัวแปร
    $login_username=$_SESSION["login_username"];
    $login_password=$_SESSION["login_password"];

    // ค้นหาข้อมูลในตารางข้อมูล user.user_username=$login_username
    $sql="select * from user where user_username='$login_username'";
    $result=mysqli_query($db,$sql);
    while($row=mysqli_fetch_assoc($result)){
        $user_id=$row["user_id"];
        $user_username=$row["user_username"];
        $user_password=$row["user_password"];
        $user_name=$row["user_name"];
        $user_photo=$row["user_photo"];
        $db_type=$row["user_type"];
    }

    // การแก้ไขข้อมูลรูปภาพ
    if(isset($_FILES['photo']['name'])){
        if($_FILES['photo']['name']!=""){
            // รับรูปภาพและอัพโหลดรูปภาพ
            $file_name=$_FILES['photo']['name'];
            $file_tmp=$_FILES['photo']['tmp_name'];
            move_uploaded_file($file_tmp,"photo/".$file_name);      

            $sql="UPDATE user SET user_photo='$file_name' WHERE user_id='$user_id'";
            $result=mysqli_query($db,$sql);
            header("refresh:0; url=admin_photo.php");
        }
    }

?>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    
    <!-- JavaScript แสดงภาพก่อน อัพโหลด-->
    <script>
        var renderFile = function(event) {
            var r = new FileReader();
            r.onload = function(){
                var preview = document.getElementById('preview');
                preview.src = r.result;
            };
            r.readAsDataURL(event.target.files[0]);
        };
    </script>
</head>
<body>

    <!-- Navbar Menu -->
    <?php include("navbar_admin.php"); ?>

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

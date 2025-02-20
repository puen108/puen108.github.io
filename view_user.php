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

    $user_name = $user["user_name"];
    $user_photo = $user["user_photo"];
    $db_type = $user["user_type"];

    // ตรวจสอบสิทธิ์การเข้าถึงของผู้ใช้
    $is_admin = ($db_type === 'Admin'); // ตรวจสอบว่าเป็น Admin หรือไม่

    // ส่วนการลบข้อมูล (สำหรับ Admin เท่านั้น)
    if (isset($_GET["user_id_del"]) && $is_admin) {
        $user_id_del = $_GET["user_id_del"];
        $sql = "DELETE FROM user WHERE user_id='$user_id_del'";
        if (mysqli_query($db, $sql)) {
            header("Location: admin_user.php"); // เปลี่ยนเส้นทางไปยังหน้า admin_user.php หลังจากลบ
            exit();
        } else {
            echo "เกิดข้อผิดพลาดในการลบข้อมูล";
        }
    }
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลผู้ใช้งานระบบ</title>
    <link href="bootstrap5/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap5/jquery-3.4.1.min.js"></script>
    <script src="bootstrap5/js/bootstrap.min.js"></script>
    <style>
        .container {
            margin-top: 20px;
        }
        .card-data {
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .btn-custom {
            background-color: #FF6600;
            color: #ffffff;
            border: none;
        }
        .btn-custom:hover {
            background-color: #e55a00;
        }
        .btn-link {
            color: #FF6600;
        }
        .btn-link:hover {
            color: #e55a00;
        }
        .img-circle {
            border-radius: 50%;
        }
    </style>
</head>
<body>

    <!-- Navbar Menu -->
    <?php include("navbar_admin.php"); ?>

    <!-- ส่วนเนื้อหา  -->
    <div class="container">
        <div class="card-data">
            <h2 class="mb-4 text-primary"><b> ข้อมูลผู้ใช้งานระบบ</b></h2>
            <hr>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ภาพ</th>
                        <th>ชื่อเข้าใช้งาน</th>
                        <th>รหัสผ่าน</th>
                        <th>ชื่อ-นามสกุล</th>
                        <th>ประเภท</th>
                        <th>การจัดการ</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    // ค้นหาข้อมูลในตารางข้อมูล
                    $sql = "SELECT * FROM user ORDER BY user_username ASC";
                    $result = mysqli_query($db, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $user_id = $row["user_id"];
                        $user_username = $row["user_username"];
                        $user_password = $row["user_password"];
                        $user_name = $row["user_name"];
                        $user_photo = $row["user_photo"];
                        $user_type = $row["user_type"];
                        // แสดงข้อมูลทั้งหมด แต่ซ่อนปุ่มแก้ไขและลบถ้าไม่ใช่ Admin
                        echo "<tr>
                            <td align='center'><img src='photo/$user_photo' class='img-circle' width='50' alt='User Photo'></td>
                            <td>$user_username</td>
                            <td>$user_password</td>
                            <td>$user_name</td>
                            <td class='text-center'>$user_type</td>
                            <td class='text-center'>";
                        
                        if ($is_admin) {
                            // แสดงปุ่มแก้ไขและลบเฉพาะ Admin
                            echo "<a href='admin_user_edit.php?user_id_edit=$user_id' class='btn btn-link'><img src='imgs/edit1.png' width='40' alt='Edit'></a>
                                  <a href='admin_user.php?user_id_del=$user_id' class='btn btn-link' onclick='return confirm(\"คุณแน่ใจหรือไม่ว่าต้องการลบข้อมูลนี้?\")'><img src='imgs/del1.png' width='35' alt='Delete'></a>";
                        }
                        
                        echo "</td></tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>

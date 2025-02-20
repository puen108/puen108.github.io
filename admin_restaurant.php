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

    // ส่วนการลบข้อมูล
    if (isset($_GET["res_id_del"])) {
        $res_id_del = $_GET["res_id_del"];
        $sql = "DELETE FROM restaurant WHERE res_id='$res_id_del'";
        mysqli_query($db, $sql);
        header("Location: admin_restaurant.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลร้านค้า</title>
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
        .table1 {
            width: 100%;
            border-collapse: collapse;
        }
        .table1 th, .table1 td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }
        .table1 th {
            background-color: #f8f9fa;
        }
        .table1 td img {
            border-radius: 50%;
        }
        .btn-actions img {
            cursor: pointer;
            transition: opacity 0.3s;
        }
        .btn-actions img:hover {
            opacity: 0.7;
        }
    </style>
</head>
<body>

    <!-- Navbar Menu -->
    <?php include("navbar_admin.php"); ?>

    <!-- ส่วนเนื้อหา  -->
    <div class="container">
        <div class="card-data">
            <h2 class="mb-4 text-primary"><b>ข้อมูลร้านค้า</b></h2>
            <hr>
            <table class="table1">
                <thead>
                    <tr>
                        <th>รูปภาพ</th>
                        <th>ชื่อเข้าใช้งาน</th>
                        <th>รหัสผ่าน</th>
                        <th>ชื่อร้านค้า</th>
                        <th>ที่อยู่</th>
                        <th>เบอร์โทรศัพท์</th>
                        <th>แผนที่</th>
                        <th>การจัดการ</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    // ค้นหาข้อมูลในตารางร้านค้า
                    $sql = "SELECT * FROM restaurant ORDER BY res_id ASC";
                    $result = mysqli_query($db, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $res_id = $row["res_id"];
                        $res_name = $row["res_name"];
                        $res_address = $row["res_address"];
                        $res_tel = $row["res_tel"];
                        $res_map = $row["res_map"];
                        $res_photo = $row["res_photo"];
                        $res_username = $row["res_username"];
                        $res_password = $row["res_password"];
                        echo "<tr>
                            <td><img src='photo/$res_photo' class='img-circle' width='50' alt='Restaurant Photo'></td>
                            <td>$res_username</td>
                            <td>$res_password</td>
                            <td>$res_name</td>
                            <td>$res_address</td>
                            <td>$res_tel</td>
                            <td>$res_map</td>
                            <td class='btn-actions'>
                                <a href='admin_restaurant_edit.php?res_id_edit=$res_id'><img src='imgs/edit1.png' width='40' alt='Edit'></a>
                                <a href='admin_restaurant.php?res_id_del=$res_id'><img src='imgs/del1.png' width='35' alt='Delete'></a>
                            </td>
                        </tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>

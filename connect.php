<?php
    $servername = "localhost";
    $database = "end-project";
    $username = "root";
    $password = "";
    $db = mysqli_connect($servername, $username, $password, $database);
    $db->set_charset("utf8");
    if($db->connect_error) {
        die(" การเชื่อมต่อฐานข้อมูลผิดพลาด : " . $db->connect_error);
    } else {
       // echo "เชื่อมต่อฐานข้อมูล $database เรียบร้อยแล้ว";
    }
?>
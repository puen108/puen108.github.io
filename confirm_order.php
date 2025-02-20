<?php
// เริ่มต้นเซสชัน
session_start();

// การเชื่อมต่อฐานข้อมูล
include("connect.php");

// ตรวจสอบว่าผู้ใช้เข้าสู่ระบบหรือยัง
if (!isset($_SESSION["login_username"])) {
    header("Location: login.php"); // ส่งไปยังหน้า login ถ้ายังไม่ได้เข้าสู่ระบบ
    exit();
}

// รับค่า username จากเซสชัน
$login_username = $_SESSION["login_username"];

// ค้นหาข้อมูลของผู้ใช้
$sql = "SELECT * FROM user WHERE user_username='$login_username'";
$result = mysqli_query($db, $sql);

if (!$result) {
    echo "เกิดข้อผิดพลาดในการค้นหาข้อมูลผู้ใช้: " . mysqli_error($db);
    exit();
}

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $user_id = $row["user_id"];
} else {
    echo "ไม่พบข้อมูลผู้ใช้";
    exit();
}

// ค้นหาสินค้าในตะกร้าสำหรับผู้ใช้
$sql_cart = "SELECT * FROM cart WHERE user_id='$user_id' AND cart_status='SELECT'";
$result_cart = mysqli_query($db, $sql_cart);

if (!$result_cart) {
    echo "เกิดข้อผิดพลาดในการค้นหาเมนูอาหาร: " . mysqli_error($db);
    exit();
}

if (mysqli_num_rows($result_cart) > 0) {
    // สร้างการสั่งซื้อใหม่
    $order_date = date("Y-m-d H:i:s");
    $order_status = "Pending"; // สถานะของคำสั่งซื้อ
    
    // เพิ่มข้อมูลการสั่งซื้อใหม่
    $sql_order = "INSERT INTO orders (user_id, order_date, order_status) VALUES ('$user_id', '$order_date', '$order_status')";
    if (mysqli_query($db, $sql_order)) {
        $order_id = mysqli_insert_id($db); // ดึง id ของคำสั่งซื้อใหม่

        // โอนย้ายข้อมูลจากตะกร้าสินค้าไปยังคำสั่งซื้อ
        while ($row_cart = mysqli_fetch_assoc($result_cart)) {
            $product_id = $row_cart["product_id"];
            $product_number = $row_cart["product_number"];
            $product_price = $row_cart["product_price"];
            $total_price = $product_number * $product_price;

            $sql_order_detail = "INSERT INTO order_details (order_id, product_id, quantity, price, total_price) VALUES ('$order_id', '$product_id', '$product_number', '$product_price', '$total_price')";
            if (!mysqli_query($db, $sql_order_detail)) {
                echo "เกิดข้อผิดพลาดในการเพิ่มข้อมูลคำสั่งซื้อ: " . mysqli_error($db);
                exit();
            }
        }

        // ลบสินค้าจากตะกร้า
        $sql_delete_cart = "DELETE FROM cart WHERE user_id='$user_id' AND cart_status='SELECT'";
        if (!mysqli_query($db, $sql_delete_cart)) {
            echo "เกิดข้อผิดพลาดในการลบเมนูจากตะกร้า: " . mysqli_error($db);
            exit();
        }

        // แสดงข้อความผลลัพธ์
        echo "<h2 style='text-align: center; color: green;'>การสั่งซื้อของคุณสำเร็จแล้ว!</h2>";
        echo "<p style='text-align: center;'>คำสั่งซื้อของคุณได้รับการบันทึกเรียบร้อยแล้ว และจะได้รับการตรวจสอบในไม่ช้า.</p>";
        echo "<p style='text-align: center;'><a href='index_user.php' style='text-decoration: none; color: blue;'>กลับไปยังหน้าหลัก</a></p>";
    } else {
        echo "เกิดข้อผิดพลาดในการสร้างคำสั่งซื้อ: " . mysqli_error($db);
    }
} else {
    // หากไม่มีสินค้าสำหรับการสั่งซื้อ ให้กลับไปที่หน้า cart.php
    header("Location: cart.php"); 
    exit();
}

// ปิดการเชื่อมต่อฐานข้อมูล
mysqli_close($db);
?>

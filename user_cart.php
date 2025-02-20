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
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $user_name = $row["user_name"];
    $user_id = $row["user_id"];
    $user_photo = $row["user_photo"];
    $db_type = $row["user_type"];
} else {
    echo "ไม่พบข้อมูลผู้ใช้";
    exit();
}

// เพิ่มจำนวนเมนู
if (isset($_GET['increase'])) {
    $cart_id = $_GET['increase'];
    $sql = "UPDATE cart SET product_number = product_number + 1 WHERE cart_id = '$cart_id'";
    mysqli_query($db, $sql);
    header("Location: cart.php"); // Refresh the page after updating
    exit();
}

// ลดจำนวนเมนู
if (isset($_GET['decrease'])) {
    $cart_id = $_GET['decrease'];
    // ลดจำนวนถ้ามากกว่า 1
    $sql = "UPDATE cart SET product_number = product_number - 1 WHERE cart_id = '$cart_id' AND product_number > 1";
    mysqli_query($db, $sql);
    header("Location: cart.php"); // Refresh the page after updating
    exit();
}

// ลบเมนูออกจากตะกร้า
if (isset($_GET['delete'])) {
    $cart_id = $_GET['delete'];
    $sql = "DELETE FROM cart WHERE cart_id = '$cart_id'";
    mysqli_query($db, $sql);
    header("Location: cart.php"); // Refresh the page after deleting
    exit();
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>ตะกร้าเมนู</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .content {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            color: #404040;
            border-bottom: 2px solid #f04;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            text-align: auto;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f04;
            color: #fff;
        }
        td img {
            width: 150px;
            height: 100px;
        }
        .button-orange {
            background-color: #f04;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
        }
        .button-orange:hover {
            background-color: #c00;
        }
    </style>
</head>
<body>
    <!-- Navbar Menu -->
    <?php include("navbar_cart.php"); ?>

    <!-- ส่วนเนื้อหา -->
    <div class="content">
        <h2>ตะกร้าเมนู</h2>
            <table>
                <thead>
                    <tr>
                        <th>รูปภาพ</th>
                        <th>ชื่ออาหาร</th>
                        <th>ราคา</th>
                        <th>จำนวน</th>
                        <th>รวม</th>
                        <th>การจัดการเมนู</th>
                    </tr>
                </thead>
            <tbody>
                <?php
                // ค้นหารายการใน Cart
                $sql = "SELECT * FROM cart WHERE user_id='$user_id' AND cart_status='SELECT'";
                $result = mysqli_query($db, $sql);

                $total_amount = 0; // เพื่อคำนวณจำนวนเงินรวมทั้งหมด

                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $cart_id = $row["cart_id"];
                        $product_id = $row["product_id"];
                        $product_number = $row["product_number"];
                        $product_price = $row["product_price"];

                        // ค้นหารายการอาหาร
                        $sql1 = "SELECT * FROM product WHERE product_id='$product_id'";
                        $result1 = mysqli_query($db, $sql1);

                        if ($result1 && mysqli_num_rows($result1) > 0) {
                            while ($row1 = mysqli_fetch_assoc($result1)) {
                                $product_name = $row1["product_name"];
                                $product_photo = $row1["product_photo"];

                                $sum_product = $product_number * $product_price;
                                $total_amount += $sum_product; // รวมยอดเงิน

                                echo "<tr>
                                        <td><img src='imgs/$product_photo' alt='$product_name'></td>
                                        <td>$product_name</td>
                                        <td>$product_price</td>
                                        <td>$product_number</td>
                                        <td>$sum_product</td>
                                            <td>
                                            <a href='cart.php?increase=$cart_id'>เพิ่ม</a>
                                            <a href='cart.php?decrease=$cart_id'>ลด</a>
                                            <a href='cart.php?delete=$cart_id' onclick='return confirm(\"คุณแน่ใจหรือไม่ว่าต้องการลบเมนูนี้?\")'>ลบ</a>
                                        </td>
                                      </tr>";
                            }
                        }
                    }
                } else {
                    echo "<tr><td colspan='6'>ไม่มีเมนูที่เลือกในตะกร้า</td></tr>";
                }
                ?>
                <tr>
                    <td colspan="5" style="text-align: right;">จำนวนเงินทั้งสิ้น</td>
                    <td><?php echo $total_amount; ?> บาท</td>
                </tr>
            </tbody>
        </table>

        <p>
        <a href="confirm_order.php" class="button-orange" style="text-decoration: none;">ยืนยันการสั่งซื้ออาหาร</a>
</p>
    </div>
</body>
</html>
<?php
// เริ่มการทำงานการส่งข้อมูลแบบ Session
session_start();

// การเชื่อมต่อฐานข้อมูลที่ไฟล์ connect.php
include("connect.php");

// นำข้อมูลที่ส่งมาใส่ในตัวแปร
$login_username = $_SESSION["login_username"];
$login_password = $_SESSION["login_password"];

// ค้นหาข้อมูลในตารางข้อมูล user
$sql = "SELECT * FROM user WHERE user_username = ?";
$stmt = $db->prepare($sql);
$stmt->bind_param('s', $login_username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_name = $row["user_name"];
    $user_id = $row["user_id"];
    $user_photo = $row["user_photo"];
    $db_type = $row["user_type"];
}

// บันทึกรายการอาหารลงใน cart
if (isset($_GET["product_id"])) {
    $select_product_id = $_GET["product_id"];
    $quantity = isset($_GET["quantity"]) ? intval($_GET["quantity"]) : 1; // ตรวจสอบและกำหนดค่าเริ่มต้นให้ quantity เป็น 1

    // ค้นหารายการสินค้าที่ส่งมา
    $sql = "SELECT * FROM product WHERE product_id = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param('i', $select_product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    }
    //บันทึกรายการอาหารลงใน crat
    if (isset($_GET["product_id"])){
        $select_product_id = $_GET["product_id"];
        // ค้นหารายการสินค้าที่ส่งมา
        $sql = "SELECT * FROM product WHERE product_id = '$select_product_id'";
        $result = mysqli_query($db, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $product_price = $row["product_price"];
            $sto_id = $row["sto_id"];
        }
       // บันทึกรายการอาหารลงใน Cart
     // บันทึกลงตารางข้อมูล

$sql="INSERT INTO cart VALUES (NULL, '', '$user_id', '$sto_id', '$select_product_id', '1','$product_price', 'SELECT')";
$result=mysqli_query($db,$sql);
if (!$result) {
    echo "ERROR! การบันทึกข้อมูลผิดพลาด กรุณาตรวจสอบ";
} else {
    echo '
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <script>
    setTimeout(function() {
        swal({
            title: "เพิ่มข้อมูลเรียบร้อยแล้ว",
            type: "success"
        }, function() {
            window.location = "index_user.php"; //หน้าที่ต้องการให้กระโดดไป
        });
    }, 1000);
    </script>';
}

   }
   // ค้นหารายการใน cart
   $count_cart=0;
   $sql="select * from cart where user_id='$user_id' and cart_status='SELECT'";
   $result=mysqli_query($db,$sql);
   while($row=mysqli_fetch_assoc($result)){
    $count_cart++;
   }
?>

<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!-- Navbar Menu -->
    <?php include("navbar_user.php"); ?>

    <!-- ส่วนเนื้อหา  -->
    <div class="content container mt-4">
        <!-- Card Images Loop  -->
        <div class="row">
        <?php
            $sql = "SELECT * FROM product";
            $result = mysqli_query($db, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $product_id = $row["product_id"];
                $product_name = $row["product_name"];
                $product_price = $row["product_price"];
                $product_photo = $row["product_photo"];
        ?>
            <div class="col-md-3 mb-4">
                <div class="card">
                    <img src="imgs/<?php echo $product_photo; ?>" class="card-img-top" style="height:200px;" alt="Product Image">
                    <div class="card-body text-center">
                        <h5 class="card-title"><?php echo $product_name; ?></h5>
                        <p class="card-text"><?php echo $product_price; ?> บาท</p>
                        <form method="GET" action="">
                            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                            <div class="form-group">
                                <label for="quantity">จำนวน:</label>
                                <input type="number" name="quantity" value="1" min="1" class="form-control" style="width: 60px; margin: 0 auto;">
                            </div>
                            <input type="submit" class="btn btn-primary" value="เลือก">
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
        </div>
    </div>
</body>
</html>

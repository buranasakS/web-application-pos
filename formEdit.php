<?php
$connect = new mysqli('localhost', 'root', '', 'hardware_store');

if ($connect->connect_error) {
    die("Something wrong.: " . $connect->connect_error);
}

//รับตัวแปร
$P_id = $_POST['P_id'];
$P_img = $_POST['P_img'];
$P_type = $_POST['P_type'] ;
$P_brand = $_POST['P_brand'] ;
$P_name = $_POST['P_name'];
$P_price = $_POST['P_price'];
$P_detail = $_POST['P_detail'];
$P_count = $_POST['P_count'];
$P_promotion = $_POST['P_promotion'];

$date = date("Y-m-d");
$time = date("H:i:s");
$time = $date." / ".$time;



if ($P_img == "") {
    $sql = "UPDATE product
            SET Product_Type = '$P_type', Product_Brand = '$P_brand', Product_name = '$P_name',Product_price = '$P_price'
            ,Product_detail = '$P_detail',Product_qty = '$P_count',Product_promotion = '$P_promotion',updatedAt = '$time'
            WHERE Product_id = '$P_id' ";
    $result = $connect->query($sql);

} else {
    $sql = "UPDATE product
            SET Product_photo = '$P_img' , Product_Type = '$P_type', Product_Brand = '$P_brand', Product_name = '$P_name'
            ,Product_price = '$P_price',Product_detail = '$P_detail',Product_qty = '$P_count',Product_promotion = '$P_promotion',updatedAt = '$time'
            WHERE Product_id = '$P_id' ";
    $result = $connect->query($sql);
    
}

if ($result) {
    echo "<script type='text/javascript'>";
    echo "alert('แก้ไขข้อมูลสำเร็จ') ;";
    echo "window.location = 'product.php'; ";
    echo "</script>";
  }



mysqli_close($connect);






//header("location:product.php?add=pass");
exit();

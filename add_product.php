<?php
$connect = new mysqli('localhost', 'root', '', 'hardware_store');

if ($connect->connect_error) {
  die("Something wrong.: " . $connect->connect_error);
}

/*
if ($_SESSION == NULL) {
  header("location:../login.php");
  exit();
}elseif ($_SESSION["user_level"] != "admin") {
  header("location:../index.php");
  exit();
}
*/

//รับตัวแปร
$P_id = $_POST['P_id'];


//เช็ค
$check = "
SELECT  Product_id 
FROM product  
WHERE Product_id = '$P_id' 
";


$result1 = mysqli_query($connect, $check);
$num = mysqli_num_rows($result1);

if ($num > 0) {
  echo "<script>";
  echo "alert('ข้อมูลซ้ำ กรุณาเพิ่มใหม่อีกครั้ง !');";
  echo "window.history.back();";
  echo "</script>";
} else {

  //เพิ่มข้อมูล
  $sql = "INSERT INTO product (Product_id,Product_photo,Product_Type,Product_Brand,Product_name,Product_price,Product_detail,Product_qty,Product_promotion) 
  VALUES ('" . $_POST["P_id"] . "','" . $_POST["P_img"] . "','" . $_POST["P_type"] . "','" . $_POST["P_brand"] . "','" . $_POST["P_name"] . "'
  ,'" . $_POST["P_price"] . "','" . $_POST["P_detail"] . "','" . $_POST["P_count"] . "','" . $_POST["P_promotion"] . "') ";
  $result = $connect->query($sql);
  
}
mysqli_close($connect);



if ($result) {
  echo "<script type='text/javascript'>";
  echo "alert('เพิ่มข้อมูลสำเร็จ');";
  echo "window.location = 'product.php'; ";
  echo "</script>";
}



//header("location:product.php?add=pass");
exit();

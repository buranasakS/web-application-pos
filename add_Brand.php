<?php
$connect = new mysqli('localhost', 'root', '', 'hardware_store');

if ($connect->connect_error) {
  die("Something wrong.: " . $connect->connect_error);
}



//รับตัวแปร
$B_id = $_POST['B_id'];


//เช็ค
$check = "
SELECT Brand_id 
FROM product_brand  
WHERE Brand_id = '$B_id' 
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
  $sql = "INSERT INTO product_brand (Brand_id, Brand_name) VALUES ('" . $_POST["B_id"] . "','" . $_POST["B_name"] . "') ";
  $result = $connect->query($sql);

  if ($result) {
    echo "<script type='text/javascript'>";
    echo "alert('เพิ่มข้อมูลสำเร็จ');";
    echo "window.location = 'product.php'; ";
    echo "</script>";
  }
  
}
mysqli_close($connect);







//header("location:product.php?add=pass");
exit();




?>
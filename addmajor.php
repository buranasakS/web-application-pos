<?php
$connect = new mysqli('localhost', 'root', '', 'hardware_store');

if ($connect->connect_error) {
  die("Something wrong.: " . $connect->connect_error);
}



//รับตัวแปร
$addmajor = $_POST['addmajor_id'];


//เช็ค
$check = "
SELECT Major_id 
FROM major 
WHERE Major_id  = '$addmajor' 
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
  $sql = "INSERT INTO major  (Major_id ,Major_name) VALUES ('" . $_POST["addmajor_id"] . "','" . $_POST["addmajor_name"] . "') ";
  $result = $connect->query($sql);

  if ($result) {
    echo "<script type='text/javascript'>";
    echo "alert('เพิ่มข้อมูลสำเร็จ');";
    echo "window.location = 'employee.php'; ";
    echo "</script>";
  }
  
}
mysqli_close($connect);







//header("location:product.php?add=pass");
exit();




?>
<?php
$connect = new mysqli('localhost', 'root', '', 'hardware_store');

if ($connect->connect_error) {
  die("Something wrong.: " . $connect->connect_error);
}



//รับตัวแปร
$type_id = $_POST['type_id'];


//เช็ค
$check = "
SELECT Emp_Type_id 
FROM employee_type
WHERE Emp_Type_id   = '$type_id' 
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
  $sql = "INSERT INTO employee_type (Emp_Type_id  ,Emp_Type_name) VALUES ('" . $_POST["type_id"] . "','" . $_POST["type_name"] . "') ";
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
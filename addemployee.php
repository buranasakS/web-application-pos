<?php
$connect = new mysqli('localhost', 'root', '', 'hardware_store');

if ($connect->connect_error) {
  die("Something wrong.: " . $connect->connect_error);
}



//รับตัวแปร
$E_id = $_POST['E_id'];


//เช็ค
$check = "
SELECT 	Emp_id 
FROM employee
WHERE 	Emp_id   = '$E_id' 
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
  $sql = "INSERT INTO employee (Emp_id  ,Emp_name ,Emp_date ,Emp_gender ,Emp_Type_id ,Major_id ) 
  VALUES ('" . $_POST["E_id"] . "','" . $_POST["E_name"] . "','" . $_POST["E_date"] . "','" . $_POST["E_gender"] . "','" . $_POST["E_type"] . "','" . $_POST["E_major"] . "') ";
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
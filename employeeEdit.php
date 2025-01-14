<?php
$connect = new mysqli('localhost', 'root', '', 'hardware_store');

if ($connect->connect_error) {
    die("Something wrong.: " . $connect->connect_error);
}

//รับตัวแปร
$Emp_id = $_POST['Emp_id'];
$Emp_name = $_POST['Emp_name'];
$Emp_gender = $_POST['Emp_gender'] ;
$Emp_date = $_POST['Emp_date'] ;
$Major_id = $_POST['Major_id'];
$Emp_Type_id = $_POST['Emp_Type_id'];

$date = date("Y-m-d");
$time = date("H:i:s");
$time = $date." / ".$time;




    $sql = "UPDATE employee
            SET Emp_name = '$Emp_name',Emp_gender = '$Emp_gender',Emp_date = '$Emp_date',Emp_Type_id = '$Emp_Type_id',Major_id  = '$Major_id',updatedAt = '$time'
            WHERE Emp_id = '$Emp_id' ";
    $result = $connect->query($sql);
echo $Major_id;

if ($result) {
    echo "<script type='text/javascript'>";
    echo "alert('แก้ไขข้อมูลสำเร็จ') ;";
    echo "window.location = 'employee.php'; ";
    echo "</script>";
  }



mysqli_close($connect);






//header("location:product.php?add=pass");
exit();

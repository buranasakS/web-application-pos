<?php
$connect = new mysqli('localhost', 'root', '', 'hardware_store');

if ($connect->connect_error) {
    die("Something wrong.: " . $connect->connect_error);
}

$id = $_GET["id"];

$sql = "DELETE FROM employee WHERE Emp_id   = '$id'";
$query = mysqli_query($connect, $sql);

if (mysqli_affected_rows($connect)) {
    header("location:employee.php?delete=pass");
    exit();
}




mysqli_close($connect);


exit();

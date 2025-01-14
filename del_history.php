<?php
$connect = new mysqli('localhost', 'root', '', 'hardware_store');

if ($connect->connect_error) {
    die("Something wrong.: " . $connect->connect_error);
}

$detail_id = $_GET["id"];

$sql = "DELETE FROM order_detail WHERE detail_id  = '$detail_id'";
$query = mysqli_query($connect, $sql);

if (mysqli_affected_rows($connect)) {
    header("location:history.php?delete=pass");
    exit();
}




mysqli_close($connect);


exit();

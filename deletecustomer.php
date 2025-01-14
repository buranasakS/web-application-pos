<?php
	include('conn.php');
	$id=$_GET['id'];
	$result=mysqli_query($db,"delete from users where id='$id'");
	if($result){
		echo "<script type='text/javascript'>";
		echo "alert('ลบข้อมูลสำเร็จ') ;";
		echo "window.location = 'customer.php'; ";
		echo "</script>";
	}

?>
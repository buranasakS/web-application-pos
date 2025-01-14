<?php
	include('conn.php');
	
	$id=$_GET['id'];
	
	$id=$_POST['id'];
	$fullname=$_POST['fullname'];
	$phone=$_POST['phone'];
	$id_card=$_POST['id_card'];
	
	
	mysqli_query($db,"UPDATE users set id='$id', fullname='$fullname', phone='$phone', id_card='$id_card' where id='$id'");



	if ($result) {
		echo "<script type='text/javascript'>";
		echo "alert('แก้ไขข้อมูลสำเร็จ') ;";
		echo "window.location = 'customer.php'; ";
		echo "</script>";
	  }
	
	  $result = mysqli_query($db,"UPDATE users set id='$id', fullname='$fullname', phone='$phone', id_card='$id_card' where id='$id'");


	  if($result){
		  echo "<script type='text/javascript'>";
		  echo "alert('แก้ไขข้อมูลสำเร็จ') ;";
		  echo "window.location = 'customer.php'; ";
		  echo "</script>";
	  }
?>
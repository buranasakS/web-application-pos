<?php
session_start();


$id_card = "";
$phone    = "";
$fullname    = "";
$errors = array(); 


include("conn.php");


if (isset($_POST['reg_user'])) {

  $id_card = mysqli_real_escape_string($db, $_POST['id_card']);
  $fullname = mysqli_real_escape_string($db, $_POST['fullname']);
  $phone = mysqli_real_escape_string($db, $_POST['phone']);


  if (empty($id_card)) { array_push($errors, "IDCARD is required"); }
  if (empty($fullname)) { array_push($errors, "Fullname is required"); }
  if (empty($phone)) { array_push($errors, "Phone is required"); }
  

  $user_check_query = "SELECT * FROM users WHERE id_card='$id_card' OR phone='$phone' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { 
    if ($user['id_card'] === $id_card) {
      array_push($errors, "IDCARD already exists");
    }

    if ($user['phone'] === $phone) {
      array_push($errors, "Phone already exists");
    }
  }

  if (count($errors) == 0) {
  	$query = "INSERT INTO users (id_card, fullname, phone) 
  			  VALUES('$id_card', '$fullname', '$phone')";
  	mysqli_query($db, $query);
  	$_SESSION['id_card'] = $id_card;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: register.php');
  }
  if($result){
    echo "<script type='text/javascript'>";
		echo "alert('สมัครสมาชิกสำเร็จ') ;";
		echo "window.location = 'customer.php'; ";
		echo "</script>";
  }
}
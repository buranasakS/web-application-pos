<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="sale.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<title>ข้อมูลลูกค้า</title>

</head>



<?php
session_start();
//check session 
if (isset($_SESSION['user'])) {
	$user = $_SESSION['user'];
	$E_type = $_SESSION['Emp_Type'];
} else {
	echo "<script>alert('คุณยังไม่ได้เข้าสู่ระบบ กลับไปยังหน้าเข้าสู่ระบบก่อน')</script>";
	echo "<script>window.open('login.php','_self')</script>";
}

?>

<body>
	<div class="container-fluid" id="head">
		<div class="d-flex flex-row bd-highlight mb-3">
			<div class="p-2 bd-highlight flex_head">
				<img src="img/logo.png" alt="Logo" />
			</div>
			<div class="p-2 bd-highlight flex_head">
				<p>Hardware.Store</p>
			</div>

		</div>

	</div>
	<div class="d-flex flex-row bd-highlight mb-3 box_content">
		<!-------------------กล่องเมนูทางซ้าย-------------------------->
		<div class="p-2 bd-highlight" id="side_left">
			<img src="img/hard_ware.jpg" class="rounded-circle" alt="hard_ware">
			<p class="name_admin"><?php echo $user ?></p>


			<div class="d-flex flex-column bd-highlight mb-3 flex_menu">
				<p>Dashboard</p>
				<div class="p-2 bd-highlight btn_1">
					<button type="button" class="btn btn-secondary btn-lg btn_sideleft"><a href="sales.php">ขายสินค้า</a></button>


				</div>
				<div class="p-2 bd-highlight">
					<button type="button" class="btn btn-secondary btn-lg btn_sideleft"><a href="product.php">จัดการสินค้า</a></button>
				</div>
				<?php if ($E_type == "1") { ?>
					<div class="p-2 bd-highlight">
						<button type="button" class="btn btn-secondary btn-lg btn_sideleft"><a href="employee.php">จัดการพนักงาน</a></button>
					</div>
				<?php } ?>
				<div class="p-2 bd-highlight">
					<button type="button" class="btn btn-secondary btn-lg btn_sideleft"><a href="register.php">สมัครสมาชิกลูกค้า</a></button>
				</div>
				<div class="p-2 bd-highlight">
					<button type="button" class="btn btn-success btn-lg btn_sideleft"><a href="customer.php">จัดการลูกค้า</a></button>
				</div>
				<div class="p-2 bd-highlight">
					<button type="button" class="btn btn-secondary btn-lg btn_sideleft"><a href="history.php">ประวัติการขาย</a></button>
				</div>
				<div class="p-2 bd-highlight">
					<button type="button" class="btn btn-danger btn-lg btn_sideleft"><a href="exit.php">ออกจากระบบ</a></button>
				</div>
			</div>


		</div>


		<div class="p-2 bd-highlight" id="side_right">
			<div class="container">
				<div style="width: 100%; height: 30em; overflow-y: scroll; scrollbar-arrow-color:blue; scrollbar-face-color: #e7e7e7; scrollbar-3dlight-color: #a0a0a0; scrollbar-darkshadow-color:#888888;">
					<span style="font-size:25px; color:black">
						<center><strong>ข้อมูลลูกค้า</strong></center>
					</span>
					<table class="table table_info">
						<thead>
							<th>ลำดับ</th>
							<th>ชื่อ-นามสกุล</th>
							<th>เบอร์โทรศัพท์</th>
							<th>บัตรประจำตัวประชาชน</th>
						</thead>
						<tbody>
							<?php
							include('conn.php');

							$query = mysqli_query($db, "select * from users");
							while ($row = mysqli_fetch_array($query)) {
							?>
								<tr>
									<td><?php echo $row['id']; ?></td>
									<td><?php echo $row['fullname']; ?></td>
									<td><?php echo $row['phone']; ?></td>
									<td><?php echo $row['id_card']; ?></td>


									<td>
										<a href="#edit<?php echo $row['id']; ?>" data-toggle="modal" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> แก้ไข</a> ||
										<a href="#del<?php echo $row['id']; ?>" data-toggle="modal" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> ลบ</a>
										<?php include('customeraction.php'); ?>
									</td>
								</tr>
							<?php
							}

							?>
						</tbody>

					</table>
				</div>
			</div>


		</div>
	</div>








	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>
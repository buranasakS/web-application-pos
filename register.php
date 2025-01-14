<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ขายสินค้า</title>
	<link rel="stylesheet" href="sale.css">

	<!--bootstarp css-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
	<!-----------------------------ส่วน header -------------------------------->
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

	<!--------------------------------------------------------------------------->



	<?php
	//check session 
	if (isset($_SESSION['user'])) {
		$user = $_SESSION['user'];
		$E_type = $_SESSION['Emp_Type'];
	} else {
		echo "<script>alert('คุณยังไม่ได้เข้าสู่ระบบ กลับไปยังหน้าเข้าสู่ระบบก่อน')</script>";
		echo "<script>window.open('login.php','_self')</script>";
	}

	?>





	<!--------------------------------------------ส่วนเนื้อหา------------------------------------------------>
	<div class="d-flex flex-row bd-highlight mb-3 box_content">
		<!-------------------กล่องเมนูทางซ้าย-------------------------->
		<div class="p-2 bd-highlight" id="side_left">
			<img src="img/hard_ware.jpg" class="rounded-circle" alt="img admin">
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
					<button type="button" class="btn btn-success btn-lg btn_sideleft"><a href="register.php">สมัครสมาชิกลูกค้า</a></button>
				</div>
				<div class="p-2 bd-highlight">
					<button type="button" class="btn btn-secondary btn-lg btn_sideleft"><a href="customer.php">จัดการลูกค้า</a></button>
				</div>
				<div class="p-2 bd-highlight">
					<button type="button" class="btn btn-secondary btn-lg btn_sideleft"><a href="history.php">ประวัติการขาย</a></button>
				</div>
				<div class="p-2 bd-highlight">
					<button type="button" class="btn btn-danger btn-lg btn_sideleft"><a href="exit.php">ออกจากระบบ</a></button>
				</div>
			</div>


		</div>
		<!------------------------------------------------------------>



		<!-------------กล่องทางขวา------------>
		<div class="p-2 bd-highlight" id="side_right">
			<form class="modal-content" method="post" action="register.php">
				<?php include('errors.php'); ?>
				<div class="modal-header">
					<h4 class="modal-title mx-auto">Hardware.Store</h4>
				</div>

				<div class="modal-body mx-auto">
					<div class="">
						<h5 class="" style="margin-left: 30%;">สมัครสมาชิก</h5>
					</div>
					<img src="img/logocom.jpg" class="rounded-circle mb-3" style="width: 100%; height: 18em;">
					<div class="mb-3">
						<label class="form-label">หมายเลขบัตรประจำตัวประชาชน</label>
						<input type="text" class="form-control" name="id_card" value="<?php echo $id_card; ?>" required />
					</div>
					<div class="mb-3">
						<label class="form-label">ชื่อ-นามสกุล</label>
						<input type="text" class="form-control" name="fullname" value="<?php echo $fullname; ?>" required />
					</div>
					<div class="mb-3">
						<label class="form-label">เบอร์โทรศัพท์</label>
						<input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>" required />
					</div>

					<button type="submit" class="btn btn-primary " name="reg_user" style="width:100%;margin:auto;">สมัครสมาชิก</button>
				</div>



		</div>
		</form>




	</div>
	<!----------------------------------->



	</div>





	<!---------------------------------------------------------------------------------------------------->

	<!--bootstarp java-->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>
<?php
$connect = new mysqli('localhost', 'root', '', 'hardware_store');

if ($connect->connect_error) {
  die("Something wrong.: " . $connect->connect_error);
}

$sql = "SELECT * FROM product";
$result = mysqli_query($connect, $sql);

?>


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
  session_start();
  //check session 
  if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $Emp_id = $_SESSION['Emp_id'];
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
          <button type="button" class="btn btn-secondary btn-lg btn_sideleft"><a href="customer.php">จัดการลูกค้า</a></button>
        </div>
        <div class="p-2 bd-highlight">
          <button type="button" class="btn btn-success btn-lg btn_sideleft"><a href="history.php">ประวัติการขาย</a></button>
        </div>
        <div class="p-2 bd-highlight">
          <button type="button" class="btn btn-danger btn-lg btn_sideleft"><a href="exit.php">ออกจากระบบ</a></button>
        </div>
      </div>


    </div>
    <!------------------------------------------------------------>


    <?php

    //check session 
    if (isset($_SESSION['Emp_Type'])) {
      $show_Etype = $_SESSION['Emp_Type'];
      $sql_show = "SELECT Emp_Type_name from employee_type WHERE Emp_Type_id='$show_Etype' ";

      $result_Etype = $connect->query($sql_show);
      $row_Etype = mysqli_fetch_array($result_Etype);

      if ($result_Etype->num_rows > 0) {
        $Etype = $row_Etype['Emp_Type_name'];
      }
    }


    if (isset($_SESSION['Major_id'])) {
      $show_Mtype = $_SESSION['Major_id'];
      $sql_showMtype = "SELECT Major_name from major WHERE Major_id='$show_Mtype' ";

      $result_Mtype = $connect->query($sql_showMtype);
      $row_Mtype = mysqli_fetch_array($result_Mtype);

      if ($result_Mtype->num_rows > 0) {
        $Mtype = $row_Mtype['Major_name'];
      }
    }



    ?>


    <!-------------กล่องทางขวา------------>

    <div class="p-2 bd-highlight" id="side_right">
      <form method="POST" action="search_sales.php">
        <div class="d-flex flex-row bd-highlight mb-3">
          <div class="p-2 bd-highlight box_head">
            <label for="branch">สาขา:</label><br>
            <input type="text" id="branch" name="branch" value="<?php echo $Mtype ?>" disabled="disabled">
          </div>
          <div class="p-2 bd-highlight box_head">
            <label for="employee">พนักงาน:</label><br>
            <input type="text" id="employee" name="employee" value="<?php echo $user ?>" disabled="disabled">
          </div>
          <div class="p-2 bd-highlight box_head">
            <label for="position">ตำแหน่ง:</label><br>
            <input type="text" id="position" name="position" value="<?php echo $Etype ?>" disabled="disabled">
          </div>
        </div>
      </form>

     <h3>ประวัติการขาย</h3>
      <div style="width: 100%; height: 32em; overflow-y: scroll; scrollbar-arrow-color:blue; scrollbar-face-color: #e7e7e7; scrollbar-3dlight-color: #a0a0a0; scrollbar-darkshadow-color:#888888">
        <table class="table table_info">
          <thead>
            <tr>
              <th scope="col">รหัสสินค้า</th>
              <th scope="col">จำนวนสินค้าที่ขายไป</th>
              <th scope="col">รายการสินค้า</th>
              <th scope="col">วัน-เวลา</th>
              <th scope="col"></th>
              <!-- <th scope="col">จำนวน</th> -->
            </tr>
          </thead>
          <tbody>
            <?php
            //connect db
            include("conn.php");
            $sql = "SELECT * from order_detail";  //เรียกข้อมูลมาแสดงทั้งหมด
            $result = mysqli_query($db, $sql);
            while ($row = mysqli_fetch_array($result)) { 
              $Product_id = $row['Product_id'];?>
              <tr>
                <td> <?php echo $row["Product_id"] ?></td>
                <td> <?php echo $row["orders_qty"] ?></td>
                <td> 
                  <?php  
                     $sql2 = "SELECT Product_name from product WHERE Product_id = '$Product_id'";  //เรียกข้อมูลมาแสดงทั้งหมด
                     $result2 = mysqli_query($db, $sql2);
                     $row2 = mysqli_fetch_array($result2);
                     echo $row2['Product_name'];
                  ?>
                </td>
                <td> <?php echo $row["createdAt"] ?></td>
                <td>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#del<?php echo $row['detail_id']; ?>">ลบ</button>
                    <div class="modal fade" id="del<?php echo $row['detail_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><b>ยืนยันการลบข้อมูลสินค้า</b></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            คุณต้องการยกเลิก <?php echo $row['Product_name']; ?> ใช่หรือไม่
                          </div>
                          <div class="modal-footer">
                            <?php
                            $id = $row['detail_id'];

                            ?>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                            <button type="button" class="btn btn-primary" onclick="window.location.href='del_history.php?id=<?php echo $id; ?>'">ยืนยัน</button>
                          </div>
                        </div>
                      </div>
                    </div>
                </td>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>


        <!-- sales_detail.php?Product_id=$row[Product_id] -->








      </div>
      <!----------------------------------->

      <!---------------------------------------------------------------------------------------------------->

      <!--bootstarp java-->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>
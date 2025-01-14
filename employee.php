<?php
$connect = new mysqli('localhost', 'root', '', 'hardware_store');

if ($connect->connect_error) {
  die("Something wrong.: " . $connect->connect_error);
}

$sql = "SELECT * FROM employee";
$result = $connect->query($sql);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>พนักงาน</title>
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
    $Emp_type = $_SESSION['Emp_Type'];
  } else {
    echo "<script>alert('คุณยังไม่ได้เข้าสู่ระบบ กลับไปยังหน้าเข้าสู่ระบบก่อน')</script>";
    echo "<script>window.open('login.php','_self')</script>";
  }

  if ($Emp_type != "1") {
    echo "<script>alert('ไม่สามารถเข้าหน้านี้ได้')</script>";
    echo "<script>window.open('sales.php','_self')</script>";
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
            <button type="button" class="btn btn-success btn-lg btn_sideleft"><a href="employee.php">จัดการพนักงาน</a></button>
          </div>
        <?php } ?>
        <div class="p-2 bd-highlight">
          <button type="button" class="btn btn-secondary btn-lg btn_sideleft"><a href="register.php">สมัครสมาชิกลูกค้า</a></button>
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

      <form method="POST" action="search_Emp.php">
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
        <div class="input-group mb-3 btt_search">
          <input type="text" name="txt_keyword" class="form-control" placeholder="ค้นหาชื่อรหัส/ชื่อสินค้า" aria-label="Recipient's username" aria-describedby="button-addon2">
          <?php


          ?>
          <button class="btn btn-outline-secondary" type="submit" id="btt_search">ค้นหา</button>




        </div>

      </form>


      <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#add_data">เพิ่มข้อมูลพนักงาน</button>
      <div class="modal fade" id="add_data" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">


          <form class="modal-content" method="post" action="addemployee.php">
            <div class="modal-header">
              <h5 class="modal-title">เพิ่มข้อมูลพนักงาน</h5>
            </div>
            <div class="modal-body">

              <div class="mb-3">
                <label class="form-label">รหัสพนักงาน</label>
                <input type="text" class="form-control" name="E_id" required />
              </div>
              <div class="mb-3">
                <label class="form-label">ชื่อพนักงาน</label>
                <input type="text" class="form-control" name="E_name" required />
              </div>
              <div class="mb-3">
                <label class="form-label">วันเกิด</label>
                <input type="date" class="form-control" name="E_date" required />
              </div>
              <div class="mb-3">
                <label class="form-label">เพศ</label>
                <input type="text" class="form-control" name="E_gender" required />
              </div>
              <div class="mb-3">
                <label class="form-label">ตำแหน่ง</label>
                <select class="form-select" name="E_type">
                  <?php
                  $sql = "SELECT * FROM employee_type";
                  $result2 = $connect->query($sql);
                  ?>
                  <?php while ($row = $result2->fetch_assoc()) : ?>
                    <option value="<?php echo $row['Emp_Type_id']; ?>"><?php echo $row['Emp_Type_name']; ?></option>
                  <?php endwhile ?>
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label">สาขา</label>
                <select class="form-select" name="E_major">
                  <?php
                  $sql = "SELECT * FROM major";
                  $result3 = $connect->query($sql);
                  ?>
                  <?php while ($row = $result3->fetch_assoc()) : ?>
                    <option value="<?php echo $row['Major_id']; ?>"><?php echo $row['Major_name']; ?></option>
                  <?php endwhile ?>
                </select>
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
              <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
            </div>
          </form>
        </div>


      </div>
      <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addtype">เพิ่มประเภทพนักงาน</button>
      <div class="modal fade" id="addtype" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">


          <form class="modal-content" method="post" action="addemployeetype.php">
            <div class="modal-header">
              <h5 class="modal-title">เพิ่มประเภทพนักงาน</h5>
            </div>
            <div class="modal-body">

              <div class="mb-3">
                <label class="form-label">รหัสพนักงาน</label>
                <input type="text" class="form-control" name="type_id" required />
              </div>
              <div class="mb-3">
                <label class="form-label">ชื่อพนักงาน</label>
                <input type="text" class="form-control" name="type_name" required />
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
              <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
            </div>
          </form>
        </div>
      </div>
      <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addmajor">เพิ่มสาขา</button>
      <div class="modal fade" id="addmajor" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">


          <form class="modal-content" method="post" action="addmajor.php">
            <div class="modal-header">
              <h5 class="modal-title">เพิ่มสาขา</h5>
            </div>
            <div class="modal-body">

              <div class="mb-3">
                <label class="form-label">รหัสสาขา</label>
                <input type="text" class="form-control" name="addmajor_id" required />
              </div>
              <div class="mb-3">
                <label class="form-label">ชื่อสาขา</label>
                <input type="text" class="form-control" name="addmajor_name" required />
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
              <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
            </div>
          </form>
        </div>
      </div>

      <!-- <th scope="col">ภาพสินค้า</th> -->

      <div style="width: 100%; height: 32em; overflow-y: scroll; scrollbar-arrow-color:blue; scrollbar-face-color: #e7e7e7; scrollbar-3dlight-color: #a0a0a0; scrollbar-darkshadow-color:#888888">

        <table class="table table_info">
          <thead>
            <tr>
              <th scope="col">รหัสพนักงาน</th>
              <th scope="col">ชื่อพนักงาน</th>
              <th scope="col">ตำแหน่ง</th>
              <th scope="col">สาขา</th>
            </tr>
          </thead>

          <tbody>

            <?php while ($row = $result->fetch_assoc()) : ?>

              <tr>
                <td>
                  <?php echo $row['Emp_id']; ?>
                </td>
                <td>
                  <?php echo $row['Emp_name']; ?>
                </td>
                <td>
                  <?php
                  $Emp_Type = $row['Emp_Type_id'];
                  $Emptype = "SELECT Emp_Type_name FROM employee_type WHERE Emp_Type_id  = '$Emp_Type' ";
                  $resultp_type = mysqli_query($connect, $Emptype);
                  while ($rowptype = $resultp_type->fetch_assoc()) {
                    echo $rowptype['Emp_Type_name'];
                  }
                  ?>


                </td>
                <td>
                  <?php
                  $Major = $row['Major_id'];
                  $Major2 = "SELECT Major_name FROM major WHERE Major_id  = '$Major' ";
                  $resultp_brand = mysqli_query($connect, $Major2);
                  while ($rowpbrand = $resultp_brand->fetch_assoc()) {
                    echo $rowpbrand['Major_name'];
                  }
                  ?>


                </td>
                <td>
                  <div class="btn-group" role="group" aria-label="Basic mixed styles example">

                    <button type="button" class="btn btn-warning text-dark" data-bs-toggle="modal" data-bs-target="#edit_modal<?php echo $row['Emp_id']; ?>">แก้ไข</button>

                    <!-- Modal -->


                    <div class="modal fade" id="edit_modal<?php echo $row['Emp_id']; ?>" tabindex="-1" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">


                        <form class="modal-content" method="post" action="employeeEdit.php">
                          <div class="modal-header">
                            <h5 class="modal-title"><b>แก้ไขข้อมูลสินค้า</b></h5>
                          </div>

                          <div class="mb-3">
                            <label class="form-label">รหัสพนักงาน</label>
                            <input type="text" class="form-control" name="Emp_id" value="<?php echo $row['Emp_id']; ?>" readonly />
                          </div>


                          <div class="mb-3">
                            <label class="form-label">ชื่อพนักงาน</label>
                            <input type="text" class="form-control" name="Emp_name" value="<?php echo $row['Emp_name']; ?>" />
                          </div>
                          <div class="mb-3">
                            <label class="form-label">เพศ</label>
                            <input type="text" class="form-control" name="Emp_gender" value="<?php echo $row['Emp_gender']; ?>" />
                          </div>
                          <div class="mb-3">
                            <label class="form-label">วันเกิด</label>
                            <input type="date" class="form-control" name="Emp_date" value="<?php echo $row['Emp_date']; ?>" />
                          </div>


                          <div class="mb-3">
                            <?php
                            $Emp_Type = $row['Emp_Type_id'];
                            $Emptype = "SELECT Emp_Type_name FROM employee_type WHERE Emp_Type_id  = '$Emp_Type' ";
                            $resultp_type = mysqli_query($connect, $Emptype);
                            while ($rowptype = $resultp_type->fetch_assoc()) {
                              $Empp_Type = $rowptype['Emp_Type_name'];
                            }
                            ?>


                            <label class="form-label">ตำแหน่ง</label>
                            <select class="form-select" id="Emp_Type_id" name="Emp_Type_id">
                              <option selected value="<?php echo $row['Emp_Type_id']; ?>"><?php echo $Empp_Type; ?></option>

                              <?php
                              $sqlpType = "SELECT * FROM employee_type";
                              $result_sqlpType = $connect->query($sqlpType);
                              ?>
                              <?php while ($row_sqlpType = $result_sqlpType->fetch_assoc()) : ?>
                                <option value="<?php echo $row_sqlpType['Emp_Type_id']; ?>"><?php echo $row_sqlpType['Emp_Type_name'];  ?></option>
                              <?php endwhile ?>

                            </select>


                          </div>

                          <div class="mb-3">
                            <?php
                            $Emp_major = $row['Major_id'];
                            $Emp_major2 = "SELECT Major_name FROM major WHERE Major_id = '$Emp_major' ";
                            $resultp_major = mysqli_query($connect, $Emp_major2);
                            while ($rowpmajor = $resultp_major->fetch_assoc()) {
                              $Empp_major = $rowpmajor['Major_name'];
                            }
                            ?>


                            <label class="form-label">สาขา</label>
                            <select class="form-select" id="Major_id" name="Major_id">
                              <option selected value="<?php echo $row['Major_id']; ?>"><?php echo $Empp_major; ?></option>

                              <?php
                              $sqlpmajor = "SELECT * FROM major";
                              $result_major = $connect->query($sqlpmajor);
                              ?>
                              <?php while ($row_major = $result_major->fetch_assoc()) : ?>
                                <option value="<?php echo $row_major['Major_id']; ?>"><?php echo $row_major['Major_name'];  ?></option>
                              <?php endwhile ?>

                            </select>


                          </div>




                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                            <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                          </div>
                      </div>



                      </form>
                    </div>


                  </div>


                  <!--ปุ่มลบ--->
                  <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#del<?php echo $row['Emp_id']; ?>">ลบ</button>
                  <div class="modal fade" id="del<?php echo $row['Emp_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel"><b>ยืนยันการลบข้อมูลสินค้า</b></h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          คุณต้องการยกเลิก <?php echo $row['Emp_name']; ?> ใช่หรือไม่
                        </div>
                        <div class="modal-footer">
                          <?php
                          $id = $row['Emp_id'];

                          ?>
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                          <button type="button" class="btn btn-primary" onclick="window.location.href='employeedelete.php?id=<?php echo $id; ?>'">ยืนยัน</button>
                        </div>
                      </div>
                    </div>
                  </div>



      </div>
      </td>

      </tr>

    </div>





  <?php endwhile ?>

  </tbody>

  </table>

  </div>





  </div>
  <!----------------------------------->



  </div>



  <!---------------------------------------------------------------------------------------------------->

  <!--bootstarp java-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>
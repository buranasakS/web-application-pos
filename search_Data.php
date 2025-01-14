<?php
$connect = new mysqli('localhost', 'root', '', 'hardware_store');

if ($connect->connect_error) {
    die("Something wrong.: " . $connect->connect_error);
}



$search_text = isset($_POST['txt_keyword']) ? $_POST['txt_keyword'] : '';



$data = array();
$sql_data = "SELECT * FROM product  
               WHERE `Product_name` LIKE '%$search_text%'  
               OR Product_detail LIKE '%$search_text%' OR Product_id  LIKE  '%$search_text%' ";
//echo $sql_data;
if ($result_data = $connect->query($sql_data)) {
    //printf("Select returned %d rows.\n", $result->num_rows);
    while ($row = $result_data->fetch_array(MYSQLI_ASSOC)) {
        //print_r($row);echo '<br>';
        $data[] = $row;
    }

    /* free result set */
    $result_data->close();
}


//echo '<pre>', print_r($data, true), '</pre>';

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
                    <button type="button" class="btn btn-success btn-lg btn_sideleft"><a href="product.php">จัดการสินค้า</a></button>
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

            <form method="POST" action="search_Data.php">
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





            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#add_data">เพิ่มสินค้า</button>
            <div class="modal fade" id="add_data" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">


                    <form class="modal-content" method="post" action="add_product.php">
                        <div class="modal-header">
                            <h5 class="modal-title">เพิ่มข้อมูลสินค้า</h5>
                        </div>
                        <div class="modal-body">

                            <div class="mb-3">
                                <label class="form-label">รหัสสินค้า</label>
                                <input type="text" class="form-control" name="P_id" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">ชื่อสินค้า</label>
                                <input type="text" class="form-control" name="P_name" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">ประเภทสินค้า</label>
                                <select class="form-select" name="P_type">
                                    <?php
                                    $sql = "SELECT * FROM product_type";
                                    $result2 = $connect->query($sql);
                                    ?>
                                    <?php while ($row = $result2->fetch_assoc()) : ?>
                                        <option value="<?php echo $row['Product_type_id']; ?>"><?php echo $row['Product_type']; ?></option>
                                    <?php endwhile ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">แบรนด์</label>
                                <select class="form-select" name="P_brand">
                                    <?php
                                    $sql = "SELECT * FROM product_brand";
                                    $result3 = $connect->query($sql);
                                    ?>
                                    <?php while ($row = $result3->fetch_assoc()) : ?>
                                        <option value="<?php echo $row['Brand_id']; ?>"><?php echo $row['Brand_name']; ?></option>
                                    <?php endwhile ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">จำนวน</label>
                                <input type="text" class="form-control" name="P_count" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">ราคา</label>
                                <input type="text" class="form-control" name="P_price" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">รายละเอียด</label>
                                <input type="text" class="form-control" name="P_detail" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">โปรโมชั่น</label>
                                <input type="text" class="form-control" name="P_promotion" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">เลือกรูปภาพสินค้า</label>
                                <div class="input-group mb-3">
                                    <input type="file" accept="image/*" class="form-control" id="inputGroupFile01" name="P_img" required>
                                </div>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                            <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                        </div>
                    </form>
                </div>


            </div>


            <div style="width: 100%; height: 32em; overflow-y: scroll; scrollbar-arrow-color:blue; scrollbar-face-color: #e7e7e7; scrollbar-3dlight-color: #a0a0a0; scrollbar-darkshadow-color:#888888">


                <table class="table table_info">
                    <thead>
                        <tr>
                            <th scope="col">รหัสสินค้า</th>
                            <th scope="col">ภาพสินค้า</th>
                            <th scope="col">ชื่อสินค้า</th>
                            <th scope="col">รายละเอียด</th>
                            <th scope="col">ประเภทสินค้า</th>
                            <th scope="col">แบรนด์</th>
                            <th scope="col">ราคา</th>
                            <th scope="col">จำนวน</th>
                            <th scope="col">โปรโมชั่น</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php //while ($row = $result->fetch_assoc()) : 


                        ?>

                        <?php
                        foreach ($data as $row) {
                        ?>



                            <tr>
                                <td>
                                    <?php echo $row['Product_id']; ?>
                                </td>
                                <td class="name">
                                    <img src="img_product/<?php echo $row['Product_photo']; ?>" width="150" height="150" border="0" alt="รูปถ่ายสินค้า" />
                                </td>
                                <td>
                                    <?php echo $row['Product_name']; ?>
                                </td>
                                <td>
                                    <?php echo $row['Product_detail']; ?>
                                </td>
                                <td>
                                    <?php
                                    $p_nameType = $row['Product_Type'];
                                    $p_type = "SELECT Product_type FROM product_type WHERE Product_type_id  = '$p_nameType' ";
                                    $resultp_type = mysqli_query($connect, $p_type);
                                    while ($rowptype = $resultp_type->fetch_assoc()) {
                                        echo $rowptype['Product_type'];
                                    }
                                    ?>


                                </td>
                                <td>
                                    <?php
                                    $p_brand = $row['Product_Brand'];
                                    $p_brand2 = "SELECT Brand_name FROM product_brand WHERE Brand_id  = '$p_brand' ";
                                    $resultp_brand = mysqli_query($connect, $p_brand2);
                                    while ($rowpbrand = $resultp_brand->fetch_assoc()) {
                                        echo $rowpbrand['Brand_name'];
                                    }
                                    ?>


                                </td>
                                <td>
                                    <?php echo $row['Product_price']; ?>
                                </td>
                                <td>
                                    <?php echo $row['Product_qty']; ?>
                                </td>
                                <td>
                                    <?php echo $row['Product_promotion']; ?>
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">

                                        <button type="button" class="btn btn-warning text-dark" data-bs-toggle="modal" data-bs-target="#edit_modal<?php echo $row['Product_id']; ?>">แก้ไข</button>







                                        <!-- Modal -->


                                        <div class="modal fade" id="edit_modal<?php echo $row['Product_id']; ?>" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">


                                                <form class="modal-content" method="post" action="formEdit.php">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"><b>แก้ไขข้อมูลสินค้า</b></h5>
                                                    </div>
                                                    <div class="modal-body">

                                                        <div class="mb-3">
                                                            <img class="rounded mx-auto d-block" src="img_product/<?php echo $row['Product_photo']; ?>" width="350" height="350" alt="รูปถ่ายสินค้า" />
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label">เลือกรูปภาพสินค้า</label>

                                                            <div class="input-group mb-3">
                                                                <input type="file" accept="image/*" class="form-control" id="inputGroupFile01" name="P_img">
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label">รหัสสินค้า</label>
                                                            <input type="text" class="form-control" name="P_id" value="<?php echo $row['Product_id']; ?>" readonly />
                                                        </div>


                                                        <div class="mb-3">
                                                            <label class="form-label">ชื่อสินค้า</label>
                                                            <input type="text" class="form-control" name="P_name" value="<?php echo $row['Product_name']; ?>" />
                                                        </div>


                                                        <div class="mb-3">
                                                            <?php
                                                            $p_nameType = $row['Product_Type'];
                                                            $p_type = "SELECT Product_type FROM product_type WHERE Product_type_id  = '$p_nameType' ";
                                                            $resultp_type = mysqli_query($connect, $p_type);
                                                            while ($rowptype = $resultp_type->fetch_assoc()) {
                                                                $pro_Type = $rowptype['Product_type'];
                                                            }
                                                            ?>


                                                            <label class="form-label">ประเภทสินค้า</label>
                                                            <select class="form-select" id="inputGroupSelect01" name="P_type">
                                                                <option selected value="<?php echo $row['Product_Type']; ?>"><?php echo $pro_Type; ?></option>

                                                                <?php
                                                                $sqlpType = "SELECT * FROM product_type";
                                                                $result_sqlpType = $connect->query($sqlpType);
                                                                ?>
                                                                <?php while ($row_sqlpType = $result_sqlpType->fetch_assoc()) : ?>
                                                                    <option value="<?php echo $row_sqlpType['Product_type_id']; ?>"><?php echo $row_sqlpType['Product_type'];  ?></option>
                                                                <?php endwhile ?>

                                                            </select>


                                                        </div>



                                                        <div class="mb-3">

                                                            <?php
                                                            $p_brand = $row['Product_Brand'];
                                                            $p_brand2 = "SELECT Brand_name FROM product_brand WHERE Brand_id  = '$p_brand' ";
                                                            $resultp_brand = mysqli_query($connect, $p_brand2);
                                                            while ($rowpbrand = $resultp_brand->fetch_assoc()) {
                                                                $a1 = $rowpbrand['Brand_name'];
                                                            }
                                                            ?>

                                                            <label class="form-label">แบรนด์</label>
                                                            <select class="form-select" id="P_brand" name="P_brand">
                                                                <option selected value="<?php echo $row['Product_Brand']; ?>><?php echo $a1; ?></option>

                                <?php
                                $select_pbrand = "SELECT * FROM product_brand";
                                $result_select_pbrand = $connect->query($select_pbrand);
                                ?>
                                <?php while ($row_pbrand = $result_select_pbrand->fetch_assoc()) : ?>
                                  <option value=" <?php echo $row_pbrand['Brand_id']; ?>"><?php echo $row_pbrand['Brand_name']; ?></option>
                                                            <?php endwhile ?>
                                                            </select>

                                                        </div>



                                                        <div class="mb-3">
                                                            <label class="form-label">จำนวน</label>
                                                            <input type="text" class="form-control" name="P_count" value="<?php echo $row['Product_qty']; ?>" />
                                                        </div>


                                                        <div class="mb-3">
                                                            <label class="form-label">ราคา</label>
                                                            <input type="text" class="form-control" name="P_price" value="<?php echo $row['Product_price']; ?>" />
                                                        </div>


                                                        <div class="mb-3">
                                                            <label class="form-label">รายละเอียด</label>
                                                            <input type="text" class="form-control" name="P_detail" value="<?php echo $row['Product_detail']; ?>" />
                                                        </div>



                                                        <div class="mb-3">
                                                            <label class="form-label">โปรโมชั่น</label>
                                                            <input type="text" class="form-control" name="P_promotion" value="<?php echo $row['Product_promotion']; ?>" />
                                                        </div>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                                                        <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                                                    </div>


                                                </form>
                                            </div>


                                        </div>


                                        <!--ปุ่มลบ--->
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#del<?php echo $row['Product_id']; ?>">ลบ</button>
                                        <div class="modal fade" id="del<?php echo $row['Product_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                        $id = $row['Product_id'];

                                                        ?>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                                                        <button type="button" class="btn btn-primary" onclick="window.location.href='del.php?id=<?php echo $id; ?>'">ยืนยัน</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                </td>

                            </tr>

            </div>







        <?php } ?>

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
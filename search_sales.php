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
                    <button type="button" class="btn btn-success btn-lg btn_sideleft"><a href="sales.php">ขายสินค้า</a></button>
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
                <div class="input-group mb-3 btt_search">
                    <input type="text" name="txt_keyword" class="form-control" placeholder="ค้นหาชื่อรหัส/ชื่อสินค้า" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary" type="submit" id="btt_search">ค้นหา</button>




                </div>

            </form>
            <div style="width: 100%; height: 32em; overflow-y: scroll; scrollbar-arrow-color:blue; scrollbar-face-color: #e7e7e7; scrollbar-3dlight-color: #a0a0a0; scrollbar-darkshadow-color:#888888">
                <table class="table table_info">
                    <thead>
                        <tr>
                            <th scope="col">รหัสสินค้า</th>
                            <th scope="col">ภาพสินค้า</th>
                            <th scope="col">ชื่อสินค้า</th>
                            <th scope="col">ราคา</th>
                            <th scope="col">เลือกสินค้า</th>
                            <!-- <th scope="col">จำนวน</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($data as $row) {
                        ?>
                            <tr>
                                <td> <?php echo $row["Product_id"] ?></td>
                                <td><img src=img_product/<?php echo $row["Product_photo"]; ?> width="100"></td>
                                <td><?php echo $row["Product_name"]  ?></td>
                                <td><?php echo number_format($row["Product_price"], 2) ?></td>
                                <td><button type="button" class="btn btn-primary" onclick="window.location.href='cart.php?Product_id=<?php echo $row['Product_id']; ?>&act=add'">เพิ่ม</button></td>
                            </tr>
                        <?php
                        }
                        ?>
                        <tr>

                            <a type='button' class='btn btn-outline-danger' href="sales.php">กลับ</a>

                        </tr>
                    </tbody>
                </table>











            </div>
            <!----------------------------------->

            <!---------------------------------------------------------------------------------------------------->

            <!--bootstarp java-->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>
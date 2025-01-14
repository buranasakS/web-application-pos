<?php
session_start();
include("conn.php");
?>

<?php

$Emp_id = $_POST["Emp_id"];
$total = $_POST["total"];
$createdAt = Date("Y-m-d G:i:s");


mysqli_query($db, "BEGIN");
$sql1 = "INSERT INTO order_list VALUES(null,'$Emp_id',$total,'$createdAt')";
$query1 = mysqli_query($db, $sql1);


$sql2 = "SELECT max(orders_id) as orders_id 
    FROM order_list 
    WHERE Emp_id= '$Emp_id'";
$query2 = mysqli_query($db, $sql2);
$row = mysqli_fetch_array($query2);
$orders_id = $row["orders_id"];


foreach ($_SESSION['cart'] as $Product_id => $qty) {
    $sql3 = "SELECT * FROM product where Product_id= '$Product_id'";
    $query3 = mysqli_query($db, $sql3);
    $row3 = mysqli_fetch_array($query3);
    $pricetotal = $row3['Product_price'] * $qty;
    $rowproduct = $row3['Product_qty'] - $qty;
    
    
    if($rowproduct>=0){
        $sql6 = "UPDATE product SET Product_qty = '$rowproduct' WHERE Product_id= '$Product_id' and $rowproduct>=0 ";
        $query6 = mysqli_query($db, $sql6);

        $sql4 = "INSERT INTO order_detail values (null,$orders_id,'$Product_id',$pricetotal, $qty ,'$createdAt')";
        $query4 = mysqli_query($db, $sql4);

    }else{
        echo "<script type='text/javascript'>";
        echo "alert('สินค้าหมด');";
        echo "window.location = 'sales.php'; ";
        echo "</script>";
    }
    
}

if ($query1 && $query4) {
    mysqli_query($db, "COMMIT");
    $msg = "บันทึกข้อมูลเสร็จสิ้น!!";
    foreach ($_SESSION['cart'] as $Product_id) {
        unset($_SESSION['cart']);
    }
} else {
    mysqli_query($db, "ROLLBACK");
    $msg = "บันทึกข้อมูลไม่สำเร็จ!!";
}
?>
<script type="text/javascript">
    alert("<?php echo $msg; ?>");
    window.location = 'sales.php';
</script>
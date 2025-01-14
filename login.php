<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500&family=Itim&family=Kanit:wght@200;300&family=Sarabun:wght@300&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="login.css">

</head>
<body>

    <div class="login-content">
        <form method="POST" action="login.php">
            <h2 class="title">Hardware.Store</h2>
            <div class="input-text name">
                <div class="i">
                    <i class="fas fa-user">
                </div>
                <div class="div">
                    <input type="text" name="username" class="input" placeholder="Username">
                </div>
            </div>
            <div class="input-text pass">
                <div class="i">
                    <i class="fas fa-lock"></i>
                </div>
                <div class="div">
                    <input type="password" name="password" class="input" placeholder="Password">
                </div>
            </div>
            <input type="submit" name="login" class="login" value="Login">
        </form>
    </div>
    </div>

    <script src="js/bootstrap.min.js"></script>

</body>

</html>

<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "hardware_store";
$conn = mysqli_connect($host, $user, $password, $db);

if (isset($_POST['username'])) {
    $name = $_POST['username'];
    $password = $_POST['password'];

    $check_user = "SELECT * from employee WHERE Emp_name='$name' AND E_password='$password'";
    $result = $conn->query($check_user);
    $row = mysqli_fetch_array($result);

    if ($result->num_rows > 0) {
        echo "<script>alert(' เข้าสู่ระบบสำเร็จ ')</script>";

        if ($row['Emp_Type_id'] == "1") {
            $_SESSION['user'] = $name;
            $_SESSION['Emp_Type'] = $row['Emp_Type_id'];
            $_SESSION['Major_id'] = $row['Major_id'];
            $_SESSION['Emp_Type'] = $row['Emp_Type_id'];
            $_SESSION['Emp_id'] = $row['Emp_id'];
            echo "<script>window.open('sales.php','_self')</script>";
        } else {
            $_SESSION['user'] = $name;
            $_SESSION['Emp_Type'] = $row['Emp_Type_id'];
            $_SESSION['Major_id'] = $row['Major_id'];
            $_SESSION['Emp_id'] = $row['Emp_id'];
            echo  "<script>window.open('sales.php','_self')</script>";
        }
    } else {
        echo  "<script>alert(' รหัสผ่านไม่ถูกต้อง ')</script>";
        exit();
    }
}
?>
<?php
require_once 'connection.php';

//get value from login.php
session_start();
$email = $_POST['email'];
$password =$_POST['password'];

//check if credentials in valid and users are not banned

$sql = "SELECT * FROM users WHERE email='".$email."' AND password='".$password."' AND status=0";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

    while($row = mysqli_fetch_assoc($result)) {

        $_SESSION['email'] = $row['email'];
        $_SESSION['level'] = $row['level'];
        $_SESSION['first_name'] = $row['first_name'];
        $_SESSION['level'] = $row['level'];
    }

    if($_SESSION['level'] == 'ADMIN'){
        echo "<script>window.location='admin/index.php';</script>";
    }else{
        echo "<script>alert('User page still on delvelopment : )');window.location='index.php';</script>";
    }

} else{
    echo "<script>alert('Invalid Password or Username!');window.location='index.php';</script>";
}

?>
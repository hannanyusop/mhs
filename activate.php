<?php
    include_once ('connection.php');

    if(isset($_GET['key'])){
        $sql = "UPDATE users SET status = 1 WHERE activation_key = '$_GET[key]'";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Your account has been successfully activated! Please login to your account');window.location='login.php';</script>";
        } else {
            echo "<script>alert('Error!');window.location='login.php';</script>";
            //echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
?>
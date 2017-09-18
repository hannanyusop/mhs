<?php

    if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
        header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
        die( header( '404.php' ) );

    }
    require_once 'connection.php';

    //get value from login.php
    session_start();
    $email = $_POST['email'];
    $password =$_POST['password'];

    //check if credentials in valid and users are not banned

    $sql = "SELECT * FROM users WHERE email='".$email."' AND password='".$password."' AND status=1";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {

        while($row = mysqli_fetch_assoc($result)) {

            $_SESSION['user_id'] = $row['id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['level'] = $row['level'];
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['level'] = $row['level'];
        }

        if($_SESSION['level'] == 'ADMIN'){
            echo "<script>window.location='admin/index.php';</script>";
        }else{
            if(isset($_SESSION['service'])){
                echo "<script>alert('Now you can proceed for your order');window.location='service-order.php?id=$_SESSION[service]';</script>";
            }else{
                echo "<script>window.location='index.php';</script>";
            }
        }

    } else{
        echo "<script>alert('Invalid Password or Username!');window.location='index.php';</script>";
    }

?>
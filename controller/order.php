<?php
    require_once ('../connection.php');
    //receive any action parameter from POST or GET
    if(isset($_POST['action'])||isset($_GET['action']))
    {
        $model = 'order';
        if(isset($_POST['action'])){
            $action =$_POST['action'];
        } else{
            $action=$_GET['action'];
        }

        switch ($action) {
            case 'register' :

                $sql = "INSERT INTO users (email,level,status,password) VALUES ('$_POST[email]','USER','1','$_POST[password]')";

                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('Congratulations! Registration successfully.Please register to update your account.');window.location='../login.php';</script>";
                } else {
                    //echo "<script>alert('Error while inserting data!');//window.location='../user-$action.php';</script>";
                    echo "<script>alert('Registration failed! Email already exist!');window.location='../login.php';</script>";

                }
                break;

            case 'edit' :
                break;

            case 'delete' :
                break;

            default :
                echo "<script>window.location='404.php'</script>";
        }
    }else{
        echo "<script>window.location='404.php'</script>";
    }
?>
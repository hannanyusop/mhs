<?php
    require_once ('../connection.php');
    session_start();
    //receive any action parameter from POST or GET
    if(isset($_POST['action'])||isset($_GET['action']))
    {
        $model = 'user';
        if(isset($_POST['action'])){
            $action =$_POST['action'];
        } else{
            $action=$_GET['action'];
        }

        switch ($action) {
            case 'add' :

                $sql = "INSERT INTO contact_us (name,email,phone,message,seen) VALUES ('$_POST[name]',  '$_POST[email]', '$_POST[phone]', '$_POST[message]', 0)";

                if (mysqli_query($conn, $sql)) {
                        echo "<script>alert('Form sent.');window.location='../contact.php';</script>";
                } else {
                    //echo "<script>alert('Error while inserting data!');//window.location='../user-$action.php';</script>";
                    echo "<script>alert('Failed!');window.location='../contact.php';</script>";

                }
                break;

            default :
                echo "<script>window.location='../404.php'</script>";
        }
    }else{
        echo "<script>window.location='../404.php'</script>";
    }
?>
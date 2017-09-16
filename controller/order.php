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
            case 'add' :
                $sql = "INSERT INTO orders (user_id,service_id,services_add_on_id,date,time,user_note,grand_price,status) 
                        VALUES ('$_POST[user_id]','$_POST[service_id]','$_POST[services_add_on_id]','$_POST[date]','$_POST[time]','$_POST[user_note]','$_POST[grand_price]',1)";

                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('Thank Your! Our staff will process your order.');window.location='../login.php';</script>";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    //echo "<script>alert('Error while inserting data!');//window.location='../user-$action.php';</script>";
                    //echo "<script>alert('Registration failed! Email already exist!');window.location='../login.php';</script>";

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
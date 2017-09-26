<?php
    require_once ('../connection.php');
    session_start();
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
                if($_POST['day'] < 10){
                    $day = "0".$_POST['day'];
                }else{
                    $day = $_POST['day'];
                }

                if($_POST['month'] < 10){
                    $month = "0".$_POST['month'];
                }else{
                    $month = $_POST['month'];
                }
                $date = $_POST['year']."-".$month."-".$day;
                $time = $_POST['hrs'].":".$_POST['min'].":00";
                $sql = "INSERT INTO orders (user_id,service_id,services_add_on_id,date,time,user_note,grand_price,status) 
                        VALUES ('$_POST[user_id]','$_POST[service_id]','$_POST[services_add_on_id]','$date','$time','$_POST[user_note]','0',1)";

                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('Thank You! Our staff will process your order.');window.location='../login.php';</script>";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    //echo "<script>alert('Error while inserting data!');//window.location='../user-$action.php';</script>";
                    //echo "<script>alert('Registration failed! Email already exist!');window.location='../login.php';</script>";

                }
                break;

            case 'edit' :
                break;

            case 'rate' :
                $rating_note = addslashes($_POST['rating_note']);
                $sql = "UPDATE orders SET rating = '$_POST[rate]', rating_note = '$rating_note' WHERE id = '$_POST[id]' AND user_id = '$_SESSION[user_id]'";

                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('Thank You for your feedback');window.location='../account.php';</script>";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    //echo "<script>alert('Error while inserting data!');//window.location='../user-$action.php';</script>";
                    //echo "<script>alert('Registration failed! Email already exist!');window.location='../login.php';</script>";
                }
                break;
            case 'cancel' :
                //status  = 5 is cancelled
                $sql = "UPDATE orders SET status = 5 WHERE id = '$_GET[id]' AND user_id = '$_SESSION[user_id]'";

                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('Your order has been cancelled.');window.location='../account.php';</script>";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    //echo "<script>alert('Error while inserting data!');//window.location='../user-$action.php';</script>";
                    //echo "<script>alert('Registration failed! Email already exist!');window.location='../login.php';</script>";
                }
                break;

            default :
                echo "<script>window.location='404.php'</script>";
        }
    }else{
        echo "<script>window.location='404.php'</script>";
    }
?>
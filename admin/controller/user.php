<?php
    require_once ('../../connection.php');
    //receive any action parameter from POST or GET
    if(isset($_POST['action'])||isset($_GET['action']))
    {
        if(isset($_POST['action'])){
            $action =$_POST['action'];
        } else{
            $action=$_GET['action'];
        }

        switch ($action) {
            case 'add' :

                $sql = "INSERT INTO users (first_name,last_name,email,phone,level,status,password,address1,address2,city,postcode,states,country) 
                        VALUES ('$_POST[first_name]','$_POST[last_name]','$_POST[email]','$_POST[phone]','$_POST[level]','$_POST[status]','$_POST[password]','$_POST[address1]','$_POST[address2]','$_POST[city]','$_POST[postcode]','$_POST[states]','$_POST[country]')";

                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('Successfully added!');window.location='../user-$action.php';</script>";
                } else {
                    //echo "<script>alert('Error while inserting data!');//window.location='../user-$action.php';</script>";
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
                break;

            case 'edit' :
                break;

            case 'delete' :
                break;

            default :
                echo "<script>window.location='../404.php'</script>";
        }
    }else{
        echo "<script>window.location='../404.php'</script>";
    }
?>
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
            case 'register' :

                $sql = "INSERT INTO users (email,level,status,password) VALUES ('$_POST[email]','USER','1','$_POST[password]')";

                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('Congratulations! Registration successfully.Please register to update your account.');window.location='../login.php';</script>";
                } else {
                    //echo "<script>alert('Error while inserting data!');//window.location='../user-$action.php';</script>";
                    echo "<script>alert('Registration failed! Email already exist!');window.location='../login.php';</script>";

                }
                break;

            case 'update' :
                $sql = "UPDATE users SET first_name = '$_POST[first_name]',last_name = '$_POST[last_name]',email = '$_POST[email]',phone = '$_POST[phone]',ic='$_POST[ic]',address1 = '$_POST[address1]',address2 ='$_POST[address2]',city='$_POST[city]',postcode='$_POST[postcode]',states='$_POST[states]',country='$_POST[country]' WHERE id ='$_SESSION[user_id]'";
                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('Your account has been updated!');window.location='../account.php';</script>";
                } else {
                    echo "<script>alert('Error while updating data!');window.location='../account.php';</script>";
                    //echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
                break;

            case 'delete' :
                //check if user is logged in and make sure password is correct before user can delete account
                $sql = "SELECT * FROM users WHERE id = $_SESSION[user_id] AND password = '$_POST[password]'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $delete_note = addslashes($_POST['delete_note']);
                    $sql = "UPDATE users SET status = 3,delete_note = '$delete_note' WHERE id = $_SESSION[user_id]";
                    if (mysqli_query($conn, $sql)) {
                        echo "<script>alert('Account Deleted!');window.location='../logout.php';</script>";
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                        //echo "<script>alert('Error while deleting data!');window.location='../account.php';</script>";
                    }
                }else{
                    echo "<script>alert('Error password!');window.location='../account.php';</script>";
                }
                break;

            default :
                echo "<script>window.location='../404.php'</script>";
        }
    }else{
        echo "<script>window.location='../404.php'</script>";
    }
?>
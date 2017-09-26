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
                //status =  0 is inactive => need email activation
                function rand_string( $length )
                {
                    $chars = "1234567890qwertyuipasdfghjklzxcvbnm1234567890";
                    return substr(str_shuffle($chars),0,$length);
                }
                $key=rand_string(30);

                $sql = "INSERT INTO users (email,level,status,password,activation_key) VALUES ('$_POST[email]','USER','0','$_POST[password]','$key')";

                if (mysqli_query($conn, $sql)) {
                    include_once ('../register-email.php');
                    if($mail->Send()) {
                        echo "<script>alert('Congratulations! You\'re now a part of our team!.Please check your email to activate your account.');window.location='../login.php';</script>";

                    }else{
                        echo "<script>alert('Error! Please check your internet connection!');window.location='../login.php';</script>";

                    }
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

            case 'update-password' :
                if(isset($_POST['password'])){
                    $result = mysqli_query($conn, "SELECT * FROM users WHERE id = $_SESSION[user_id] LIMIT 1");
                     while($row = mysqli_fetch_assoc($result)) {
                         $old_password = $row['password'];
                      }
                    if($_POST['password']!=$old_password){
                        echo "<script>alert('Old Password not match!');window.location='../account.php';</script>";
                    }else{
                        if($_POST['password1']!=$_POST['password2']){
                            echo "<script>alert('New Password and Confirm Password not match');window.location='../account.php';</script>";
                        }else{
                            $sql = "UPDATE users SET password = '$_POST[password1]' WHERE id = $_SESSION[user_id]";
                            if (mysqli_query($conn, $sql)) {
                                echo "<script>alert('Password Updated!');window.location='../account.php';</script>";
                            } else {
                                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                //echo "<script>alert('Error while deleting data!');window.location='../account.php';</script>";
                            }
                        }
                    }


                }else{
                    echo "<script>window.location='../404.php'</script>";
                }

            default :
                echo "<script>window.location='../404.php'</script>";
        }
    }else{
        echo "<script>window.location='../404.php'</script>";
    }
?>
<?php
    require_once ('../../connection.php');
    //receive any action parameter from POST or GET
    if(isset($_POST['action'])||isset($_GET['action']))
    {
        $model = 'service';
        if(isset($_POST['action'])){
            $action =$_POST['action'];
        } else{
            $action=$_GET['action'];
        }

        switch ($action) {
            case 'add' :

                $sql = "INSERT INTO services (title,description,basic_price,qouta,status) 
                        VALUES ('$_POST[title]','$_POST[description]','$_POST[basic_price]','$_POST[qouta]','$_POST[status]')";

                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('Successfully added!');window.location='../$model-$action.php';</script>";
                } else {
                    //echo "<script>alert('Error while inserting data!');//window.location='../user-$action.php';</script>";
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
                break;

            case 'edit' :

                $sql = "UPDATE services SET title='$_POST[title]',description='$_POST[description]',basic_price='$_POST[basic_price]',qouta='$_POST[qouta]',status='$_POST[status]' WHERE id='$_POST[id]'";

                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('Successfully updated!');window.location='../$model-view.php?id=$_POST[id]';</script>";
                } else {
                    //echo "<script>alert('Error while inserting data!');//window.location='../user-$action.php';</script>";
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
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
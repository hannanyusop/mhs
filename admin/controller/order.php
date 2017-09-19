<?php
    require_once ('../../connection.php');
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

            case 'approve' :

                $sql = "SELECT *,a.id as order_id,c.title as service_title,c.basic_price as service_basic_price,d.title as services_add_on_title,d.price as sevices_add_on_price  FROM orders as a LEFT JOIN users as b ON b.id=a.user_id LEFT JOIN services as c ON c.id=a.service_id LEFT JOIN services_add_on as d ON d.id=a.services_add_on_id WHERE a.id = '$_GET[id]'";
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($result)) {

                    $user_name = $row['first_name']." ".$row['last_name'];
                    $address = $row['address1']."<br>".$row['address2']."<br>".$row['city'].",".$row['postcode'].",".$row['states']."<br>".$row['country'];
                    $sub_total = $row['basic_price'] + $row['sevices_add_on_price'] ;
                    $grand_total = $sub_total + $row['tax_price'];

                    $sql = "INSERT INTO invoices (order_id, user_name, phone, email,address,date_process,service_title,service_price,add_on_title,add_on_price,sub_total,tax,grand_total)
                            VALUES ($_GET[id], '$user_name', '$row[phone]', '$row[email]', '$address', NOW(), '$row[service_title]', '$row[basic_price]', '$row[services_add_on_title]', '$row[sevices_add_on_price]', '$sub_total', '$row[tax_price]', '$grand_total');
";
                    if (mysqli_query($conn, $sql)) {

                        //update order status 3 (Approved) if data successfully inserted to invoices table
                        mysqli_query($conn, "UPDATE orders SET status = 3 WHERE id = $_GET[id]");

                        echo "<script>alert('Successfully added!');window.location='../order-view.php?id=$_GET[id]';</script>";
                    } else {
                        //echo "<script>alert('Error while inserting data!');//window.location='../user-$action.php';</script>";
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
                }
                break;

            case 'edit' :
                $sql = "UPDATE users SET first_name = '$_POST[first_name]',last_name = '$_POST[last_name]',email = '$_POST[email]',phone = '$_POST[phone]',status = '$_POST[status]',address1 = '$_POST[address1]',address2 ='$_POST[address2]',city='$_POST[city]',postcode='$_POST[postcode]',states='$_POST[states]',country='$_POST[country]' WHERE id ='$_POST[id]'";
                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('Approved!');window.location='../$model-view.php?id=$_POST[id]';</script>";
                } else {
                    //echo "<script>alert('Error while inserting data!');//window.location='../user-$action.php';</script>";
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
                break;

            case 'reject' :
                //status = 4 is rejected
                $sql = "UPDATE orders SET status = 4,admin_note = '$_POST[admin_note]' WHERE id = $_POST[order_id]";
                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('Rejected!!');window.location='../$model-view.php?id=$_POST[order_id]';</script>";
                } else {
                    //echo "<script>alert('Error while inserting data!');//window.location='../user-$action.php';</script>";
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
                break;

            default :
                echo "<script>window.location='../404.php'</script>";
        }
    }else{
        echo "<script>window.location='../404.php'</script>";
    }
?>
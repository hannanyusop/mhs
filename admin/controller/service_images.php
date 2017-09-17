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
            case 'upload-image' :

                $target = '../../images/';
                $ok = true;

                $file = $_FILES['uploaded'];

                if ( $file['error'] > 0 ) {
                    // We have an error...
                    $ok = false;
                    echo "<script>alert('Unknown Error!');window.location='../service-view.php?id=$_POST[id]'</script>";

                }

                if ( 2097152 < filesize( $file['tmp_name'] ) ) {

                    $ok = false;
                    echo "<script>alert('File too big!');window.location='../service-view.php?id=$_POST[id]'</script>";
                }

                $type = getimagesize( $file['tmp_name'] );
                if ( $type === false || !in_array( $type[2], array( IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG ) ) ) {

                    // File not correct type.
                    $ok = false;

                } else {

                    $ext = image_type_to_extension( $type[2] );
                    if ( !preg_match( '/' . preg_quote( $ext ) . '$/i', $file['name'] ) ) {
                        $file['name'] .= $ext;
                    }

                    $target .= $file['name'];

                }

                if ( $ok ) {

                    if ( move_uploaded_file( $file['tmp_name'], $target ) ) {

                        // File is uploaded!
                        $sql = "INSERT INTO service_images (service_id,image,alt) VALUES ('$_POST[service_id]','$file[name]','$_POST[alt]')";

                        if (mysqli_query($conn, $sql)) {
                            echo "<script>alert('Image uploaded');window.location='../service-view.php?id=$_POST[service_id]'</script>";
                        } else {
                            //echo "<script>alert('Error while inserting data!');//window.location='../user-$action.php';</script>";
                            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                        }

                    } else {

                        echo "<script>alert('Error 1!');window.location='../service-view.php?id=$_POST[service_id]'</script>";

                    }

                } else {

                    echo "<script>alert('Error 2!');window.location='../service-view.php?id=$_POST[service_id]'</script>";

                }
                break;

            case 'delete' :
                $sql = "DELETE FROM service_images WHERE id=$_GET[id]";

                if (mysqli_query($conn, $sql)) {

                    $file = "../../images/".$_GET['image'];
                    if (!unlink($file)) {
                        echo "<script>alert('Error while deleting image!');window.location='../service-view.php?id=$_GET[service_id]'</script>";
                    } else {
                        echo "<script>alert('Image deleted!');window.location='../service-view.php?id=$_GET[service_id]'</script>";
                    }
                } else {
                    echo "Error deleting record: " . mysqli_error($conn);
                }
                break;
            default :
                echo "<script>window.location='../404.php'</script>";
        }
    }else{
        echo "<script>window.location='../404.php'</script>";
    }
?>
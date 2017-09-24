<!DOCTYPE html>
<html>
<?php include_once('head.php'); ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

<?php include_once('aside.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User
        <small>Add</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-user"></i> User</a></li>
        <li class="active">Edit</li>
      </ol>
    </section>

    <section class="content">

    <?php
        mysqli_query($conn, "UPDATE contact_us SET seen='1' WHERE id='$_GET[id]' ");
        if(isset($_GET['id'])){
            $sql = "SELECT * FROM contact_us WHERE id = '$_GET[id]'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
    ?>
     <div class="box">
          <div class="box-body">
                    <div class="row">

                        <div class="box-body col-lg-6">

                            <legend>Message</legend>

                            <div class="form-group">
                                <div class="col-lg-13">
                                    <label>Name</label>
                                    <input type="text" name="first_name" value="<?=$row['name']?>" placeholder="First Name" class="form-control" disabled>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>Email</label>
                                        <input type="email" name="email" value="<?=$row['email'] ?>" class="form-control" disabled>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Phone Number</label>
                                        <input type="text" name="phone" value="<?=$row['phone']?>" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="box-body col-lg-6">
                            <legend>Message</legend>

                            <div class="form-group">
                                <textarea class="form-control" rows="10" disabled><?=$row['message']?></textarea>
                            </div>

                        </div>
                    </div>

                    <div class="box-footer">
                        <a href="contact-us.php" class="btn btn-warning">Back</a>
                    </div>
          </div>
      </div>
    <?php
                }
            }else {
                $_SESSION['error'] = [
                    'code' => '404',
                    'url' => 'user.php',
                    'msg' => 'USER NOT FOUND'
                ];

                echo "<script>window.location='404.php'</script>";
            }
        }else{
            $_SESSION['error'] = [
                'code' => '404',
                'url'  => 'user.php',
                'msg'  => 'ERROR PAGE'
            ];

            echo "<script>window.location='404.php'</script>";
        }
    ?>

    </section>
  </div>
  <!-- /.content-wrapper -->
<?php include_once ('footer.php'); ?>
</body>
</html>

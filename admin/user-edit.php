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
        if(isset($_GET['id'])){
            $sql = "SELECT * FROM users WHERE id = '$_GET[id]'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
    ?>
     <div class="box">
          <div class="box-body">
                <form action="controller/user.php" method="post">
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="id" value="<?=$row['id']?>">
                    <div class="row">

                        <div class="box-body col-lg-6">

                            <legend>Basic Info</legend>

                            <div class="form-group">
                                <label>Name</label>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="text" name="first_name" value="<?=$row['first_name']?>" placeholder="First Name" class="form-control" >
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" name="last_name" value="<?=$row['last_name']?>" placeholder="Last Name" class="form-control" >
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>Email</label>
                                        <input type="email" name="email" value="<?=$row['email'] ?>" class="form-control" >
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Phone Number</label>
                                        <input type="text" name="phone" value="<?=$row['phone']?>" class="form-control" >
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>IC/PASSPORT NUMBER</label>
                                        <input type="text" name="ic" value="<?=$row['ic']?>" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <legend>Account Setting</legend>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>Level</label>
                                        <select class="form-control select2" style="width: 100%;"  disabled>
                                            <option value="USER" <?php if($row['level'] =="USER"){echo 'checked';} ?> >USER</option>
                                            <option value="ADMIN" <?php if($row['level'] =="ADMIN"){echo 'checked';} ?>>ADMIN</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>Status</label>
                                        <select name="status" class="form-control select2" style="width: 100%;" >
                                            <option value="1" <?php if($row['status'] =="2"){echo 'checked';} ?> >BANNED</option>
                                            <option value="2" <?php if($row['status'] =="1"){echo 'checked';} ?>>ACTIVE</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="password" name="password" placeholder="Password" class="form-control">
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="password" name="password1" placeholder="Re-enter Password" class="form-control">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="box-body col-lg-6">
                            <legend>Address</legend>

                            <div class="form-group">
                                <input type="text" name="address1"  value="<?=$row['address1']?>" placeholder="Address 1" class="form-control" >
                            </div>

                            <div class="form-group">
                                <input type="text" name="address2" value="<?=$row['address2']?>" placeholder="Address 2" class="form-control" >
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <select name="city" class="form-control select2" style="width: 100%;" >
                                            <option value="MUKAH">MUKAH</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" name="postcode" value="<?=$row['postcode']?>" placeholder="Postcode" class="form-control" >
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <select name="states" class="form-control select2" style="width: 100%;" >
                                            <option value="SARAWAK">SARAWAK</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <select name="country" class="form-control select2" style="width: 100%;" required>
                                            <option value="MALAYSIA">MALAYSIA</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-success">Update</button>
                        <a href="user-view.php?id=<?=$row['id']?>" class="btn btn-warning">Cancel</a>
                        <a href="controller/user.php?action=delete&id=$row[id]" class="btn btn-danger">Delete</a>
                    </div>
                </form>
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

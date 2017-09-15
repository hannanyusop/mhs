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

      <!-- Default box -->
      <div class="box">
          <div class="box-body">
                <form action="controller/user.php" method="post">
                    <input type="hidden" name="function" value="add">
                    <div class="row">

                        <div class="box-body col-lg-6">

                            <legend>Basic Info</legend>

                            <div class="form-group">
                                <label>Name</label>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="text" name="first_name" placeholder="First Name" class="form-control" required>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" name="last_name" placeholder="Last Name" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control" required>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Phone Number</label>
                                        <input type="text" name="phone" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>IC/PASSPORT NUMBER</label>
                                        <input type="text" name="ic" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <legend>Account Setting</legend>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>Level</label>
                                        <select name="status" class="form-control select2" style="width: 100%;" >
                                            <option value="USER">USER</option>
                                            <option value="ADMIN">ADMIN</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>Status</label>
                                        <select name="status" class="form-control select2" style="width: 100%;" >
                                            <option value="1">DEACTIVE</option>
                                            <option value="2">ACTIVE</option>
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
                                <input type="text" name="address1" placeholder="Address 1" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <input type="text" name="address2" placeholder="Address 2" class="form-control">
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <select name="city" class="form-control select2" style="width: 100%;" disabled>
                                            <option value="MUKAH">MUKAH</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" name="postcode" placeholder="Postcode" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <select name="city" class="form-control select2" style="width: 100%;" disabled>
                                            <option value="SARAWAK">SARAWAK</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <select name="city" class="form-control select2" style="width: 100%;" disabled>
                                            <option value="MALAYSIA">MALAYSIA</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="controller/user.php?action=delete&id=$row[id]" class="btn btn-danger">Delete</a>
                    </div>
                </form>
          </div>
      </div>
      <!-- /.box -->

    </section>
  </div>
  <!-- /.content-wrapper -->
<?php include_once ('footer.php'); ?>
</body>
</html>

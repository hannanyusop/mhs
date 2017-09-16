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
        Service
        <small>Add</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-slideshare"></i> Service</a></li>
        <li class="active">Add</li>
      </ol>
    </section>

    <section class="content">

      <!-- Default box -->
      <div class="box">
          <div class="box-body">
                <form action="controller/service.php" method="post">
                    <input type="hidden" name="action" value="add">
                    <div class="row">

                        <div class="box-body col-lg-6">

                            <legend>Basic Info</legend>

                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="title" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description"  placeholder="This service focusing on ..." class="form-control" rows="5" required></textarea>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>Basic Price</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">RM</div>
                                            <input type="text" name="basic_price" placeholder="200.00" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>Qouta</label>
                                        <input type="number" name="qouta" placeholder="1 ... 100" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>Status</label>
                                        <select name="status" class="form-control select2" style="width: 100%;" >
                                            <option value="1">ACTIVE</option>
                                            <option value="2">DEACTIVE</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="box-body col-lg-6">
                            <legend>Add-on List</legend>

                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 80px">Price</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                </tr>
                                <tr>
                                    <td><input type="text" name="price" class="form-control"></td>
                                    <td><input type="text" name="name" class="form-control"></td>
                                    <td>
                                        <select name="status" class="form-control select2" style="width: 100%;" >
                                            <option value="1">ACTIVE</option>
                                            <option value="2">DEACTIVE</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>

                        </div>
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
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
<script></script>

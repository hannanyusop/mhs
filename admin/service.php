<!DOCTYPE html>
<html>
<?php include_once('head.php'); ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

<?php include_once('aside.php'); ?>
<?php
    $status_label = [
        1 => '<span class="label label-warning">Inactive</span>',
        2 => '<span class="label label-success">Active</span>',
        3 => '<span class="label label-danger">Banned</span>',
    ];
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Version 2.0</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-slideshare"></i> Service</a></li>
        <li class="active">List</li>
      </ol>
    </section>

      <section class="content">

          <div class="row">
              <div class="col-xs-12">

                  <div class="box">
                      <div class="box-header">
                          <h3 class="box-title">All Users</h3>
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                          <table id="example1" class="table table-bordered table-striped">
                              <thead>
                              <tr>
                                  <th>Services</th>
                                  <th>Description</th>
                                  <th>Basic Price</th>
                                  <th>Status</th>
                                  <th>Action</th>
                              </tr>
                              </thead>
                                  <tbody>
                                  <?php
                                      $sql = "SELECT * FROM services";
                                      $result = mysqli_query($conn, $sql);
                                      while($row = mysqli_fetch_assoc($result)) {
                                          echo "<tr>";
                                          echo "<td>$row[title]</td>";
                                          echo "<td>".mb_strimwidth($row['description'], 0, 40, '...')."</td>";
                                          echo "<td>$row[basic_price]</td>";
                                          echo "<td>".$status_label[$row['status']]."</td>";
                                          echo "<td><a href='service-view.php?id=$row[id]' class='btn btn-sm btn-info''>View</a></td>";
                                          echo "</tr>";
                                      }

                                  ?>
                              </tbody>
                              <tfoot>
                              <tr>
                                  <th>Services</th>
                                  <th>Description</th>
                                  <th>Basic Price</th>
                                  <th>Status</th>
                                  <th>Action</th>
                              </tr>
                              </tfoot>
                          </table>
                      </div>
                      <!-- /.box-body -->
                  </div>
              </div>
          </div>
      </section>
  </div>
  <!-- /.content-wrapper -->

<?php include_once ('footer.php'); ?>
    <script>
        $(function () {
            $('#example1').DataTable()
            $('#example2').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false
            })
        })
    </script>
</body>
</html>

<!DOCTYPE html>
<html>
<?php include_once('head.php'); ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

<?php include_once('aside.php'); ?>
<?php
    $status_label = [
        0 => '<span class="label label-warning">unread</span>',
        1 => '<span class="label label-success">seen</span>',
        2 => '<span class="label label-info">solve</span>',
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
        <li><a href="#"><i class="fa fa-users"></i> Users</a></li>
        <li class="active">List</li>
      </ol>
    </section>

      <section class="content">

          <div class="row">
              <div class="col-xs-12">

                  <div class="box">
                      <div class="box-header">
                          <h3 class="box-title">All Question</h3>
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                          <table id="example1" class="table table-bordered table-striped">
                              <thead>
                              <tr>
                                  <th>ID</th>
                                  <th>Name</th>
                                  <th>Email</th>
                                  <th>Status</th>
                                  <th>Action</th>
                              </tr>
                              </thead>
                                  <tbody>
                                  <?php
                                      $sql = "SELECT * FROM contact_us ORDER BY seen ASC";
                                      $result = mysqli_query($conn, $sql);
                                      while($row = mysqli_fetch_assoc($result)) {
                                          echo "<tr>";
                                          echo "<td>".$row['id']."</td>";
                                          echo "<td>$row[name]</td>";
                                          echo "<td>$row[email]</td>";
                                          echo "<td>".$status_label[$row['seen']]."</td>";
                                          echo "<td><a href='contact-us-view.php?id=$row[id]' class='btn btn-sm btn-info''>View</a></td>";
                                          echo "</tr>";
                                      }

                                  ?>
                              </tbody>
                              <tfoot>
                              <tr>
                                  <th>Name</th>
                                  <th>Email</th>
                                  <th>Phone number</th>
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

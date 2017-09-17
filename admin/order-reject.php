<!DOCTYPE html>
<html>
<?php include_once('head.php'); ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <?php include_once('aside.php'); ?>
    <?php
    $status_label = [
        1 => '<span class="label label-warning">Pending</span>',
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
                <li><a href="#"><i class="fa fa-users"></i> Orders</a></li>
                <li class="active">Rejected</li>
            </ol>
        </section>

        <section class="content">

            <div class="row">
                <div class="col-xs-12">

                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">All Rejected Orders</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Service</th>
                                    <th>Admin notes</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                //status 3 is pending
                                $sql = "SELECT *,c.title as service_title,d.title as add_on_title  FROM orders as a LEFT JOIN users as b ON b.id=a.user_id LEFT JOIN services as c ON c.id=a.service_id LEFT JOIN services_add_on as d ON d.id=a.services_add_on_id WHERE a.status = '3'";
                                $result = mysqli_query($conn, $sql);
                                while($row = mysqli_fetch_assoc($result)) {

                                    echo "<td>".$row['first_name']." ".$row['last_name']."</td>";
                                    echo "<td>".$row['service_title']."-".$row['add_on_title']."(RM ".$row['price'].")</td>";
                                    echo "<td>".$row['admin_note']."</td>";
                                    echo"<td><a href='order-view.php?id=".$row['id']."' class='btn btn-sm btn-info''>View</a></td>";
                                }
                                ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Service</th>
                                    <th>Admin Notes</th>
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

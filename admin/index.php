<!DOCTYPE html>
<html>
<?php include_once('head.php'); ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <?php
    $status_label = [
        1 => '<span class="label label-warning">Pending</span>',
        2 => '<span class="label label-info">Approved</span>',
        3 => '<span class="label label-success">Completed</span>',
        4 => '<span class="label label-danger">Rejected</span>',
        5 => '<span class="label label-default">Canceled</span>'
    ];
    ?>
<?php include_once('aside.php'); ?>

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Dashboard
        <small>Version 2.0</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <section class="content">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-server"></i></span>
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM services WHERE status = 1 ");
                    $t_services = mysqli_num_rows($result);
                    ?>
                    <div class="info-box-content">
                        <span class="info-box-text">Active Service</span>
                        <span class="info-box-number"><?=$t_services?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-star"></i></span>
                    <?php
                        $result = mysqli_query($conn, "SELECT * FROM orders WHERE rating != 0 ");
                        $t_star = mysqli_num_rows($result);
                    ?>
                    <div class="info-box-content">
                        <span class="info-box-text">Rating</span>
                        <span class="info-box-number"><?=$t_star?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>
                    <?php
                    $result = mysqli_query($conn, "SELECT SUM(grand_price) as grand_price FROM orders WHERE status = 3 ");
                    while($row = mysqli_fetch_assoc($result)) {
                        $grand_price = $row['grand_price'];
                    }
                    ?>
                    <div class="info-box-content">
                        <span class="info-box-text">Sales</span>
                        <span class="info-box-number">RM<?=$grand_price?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM users WHERE level = 'USER' ");
                    $t_users = mysqli_num_rows($result);
                    ?>
                    <div class="info-box-content">
                        <span class="info-box-text">Members</span>
                        <span class="info-box-number"><?=$t_users?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <div class="col-md-8">
                <!-- MAP & BOX PANE --><!-- /.box -->
                <div class="row">
                    <div class="col-md-6">

                    </div>
                    <!-- /.col -->

                    <div class="col-md-6">
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- TABLE: LATEST ORDERS -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Latest Orders</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table no-margin">
                                <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Item</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sql = "SELECT *,a.id as order_id,a.status as order_status FROM orders as a LEFT JOIN users as b ON b.id=a.user_id LEFT JOIN services as c ON c.id=a.service_id LEFT JOIN services_add_on as d ON d.id=a.services_add_on_id LIMIT 10";

                                $result = mysqli_query($conn, $sql);
                                while($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>#".$row['order_id']."</td>";
                                    echo "<td>".$row['title']."</td>";
                                    echo "<td>".$status_label[$row['order_status']]."</td>";
                                    echo "</tr>";
                                }

                                ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <a href="order.php" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
                    </div>
                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->

            <div class="col-md-4">
                <!-- Info Boxes Style 2 -->
                <div class="info-box bg-yellow">
                    <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM orders where status = 1 OR status = 3 ");
                    $order = mysqli_num_rows($result);
                    $result1 = mysqli_query($conn, "SELECT * FROM orders WHERE status = 1 ");
                    $pending_order = mysqli_num_rows($result1);
                    ?>
                    <div class="info-box-content">
                        <span class="info-box-text">Pending Order</span>
                        <span class="info-box-number"><?=$pending_order?></span>

                        <div class="progress">
                            <?php $progress = round(($pending_order/$order)*100);?>
                            <div class="progress-bar" style="width: <?=$progress?>%"></div>
                        </div>
                        <span class="progress-description">
                    <?=$progress?>% are pending order!
                  </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->

                <!-- /.info-box -->
                <div class="info-box bg-aqua">
                    <span class="info-box-icon"><i class="ion-ios-chatbubble-outline"></i></span>
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM contact_us ");
                    $c_us = mysqli_num_rows($result);
                    $result1 = mysqli_query($conn, "SELECT * FROM contact_us WHERE seen = 0 ");
                    $c_us_seen = mysqli_num_rows($result1);
                    ?>
                    <div class="info-box-content">
                        <span class="info-box-text">Direct Messages</span>
                        <span class="info-box-number"><?=$c_us ?></span>

                        <div class="progress">
                            <?php $progress = round(($c_us_seen/$c_us)*100);?>
                            <div class="progress-bar" style="width: <?=$progress?>%"></div>
                        </div>
                        <span class="progress-description">
                            <?=$progress?>% unread message
                  </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->

                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">Latest Members</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <ul class="users-list clearfix">
                            <?php
                            $result = mysqli_query($conn, "SELECT * FROM users");
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "<li>";
                                echo "<img src='' alt=''>";
                                echo "<span class='users-list-name'><?=$row[last_name]?></span>";
                                echo "<span class='users-list-date'><?=$row[created]?></span>";
                                echo "</li>";
                            }

                            ?>
                        </ul>
                        <!-- /.users-list -->
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer text-center">
                        <a href="user.php" class="uppercase">View All Users</a>
                    </div>
                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->

                <!-- PRODUCT LIST -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Recently Added Services</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <ul class="products-list product-list-in-box">
                            <?php
                            $result = mysqli_query($conn, "SELECT * FROM services LIMIT 5");
                            while($row = mysqli_fetch_assoc($result)) { ?>
                            <li class="item">
                                <div class="product-img">
                                    <img src="dist/img/default-50x50.gif" alt="Product Image">
                                </div>
                                <div class="product-info">
                                    <a href="javascript:void(0)" class="product-title"><?=$row['title']?>
                                        <span class="label label-warning pull-right">RM<?=$row['basic_price']?></span></a>
                                </div>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer text-center">
                        <a href="javascript:void(0)" class="uppercase">View All Products</a>
                    </div>
                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
      <!-- /.content -->
  </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
<?php include_once ('footer.php'); ?>
</body>
</html>

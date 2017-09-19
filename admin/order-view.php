<!DOCTYPE html>
<html>
<?php
$status_label = [
    1 => '<span class="label label-warning">Pending</span>',
    2 => '<span class="label label-info">Approved</span>',
    3 => '<span class="label label-success">Completed</span>',
    4 => '<span class="label label-danger">Rejected</span>',
    5 => '<span class="label label-default">Canceled</span>'
];
?>
<?php include_once('head.php'); ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

<?php include_once('aside.php'); ?>

<?php
    $sql = "SELECT *,a.id as order_id,c.title as service_title,c.basic_price as service_basic_price,d.title as services_add_on_title,d.price as sevices_add_on_price,a.status as order_status  FROM orders as a 
            LEFT JOIN users as b ON b.id=a.user_id 
            LEFT JOIN services as c ON c.id=a.service_id 
            LEFT JOIN services_add_on as d ON d.id=a.services_add_on_id WHERE a.id = '$_GET[id]'";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)) {
?>

<div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    View Order
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="#">Order</a></li>
                    <li class="active">View</li>
                </ol>
            </section>

            <div class="pad margin no-print">
                <div class="callout callout-info" style="margin-bottom: 0!important;">
                    <h4><i class="fa fa-info"></i> Note:</h4>
                    Approve order to generate invoice.
                </div>
            </div>

            <!-- Main content -->
            <section class="invoice">
                <!-- title row -->
                <div class="row">
                    <div class="col-xs-12">
                        <h2 class="page-header">
                            <i class="fa fa-globe"></i> Service Hero Mukah
                        </h2>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        To:
                            <strong><?=$row['first_name']." ".$row['last_name'] ?></strong><br>
                            <?=$row['address1'] ?><br>
                            <?=$row['address2'] ?><br>
                            <?=$row['city'].",".$row['postcode'] ?><br>
                            <?=$row['states'].",<b>".$row['country'] ?></b><br>
                            Phone: <?=$row['phone'] ?><br>
                            Email: <?=$row['email'] ?>
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        From
                        <address>
                            <strong>Service Hero Mukah Management</strong><br>
                            POLITEKNIK MUKAH<br>
                            KM 7.5, Jalan Oya, 97000<br>
                            MUKAH,SARAWAK<br>
                            Phone: (555) 539-1037<br>
                            Email: admin@pmu.edu.my
                        </address>
                    </div>

                </div>

                <div class="row">
                    <div class="col-xs-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Qty</th>
                                <th>Service</th>
                                <th>Description</th>
                                <th>Subtotal</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>1</td>
                                <td><?=$row['service_title']?></td>
                                <td>SERVICE</td>
                                <td>RM<?=$row['service_basic_price']?></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>1</td>
                                <td><?=$row['services_add_on_title']?></td>
                                <td>ADD ON</td>
                                <td>RM<?=$row['sevices_add_on_price'] ?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row">
                    <!-- accepted payments column -->
                    <div class="col-xs-6">
                        <p class="lead">Status: <?=$status_label[$row['order_status']]?></p>
                        <p class="lead">Payment Methods: CASH</p>

                        <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                            <b>Notes</b>:<br><?=$row['admin_note']?>
                        </p>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-6">
                        <p class="lead">TOTAL</p>

                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th style="width:50%">Subtotal:</th>
                                    <td>RM <?=number_format((float)$row['service_basic_price']+$row['sevices_add_on_price'], 2, '.', '');?></td>
                                </tr>
                                <tr>
                                    <th>Tax</th>
                                    <td>RM <?= $row['tax_price'] ?></td>
                                </tr>
                                <tr>
                                    <th>Total:</th>
                                    <td>RM <?=number_format((float)$row['service_basic_price']+$row['sevices_add_on_price']+$row['tax_price'], 2, '.', '');?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- this row will not appear when printing -->
                <div class="row no-print">
                    <div class="col-xs-12">
                        <?php if($row['order_status'] == 3) : ?>
                        <a href="order-print.php?id=<?=$_GET['id']?>" target="_blank" class="btn btn-info"><i class="fa fa-print"></i>
                            Print</a>
                        <?php endif; ?>
                        <?php
                        if($row['order_status'] == 1 ) { ?>
                            <a href="controller/order.php?action=approve&id=<?=$row['order_id']?>" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i>
                                Aprrove
                            </a>
                            <button type="button" class="btn btn-warning pull-right" style="margin-right: 5px;" data-toggle="modal" data-target="#myModal">
                                <i class="fa fa-minus-circle"></i> Reject
                            </button>
                        <?php }?>
                    </div>
                </div>
            </section>
            <!-- /.content -->
            <div class="clearfix"></div>
        </div>

        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">
                <!-- Modal content-->
                <form action="controller/order.php" method="post">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h4 class="modal-title">Reject Order</h4>
                        </div>

                        <div class="modal-body">
                            <div class="form-group">
                                <input type="hidden" name="action" value="reject">
                                <input type="hidden" name="order_id" value="<?=$row['order_id']?>">
                                <label class="control-label" for="txtDescripcion">Reasons</label>
                                <textarea class="form-control" name="admin_note" rows="5">Not valid/complete information</textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-success" value="Submit">
                        </div>
                    </div>
                </form>

            </div>
        </div>

<?php } ?>
<?php include_once ('footer.php'); ?>
</body>
</html>

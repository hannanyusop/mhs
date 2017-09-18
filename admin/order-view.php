<!DOCTYPE html>
<html>
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
                    Invoice
                    <small>#007612</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="#">Examples</a></li>
                    <li class="active">Invoice</li>
                </ol>
            </section>

            <div class="pad margin no-print">
                <div class="callout callout-info" style="margin-bottom: 0!important;">
                    <h4><i class="fa fa-info"></i> Note:</h4>
                    This page has been enhanced for printing. Click the print button at the bottom of the invoice to
                    test.
                </div>
            </div>

            <!-- Main content -->
            <section class="invoice">
                <!-- title row -->
                <div class="row">
                    <div class="col-xs-12">
                        <h2 class="page-header">
                            <i class="fa fa-globe"></i> Service Hero Mukah
                            <small class="pull-right">Date: 2/10/2014</small>
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

                    <div class="col-sm-4 invoice-col">
                        <b>Invoice #007612</b><br>
                        <br>
                        <b>Order ID:</b> 4F3S8J<br>
                        <b>Payment Due:</b> 2/22/2014<br>
                        <b>Account:</b> 968-34567
                    </div>

                </div>

                <div class="row">
                    <div class="col-xs-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Qty</th>
                                <th>Product</th>
                                <th>Serial #</th>
                                <th>Description</th>
                                <th>Subtotal</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td><?=$row['service_title']?></td>
                                <td>455-981-221</td>
                                <td>El snort testosterone trophy driving gloves handsome</td>
                                <td>RM<?=$row['service_basic_price']?></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td><?=$row['services_add_on_title']?></td>
                                <td>247-925-726</td>
                                <td>Wes Anderson umami biodiesel</td>
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
                        <p class="lead">Payment Methods:</p>
                        <img src="dist/img/credit/visa.png" alt="Visa">
                        <img src="dist/img/credit/mastercard.png" alt="Mastercard">
                        <img src="dist/img/credit/american-express.png" alt="American Express">
                        <img src="dist/img/credit/paypal2.png" alt="Paypal">

                        <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                            CASH TERM ONLY
                        </p>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-6">
                        <p class="lead">Amount Due 2/22/2014</p>

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
                        <a href="controller/order.php?action=approve&id=<?=$row['order_id']?>" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i>
                            Aprrove
                        </a>
                        <button type="button" class="btn btn-warning pull-right" style="margin-right: 5px;">
                            <i class="fa fa-minus-circle"></i> Reject
                        </button>
                    </div>
                </div>
            </section>
            <!-- /.content -->
            <div class="clearfix"></div>
        </div>

<?php } ?>
<?php include_once ('footer.php'); ?>
</body>
</html>

<!DOCTYPE html>
<?php include_once ('../connection.php'); ?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MUKAH SERVICE HERO | Invoice</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<?php
$sql = "SELECT * FROM invoices WHERE order_id = $_GET[id]";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
?>
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i>MUKAH SERVICE HERO
          <small class="pull-right">Date: <?=$row['date_process'] ?></small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        To :
        <address>
          <strong><?=$row['user_name'] ?></strong><br>
            <?=$row['address'] ?><br>
            <?=$row['email'] ?>
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
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <b>Invoice #<?=$row['id']?></b><br>
        <br>
        <b>Order ID:</b> <?=$row['order_id'] ?><br>
        <b>Payment Due:</b><br>
        <b>Account:</b> -NA-
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>No</th>
            <th>Qty</th>
            <th>Service</th>
            <th>Price</th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td>1</td>
            <td>1</td>
            <td><?=$row['service_title'] ?></td>
            <td><?=$row['service_price'] ?></td>
          </tr>
          <tr>
            <td>2</td>
            <td>1</td>
            <td><?=$row['add_on_title'] ?></td>
            <td><?=$row['add_on_price'] ?></td>
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
        <img src="../../dist/img/credit/visa.png" alt="Visa">
        <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
        <img src="../../dist/img/credit/american-express.png" alt="American Express">
        <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

        <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
          CASH TERM ONLY
        </p>
      </div>
      <!-- /.col -->
      <div class="col-xs-6">
        <p class="lead">Amount Due4</p>

        <div class="table-responsive">
          <table class="table">
            <tr>
              <th style="width:50%">Subtotal:</th>
              <td>RM <?=$row['sub_total'] ?></td>
            </tr>
            <tr>
              <th>Tax</th>
              <td>RM <?=$row['tax'] ?></td>
            </tr>
            <tr>
              <th>Total:</th>
              <td>RM <?=$row['grand_total'] ?></td>
            </tr>
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
<?php } ?>
</html>

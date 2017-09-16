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
                <li class="active">Edit</li>
            </ol>
        </section>

        <section class="content">
            <?php
            if(isset($_GET['id'])) {
                $sql = "SELECT * FROM services";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="box">
                        <div class="box-body">
                            <div class="row">

                                <div class="box-body col-lg-6">

                                    <legend>Basic Info</legend>

                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" name="title" value="<?=$row['title'] ?>" class="form-control" disabled>
                                    </div>

                                    <div class="form-group">
                                        <label>Description</label>
                                        <div class="alert alert-info"><?= $row['description'] ?></div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label>Basic Price</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">RM</div>
                                                    <input type="text" name="basic_price" value="<?=$row['basic_price'] ?>"
                                                           class="form-control" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label>Qouta</label>
                                                <input type="number" name="qouta" value="<?=$row['qouta'] ?>" class="form-control"
                                                       disabled>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label>Status</label>
                                                <select name="status" class="form-control select2" style="width: 100%;" disabled>
                                                    <option value="1"<?php if($row['status'] == 1 ){ echo 'selected'; } ?>>ACTIVE</option>
                                                    <option value="2" <?php if($row['status'] == 2 ){ echo 'selected'; } ?>>DEACTIVE</option>
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
                                            <th>Title</th>
                                            <th>Status</th>
                                        </tr>
                                        <form action="controller/service_add_on.php" method="post">
                                            <input type="hidden" name="action" value="add">
                                            <input type="hidden" name="service_id" value="<?=$_GET['id']?>">
                                            <tr>
                                                <td><input type="text" name="price" class="form-control"></td>
                                                <td><input type="text" name="title" class="form-control"></td>
                                                <td><input type="submit" value="Add" class="btn btn-success btn-sm"></td>
                                            </tr>
                                            <?php
                                            $sql = "SELECT * FROM services_add_on WHERE service_id =$_GET[id] ORDER BY price asc";
                                            $result = mysqli_query($conn, $sql);
                                            while($row1 = mysqli_fetch_assoc($result)) {
                                                echo "<tr>";
                                                echo "<td>RM $row1[price]</td>";
                                                echo "<td>$row1[title]</td>";
                                                echo "<td><a href='controller/service_add_on.php?action=disabled&id=$row1[id]' class='btn btn-warning btn-sm'>Disabled</a> </td>";
                                                echo "</tr>";
                                            }
                                            ?>
                                        </form>
                                    </table>

                                </div>
                            </div>

                            <div class="box-footer">
                                <a href="service-edit.php?id=<?=$row['id'] ?>" class="btn btn-info">Edit</a>
                                <a href="service.php" class="btn btn-warning">Back</a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }else{
                $_SESSION['error'] = [
                    'code' => '404',
                    'url'  => 'service.php',
                    'msg'  => 'Service not found'
                ];

                echo "<script>window.location='404.php'</script>";
            }
            ?>
            <!-- /.box -->

        </section>
    </div>
    <!-- /.content-wrapper -->
    <?php include_once ('footer.php'); ?>
</body>
</html>
<script></script>

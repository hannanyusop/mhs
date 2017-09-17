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
                $sql = "SELECT * FROM services WHERE id = '$_GET[id]'";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="box">
                        <form action="controller/service.php" method="post" class="box-body">
                            <input type="hidden" name="action" value="edit">
                            <input type="hidden" name="id" value="<?=$row['id'] ?>">
                            <div class="row">

                                <div class="box-body col-lg-6">

                                    <legend>Basic Info</legend>

                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" name="title" value="<?=$row['title'] ?>" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label>Basic Price</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">RM</div>
                                                    <input type="text" name="basic_price" value="<?=$row['basic_price'] ?>" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label>Qouta</label>
                                                <input type="number" name="qouta" value="<?=$row['qouta'] ?>" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label>Status</label>
                                                <select name="status" class="form-control select2" style="width: 100%;" required>
                                                    <option value="1"<?php if($row['status'] == 1 ){ echo 'selected'; } ?>>ACTIVE</option>
                                                    <option value="2" <?php if($row['status'] == 2 ){ echo 'selected'; } ?>>DEACTIVE</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="box-body col-lg-6">
                                    <legend>Description</legend>

                                    <div class="form-group">
                                        <textarea id="description" name="description" rows="10" cols="80" required>
                                            <?=$row['description']?>
                                        </textarea>
                                    </div>

                                </div>
                            </div>

                            <div class="box-footer">
                                <button type="submit" class="btn btn-success">Update</button>
                                <a href="service.php" class="btn btn-warning">Back</a>
                            </div>
                        </form>
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
<script>
    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('description')
        //bootstrap WYSIHTML5 - text editor
        $('.textarea').wysihtml5()
    })
</script>

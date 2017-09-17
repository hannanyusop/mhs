<?php include 'header.php';?>
<?php
    //unset this session nto prevent page redirect looping
    unset($_SESSION["service"]);
    if(isset($_SESSION['level'])){

    }else{
        $_SESSION['service'] = 'TEST';
        echo "<script>alert('You need to login before you can book our service.');window.location='login.php'</script>";
    }
?>
<div class="container">

<h1 class="title">Order</h1>
    <!-- reservation-information -->
    <div id="information" class="spacer reserve-info ">
        <div class="container">
            <div class="row">
                <div class="col-sm-7 col-md-8">
                    <div class="embed-responsive embed-responsive-16by9 wowload fadeInLeft">
                        <div id="RoomDetails" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="item active"><img src="images/photos/8.jpg" class="img-responsive" alt="slide"></div>
                                <div class="item  height-full"><img src="images/photos/9.jpg"  class="img-responsive" alt="slide"></div>
                                <div class="item  height-full"><img src="images/photos/10.jpg"  class="img-responsive" alt="slide"></div>
                            </div>
                            <!-- Controls -->
                            <a class="left carousel-control" href="#RoomDetails" role="button" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                            <a class="right carousel-control" href="#RoomDetails" role="button" data-slide="next"><i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-5 col-md-4">
                    <h3>Reservation</h3>
                    <form role="form" action="controller/order.php" method="post" class="wowload fadeInRight">
                        <input type="hidden" name="action" value="add">
                        <input type="hidden" name="service_id" value="<?=$_GET['id']?>">
                    <?php
                        $sql = "SELECT * FROM users WHERE id = $_SESSION[user_id]";
                        $result = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <input type="hidden" name="user_id" value="<?=$row['id'] ?>">

                        <div class="form-group">
                            <input type="text" name="firt_name"  value="<?=$row['first_name']?>" class="form-control"  disabled>
                        </div>
                        <div class="form-group">
                            <input type="email"  name="email" value="<?= $row['email'] ?>" class="form-control"  disabled>
                        </div>
                        <div class="form-group">
                            <input type="Phone" name="phone" value="<?=$row['phone'] ?>" class="form-control"  disabled>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-12">
                                    <select name="services_add_on_id" class="form-control">
                                    <?php
                                        $sql = "SELECT * FROM services_add_on WHERE service_id =$_GET[id] ORDER BY price asc";
                                        $result = mysqli_query($conn, $sql);
                                        while($row1 = mysqli_fetch_assoc($result)) {
                                            echo "<option value='$row1[id]'>$row1[title](RM $row1[price])</option>";
                                        }
                                    ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-6">
                                    <input type="date" name="date" class="form-control" required>
                                </div>
                                <div class="col-xs-6">
                                    <input type="time" name="time" class="form-control" required>
                                </div>
                            </div>
                        </div>

                         <input type="hidden" name="grand_price" value="21.00">

                        <div class="form-group">
                            <textarea name="user_note" class="form-control"  placeholder="Message" rows="4"></textarea>
                        </div>
                        <button class="btn btn-default">Submit</button>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- reservation-information -->
</div>
<?php include 'footer.php';?>
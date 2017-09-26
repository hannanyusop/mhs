<?php include 'header.php';?>
<?php
    //unset this session nto prevent page redirect looping
    unset($_SESSION["service"]);
    if(isset($_SESSION['level'])){

    }else{
        $_SESSION['service'] = $_GET['id'];
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
                                    <div class="col-xs-4">
                                        <select name="day" class="form-control" required>
                                            <option>Day</option>
                                            <?php $day =1; while ($day<=31){ ?>
                                                <option value="<?=$day?>"><?=$day?></option>
                                                <?php $day++; } ?>
                                        </select>
                                    </div>
                                    <div class="col-xs-4">
                                        <select name="month" class="form-control" required>
                                            <option>Month</option>
                                            <?php $month =1; while ($month<=12){ ?>
                                                <option value="<?=$month?>"><?=$month?></option>
                                                <?php $month++; } ?>
                                        </select>
                                    </div>
                                    <div class="col-xs-4">
                                        <select name="year" class="form-control" required>
                                            <option>Year</option>
                                            <option value="2017">2017</option>
                                            <option value="2018">2018</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <select name="hrs" class="form-control" required>
                                            <option>Hrs</option>
                                            <option value="07">07</option>
                                            <option value="08">08</option>
                                            <option value="09">09</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                            <option value="14">14</option>
                                            <option value="15">15</option>
                                            <option value="16">16</option>
                                            <option value="17">17</option>
                                            <option value="18">18</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-4">
                                        <select name="min" class="form-control" required>
                                            <option>Min</option>
                                            <option value="00">00</option>
                                            <option value="15">15</option>
                                            <option value="30">30</option>
                                            <option value="45">45</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-4">
                                        <select name="sec" class="form-control" disabled>
                                            <option>00</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

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
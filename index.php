<?php include 'header.php';?>

<!-- banner -->
<div class="banner">    	   
    <img src="images/photos/banner.jpg"  class="img-responsive" alt="slide">
    <div class="welcome-message">
        <div class="wrap-info">
            <div class="information">
                <h1  class="animated fadeInDown">Job Service Hero <br><b>MUKAH</b></h1>
                <p class="animated fadeInUp">Most luxurious hotel of asia with the royal treatments and excellent customer service.</p>                
            </div>
            <a href="#information" class="arrow-nav scroll wowload fadeInDownBig"><i class="fa fa-angle-down"></i></a>
        </div>
    </div>
</div>
<!-- banner-->

<!-- services -->
<div class="spacer services wowload fadeInUp">
<div class="container">
    <div class="row">

        <?php
            $sql = "SELECT * FROM services ORDER BY id DESC LIMIT 3";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)) {
         ?>

        <div class="col-sm-4">
            <!-- RoomCarousel -->
            <div id="FoodCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                <div class="item active"><img src="images/photos/1.jpg" class="img-responsive" alt="slide"></div>
                <div class="item  height-full"><img src="images/photos/2.jpg"  class="img-responsive" alt="slide"></div>
                <div class="item  height-full"><img src="images/photos/5.jpg"  class="img-responsive" alt="slide"></div>
                </div>
                <!-- Controls -->
                <a class="left carousel-control" href="#FoodCarousel" role="button" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                <a class="right carousel-control" href="#FoodCarousel" role="button" data-slide="next"><i class="fa fa-angle-right"></i></a>
            </div>
            <!-- RoomCarousel-->
            <div class="caption">
                <?=$row['title'] ?> <span class="label label-primary">RM<?= $row['basic_price'] ?></span>
                <a href="gallery.php" class="pull-right"><i class="fa fa-edit"></i></a>
            </div>
        </div>

         <?php } ?>

    </div>

    <div class="text-center">
        <ul class="pagination">
            <li class="disabled"><a href="#">«</a></li>
            <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
            <li><a href="service.php">See All ..</a></li>
        </ul>
    </div>

</div>
</div>
<!-- services -->


<?php include 'footer.php';?>
<?php include 'header.php';?>

<!-- banner -->
<div class="banner">    	   
<img src="images/photos/mukahservicehero.jpg" style="width:100%;height:50%"> class="img-responsive" alt="slide"></div>
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
                    <?php
                    $result3 = mysqli_query($conn, "SELECT * FROM service_images WHERE service_id=$row[id]");

                    if (mysqli_num_rows($result3) > 0) {
                        while($row3 = mysqli_fetch_assoc($result3)) {
                            echo "<img src='images/$row3[image]'  class='img-responsive' alt='slide'>";
                        }
                    }else{
                        echo "<img src='images/no-image-found.gif'  class='img-responsive' alt='slide'>";
                    }
                    ?>
                </div>
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
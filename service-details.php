<?php include 'header.php';?>
<?php
    if(isset($_GET['id'])) {
        $sql = "SELECT * FROM services WHERE id = $_GET[id]";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                ?>

                <div class="container">

                    <h1 class="title"><?=$row['title'] ?></h1>


                    <!-- RoomDetails -->
                    <div id="RoomDetails" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="item active"><img src="images/photos/8.jpg" class="img-responsive" alt="slide">
                            </div>
                            <div class="item  height-full"><img src="images/photos/9.jpg" class="img-responsive"
                                                                alt="slide">
                            </div>
                            <div class="item  height-full"><img src="images/photos/10.jpg" class="img-responsive"
                                                                alt="slide">
                            </div>
                        </div>
                        <!-- Controls -->
                        <a class="left carousel-control" href="#RoomDetails" role="button" data-slide="prev"><i
                                    class="fa fa-angle-left"></i></a>
                        <a class="right carousel-control" href="#RoomDetails" role="button" data-slide="next"><i
                                    class="fa fa-angle-right"></i></a>
                    </div>
                    <!-- RoomCarousel-->

                    <div class="room-features spacer">
                        <div class="row">
                            <div class="col-sm-12 col-md-5">
                                <p><?=$row['description'] ?></p>
                            </div>
                            <div class="col-sm-6 col-md-3 amenitites">
                                <h3>Details</h3>
                                <ul>
                                    <li>Basic Price : RM<?=$row['basic_price'] ?></li>
                                    <li>Qouta :<?=$row['qouta'] ?></li>
                                </ul>


                            </div>
                            <div class="row">
                                <div class="col-sm-4 col-md-3 col-lg-4">
                                    <a href="service-order.php" class="btn btn-default btn-block btn-lg">ORDER NOW</a>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

                <?php
            }
        } else {
            //if no service was found
            $_SESSION['error'] = [
                'code' => '404',
                'msg' => 'SERVICE NOT FOUND OR DELTED',
                'url' => 'service.php'
            ];
            echo "<script>window.location='404.php'</script>";
        }
    }else{
        //if url parameter is empty
        $_SESSION['error'] = [
            'code' => '404',
            'msg' => 'PAGE NOT FOUND',
            'url' => 'service.php'
        ];
        echo "<script>window.location='404.php'</script>";
    }
?>
<?php include 'footer.php';?>
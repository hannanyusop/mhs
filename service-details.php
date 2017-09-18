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
                            <div class="item  height-full"><img src="images/_03282016103611478_d5e4f548-4e5f-482c-98c3-72c61f111adc.jpg.jpeg" class="img-responsive">
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
                                    <a href="service-order.php?id=<?=$row['id']?>" class="btn btn-default btn-block btn-lg">ORDER NOW</a>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <legend><h3>Users Feedback </h3></legend>
                            </div><!-- /col-sm-12 -->
                        </div>

                        <?php
                        $result3 = mysqli_query($conn, "SELECT *,a.id as service_id,b.first_name as f_name FROM orders as a LEFT JOIN users as b ON b.id=a.user_id WHERE a.service_id=$row[id] ORDER BY a.id desc LIMIT 6");

                        if (mysqli_num_rows($result3) > 0) {
                            while($row3 = mysqli_fetch_assoc($result3)) { ?>

                                <div class="row">
                                    <div class="col-sm-1">
                                        <div class="thumbnail">
                                            <img class="img-responsive user-photo" src="images/avatar_2x.png">
                                        </div><!-- /thumbnail -->
                                    </div><!-- /col-sm-1 -->

                                    <div class="col-sm-10">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <strong><?=$row3['f_name'] ?></strong>
                                                <span class="text-align-right text-muted">

                                                </span>
                                            </div>
                                            <div class="panel-body">
                                                <p align="right">
                                                    Rating :
                                                    <?php
                                                    if($row3['rating'] > 0 ){
                                                        echo "<mark>";
                                                        $stars =1;
                                                        do{
                                                            echo "<span>☆</span>";
                                                            $stars++;
                                                        }while($stars< $row3['rating']);
                                                        echo "</mark>";
                                                    }else{
                                                        echo "Rating not available";
                                                    }
                                                    ?>
                                                </p>
                                               <?=$row3['rating_note'];?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                        <?php  }
                        }else{ ?>
                            <div class="col-sm-12">
                                <h4>-No Comment-</h4>
                            </div><!-- /col-sm-12 -->
                        <?php } ?>

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
<style>
    .rating > span:hover:before {
        content: "\2605";
        position: absolute;
    }
    mark {
        background-color: yellow;
        color: black;
    }
</style>

<?php include 'header.php';?>

<div class="container">

<h2>Services & Others</h2>

<div class="row">

    <?php
        $sql = "SELECT *,a.id as service_id FROM services as a ORDER BY a.id DESC";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)) {

            //to get rating average
            $sql_total_orders = mysqli_query($conn, "SELECT * FROM orders WHERE service_id = $row[service_id] AND rating != 0 AND rating <=5 ");
            $total_orders = mysqli_num_rows($sql_total_orders);

            $res = mysqli_query($conn,"SELECT SUM(rating) as total_stars FROM orders WHERE service_id = $row[service_id] AND rating !=0 AND rating <=5  AND status = 3");
            $row1 = mysqli_fetch_array($res);
            $sum = $row1[0];

            //to prevent from run-time error cause of division by zero
            if($total_orders > 0){
                $avg = $sum/$total_orders;
            }else{
                $avg = 0;
            }
    ?>
      <div class="col-sm-6 wowload fadeInUp">
          <div class="rooms">
              <?php
              $result3 = mysqli_query($conn, "SELECT * FROM service_images WHERE service_id=$row[service_id] LIMIT 1");

              if (mysqli_num_rows($result3) > 0) {
                while($row3 = mysqli_fetch_assoc($result3)) {
                    echo "<div class='portrait'><img src='images/$row3[image]'></div>";
                }
              }else{
                  echo "<div class='portrait'><img src='images/no-image-found.gif'></div>";
              }
              ?>
              <div class="info">
                  <h3><?= $row['title'] ?></h3>
                  <h5>Basic Price: RM <?= $row['basic_price'] ?></h5>
                  <div class="rating" align="left" style="height: 40px">
                      <h5>Rating :
                          <?php
                          if($avg > 0 ){
                              echo "<mark>";
                              $stars =0;
                              do{
                                 echo "<span>☆</span>";
                                 $stars++;
                              }while($stars< $avg);
                              echo "</mark>";
                          }else{
                              echo "Rating not available";
                           }
                          ?>
                      </h5>
                  </div>
                  <a href="service-details.php?id=<?=$row['service_id'] ?>" class="btn btn-default">Check Details</a>
              </div>
          </div>
      </div>
    <?php } ?>

</div>

</div>
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

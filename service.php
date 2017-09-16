<?php include 'header.php';?>

<div class="container">

<h2>Services & Others</h2>

<div class="row">

    <?php
        $sql = "SELECT * FROM services ORDER BY id DESC";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)) {
    ?>
      <div class="col-sm-6 wowload fadeInUp">
          <div class="rooms">
              <img src="images/photos/10.jpg" class="img-responsive">
              <div class="info">
                  <h3><?= $row['title'] ?></h3>
                  <h5>Basic Price: RM <?= $row['basic_price'] ?></h5>
                  <p><?= $row['description'] ?></p>
                  <a href="service-details.php?id=<?=$row['id'] ?>" class="btn btn-default">Check Details</a>
              </div>
          </div>
      </div>
    <?php } ?>

</div>

</div>
<?php include 'footer.php';?>
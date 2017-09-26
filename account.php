<?php include 'header.php';?>
<?php
$status_label = [
    1 => '<span class="label label-warning">Pending</span>',
    2 => '<span class="label label-info">Approved</span>',
    3 => '<span class="label label-success">Completed</span>',
    4 => '<span class="label label-danger">Rejected</span>',
    5 => '<span class="label label-default">Canceled</span>'
];
?>
<div class="container">

<h1 class="title">My Account</h1>

<div  class="contact">

       <div class="row" >
           <div class="container">
               <div class="row">
                   <div class="col-md-3">
                       <ul class="nav nav-pills nav-stacked admin-menu">
                           <li><a href="#" data-target-id="Profile"><i class="fa fa-list-alt fa-fw"></i>Profile</a></li>
                           <li><a href="#" data-target-id="password"><i class="fa fa-key fa-fw"></i>Change Password</a></li>
                           <li><a href="#" data-target-id="order"><i class="fa fa-file-o fa-fw"></i>My Order</a></li>
                           <li><a href="#" data-target-id="rating"><i class="fa fa-bar-chart-o fa-fw"></i>Rating</a></li>
                           <li><a href="#" data-target-id="advance"><i class="fa fa-pied-piper-alt"></i> Advance</a></li>
                       </ul>
                   </div>

                   <?php
                   $sql = "SELECT * FROM users WHERE id = $_SESSION[user_id]";
                   $result = mysqli_query($conn, $sql);
                   while($row = mysqli_fetch_assoc($result)) {
                   ?>
                   <div class="col-md-9 well admin-content" id="Profile">
                       <div class="col-lg-12">
                           <form action="controller/user.php" method="post" role="form">
                               <input type="hidden" name="action" value="update">
                               <div class="row">

                                   <div class="box-body col-lg-6">
                                   <legend>Info</legend>

                                       <div class="row">
                                           <div class="col-lg-6">
                                               <div class="form-group">
                                                   <input type="text" name="first_name" value="<?=$row['first_name']?>" placeholder="First Name" class="form-control" required>
                                               </div>
                                           </div>
                                           <div class="col-lg-6">
                                               <div class="form-group">
                                                   <input type="text" name="last_name" value="<?=$row['last_name']?>" placeholder="last Name" class="form-control" required>
                                               </div>
                                           </div>
                                       </div>

                                       <div class="form-group">
                                           <input type="text" name="ic" value="<?=$row['ic']?>" placeholder="IC Number/ Passport No" class="form-control" required>
                                       </div>

                                       <div class="form-group">
                                           <input type="email" name="email" value="<?=$row['email']?>" placeholder="Enter email" class="form-control" required>
                                       </div>

                                       <div class="form-group">
                                           <input type="phone" name="phone" value="<?=$row['phone']?>" placeholder="Phone" class="form-control" required>
                                       </div>
                                   </div>

                                   <div class="box-body col-lg-6">
                                       <legend>Address</legend>

                                       <div class="form-group">
                                           <input type="text" name="address1"  value="<?=$row['address1']?>" placeholder="Address 1" class="form-control" >
                                       </div>

                                       <div class="form-group">
                                           <input type="text" name="address2" value="<?=$row['address2']?>" placeholder="Address 2" class="form-control" >
                                       </div>

                                       <div class="form-group">
                                           <div class="row">
                                               <div class="col-lg-6">
                                                   <select name="city" class="form-control select2" style="width: 100%;" >
                                                       <option value="MUKAH">MUKAH</option>
                                                   </select>
                                               </div>
                                               <div class="col-lg-6">
                                                   <input type="text" name="postcode" value="<?=$row['postcode']?>" placeholder="Postcode" class="form-control" >
                                               </div>
                                           </div>
                                       </div>

                                       <div class="form-group">
                                           <div class="row">
                                               <div class="col-lg-6">
                                                   <select name="states" class="form-control select2" style="width: 100%;" >
                                                       <option value="SARAWAK">SARAWAK</option>
                                                   </select>
                                               </div>
                                               <div class="col-lg-6">
                                                   <select name="country" class="form-control select2" style="width: 100%;" required>
                                                       <option value="MALAYSIA">MALAYSIA</option>
                                                   </select>
                                               </div>
                                           </div>
                                       </div>
                                   </div>

                               </div>
                               <button type="submit" class="btn btn-success">Update</button>
                           </form>

                       </div>
                   </div>
                   <?php } ?>

                   <div class="col-md-9 well admin-content" id="password">
                       <form action="controller/user.php" method="post">
                           <input type="hidden" name="action" value="update-password">
                           <div class="row">
                               <legend>Update Password</legend>

                               <div class="box-body col-lg-4">
                                   <div class="form-group">
                                       <input type="password" name="password" placeholder="Old Password" class="form-control" required>
                                   </div>
                               </div>

                               <div class="box-body col-lg-4">
                                   <div class="form-group">
                                       <input type="password_new" name="password1" placeholder="New Password" class="form-control" required>
                                   </div>
                               </div>

                               <div class="box-body col-lg-4">
                                   <input type="password_new1" name="password2" placeholder="Confirm Password" class="form-control" required>
                               </div>

                           </div>
                           <button type="submit" class="btn btn-success">Update Password</button>
                       </form>
                   </div>

                   <div class="col-md-9 well admin-content" id="order">
                       <table id="example1" class="table table-bordered table-striped">
                           <thead>
                           <tr>
                               <th>Service</th>
                               <th>Date Requested</th>
                               <th>Admin Notes</th>
                               <th>Status</th>
                               <th>Action</th>
                           </tr>
                           </thead>
                           <tbody>
                           <?php
                           $sql = "SELECT *,a.status as order_status,a.id as order_id FROM orders as a LEFT JOIN users as b ON b.id=a.user_id LEFT JOIN services as c ON c.id=a.service_id LEFT JOIN services_add_on as d ON d.id=a.services_add_on_id WHERE b.id = $_SESSION[user_id]";

                           $result = mysqli_query($conn, $sql);
                           while($row = mysqli_fetch_assoc($result)) {
                               echo "<tr>";
                               echo "<td>".$row['title']."</td>";
                               echo "<td>".$row['time'].' '.$row['date']."</td>";
                               echo "<td>".$row['admin_note']."</td>";
                               echo "<td>".$status_label[$row['order_status']]."</td>";
                               echo "<td>";

                               echo "<a href='print.php?id=$row[order_id]' class='btn btn-sm btn-info' target='_blank'>View</a>";
                               if($row['order_status'] == 1){
                                   echo "<a href='controller/order.php?action=cancel&id=$row[order_id]' class='btn btn-sm btn-warning''>Cancel</a>";
                               }
                               echo "</td>";
                               echo "</tr>";
                           }

                           ?>
                           </tbody>
                           <tfoot>
                           <tr>
                               <th>Service</th>
                               <th>Date Requested</th>
                               <th>Admin Notes</th>
                               <th>Status</th>
                               <th>Action</th>
                           </tr>
                           </tfoot>
                       </table>
                   </div>

                   <div class="col-md-9 well admin-content" id="rating">
                       <div class="alert alert-info">
                           <p>Please help use to improve our service quality by give us rating and drop  some comment.</p>
                       </div>
                       <table id="example1" class="table table-bordered table-striped">
                           <thead>
                           <tr>
                               <th>Services</th>
                               <th>Date Completed</th>
                               <th>Rating</th>
                               <th>Comment</th>
                               <th>Action</th>
                           </tr>
                           </thead>
                           <tbody>
                           <?php
                           $sql = "SELECT *,a.id as order_id FROM orders as a LEFT JOIN users as b ON b.id=a.user_id LEFT JOIN services as c ON c.id=a.service_id LEFT JOIN services_add_on as d ON d.id=a.services_add_on_id WHERE b.id = $_SESSION[user_id] AND a.status =3 ";

                           $result = mysqli_query($conn, $sql);
                           while($row = mysqli_fetch_assoc($result)) {
                               echo "<tr>";
                               echo "<td>".$row['title']."</td>";
                               echo "<td>".$row['completed_datetime']."</td>";

                               if($row['rating'] == 0){
                                   echo "<form action='controller/order.php' method='post'>";
                                   echo "<input type='hidden' name='action' value='rate'>";
                                   echo "<input type='hidden' name='id' value='$row[order_id]'>";
                                   echo "<td>"; ?>
                                            <select name="rate" class="form-control">
                                                <option value="1"><span>☆</span></option>
                                                <option value="2"><span>☆</span><span>☆</span></option>
                                                <option value="3"><span>☆</span><span>☆</span><span>☆</span></option>
                                                <option value="4"><span>☆</span><span>☆</span><span>☆</span><span>☆</span></option>
                                                <option value="5"><span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span></option>
                                            </select>
                                        </td>
                           <?php   echo "<td><input type='text' name='rating_note'></td>";
                               }else{
                                   echo "<td>";

                                       if($row['rating'] > 0 ){
                                           echo "<mark>";
                                           $stars =1;
                                           do{
                                               echo "<span>☆</span>";
                                               $stars++;
                                           }while($stars< $row['rating']);
                                           echo "</mark>";
                                       }else{
                                           echo "Rating not available";
                                       }
                                   echo"</td>";
                                   echo "<td>$row[rating_note]</td>";
                               }

                               echo "<td>";
                               echo "<a href='order-view.php?id=$row[id]' class='btn btn-sm btn-info''>View</a>";
                               if($row['rating'] == 0 ){
                                   echo "<input type='submit' value='Rate Now!' class='btn btn-sm btn-success'>";
                                   echo "</form>";
                               }
                               echo "</td>";
                               echo "</tr>";
                           }

                           ?>
                           </tbody>
                           <tfoot>
                           <tr>
                               <th>Services</th>
                               <th>Date Completed</th>
                               <th>Rating</th>
                               <th>Comment</th>
                               <th>Action</th>
                           </tr>
                           </tfoot>
                       </table>
                   </div>

                   <div class="col-md-9 well admin-content" id="advance">
                       <form action="controller/user.php" method="post" onsubmit="return confirm('Do you really want to delete this account?');">
                           <input type="hidden" name="action" value="delete">
                           <div class="box-body col-lg-6">
                               <legend>Delete Account</legend>
                               <div class="form-group">
                                   <input type="password" name="password" placeholder="Enter passowrd" class="form-control" required>
                               </div>

                               <div class="form-group">
                                   <textarea name="delete_note" class="form-control" rows="5">I don't want to use this service anymore</textarea>
                               </div>
                               <button type="submit" class="btn btn-danger">Delete</button>
                           </div>
                       </form>
                   </div>
               </div>
           </div>
       </div>
    <div class="spacer"></div>
</div>
</div>
<!-- form -->

</div>
<?php include 'footer.php';?>
<script>
    $(document).ready(function()
    {
        var navItems = $('.admin-menu li > a');
        var navListItems = $('.admin-menu li');
        var allWells = $('.admin-content');
        var allWellsExceptFirst = $('.admin-content:not(:first)');

        allWellsExceptFirst.hide();
        navItems.click(function(e)
        {
            e.preventDefault();
            navListItems.removeClass('active');
            $(this).closest('li').addClass('active');

            allWells.hide();
            var target = $(this).attr('data-target-id');
            $('#' + target).show();
        });
    });
</script>
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

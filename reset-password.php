<?php include_once ('header.php') ?>
<div class="container">

    <h1 class="title">Reset Password</h1>

    <!-- form -->
    <div class="contact">

        <div class="row">

            <div class="col-sm-12">

                <div class="col-sm-6 col-sm-offset-3">
                    <div class="spacer">

                        <h4>Enter Password your Email:</h4>
                        <form role="form" action="reset-password.php" method="post">
                            <div class="form-group">
                                <input type="email"  name="email" class="form-control" id="email" placeholder="Email" required>
                            </div>
                            <button type="submit" name="reset" class="btn btn-default">Send</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- form -->
<?php
require_once('connection.php');
	if(isset($_POST["reset"]))
	{
		$email=$_POST["email"];
		$get_users=mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");
		$tll_users = $get_users->num_rows;

		if($tll_users>0) {
            $user = mysqli_fetch_array($get_users);
			
			function rand_string( $length ) 
			{	
				$chars = "1234567890qwertyuipasdfghjklzxcvbnm1234567890";
				return substr(str_shuffle($chars),0,$length);
			}
			$pwd=rand_string(8);
            require_once("reset-password-email.php");
			if(mysqli_query($conn,"UPDATE users SET password='$pwd' WHERE email='$email'")) {
				echo "<script>alert ('New password has been sent to your email($email).')</script>";
				echo "<script>window.close()</script>";

			}else {
				echo "<script>alert ('Error!');window.location='reset-password.php'</script>";
			}
		} else {
			echo "<script>alert ('email not exist!');window.location='reset-password.php'</script>";
		}
	}
?>

<?php include_once('footer.php')?>






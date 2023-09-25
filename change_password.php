<?php

session_start();

include("includes/db.php");

include("functions/functions.php");

if (isset($_SESSION['customer_email'])) {
  echo "<script>window.open('checkout.php','_self');</script>";
}

if (!isset($_GET['change_password'])) {
  echo "<script>window.open('checkout.php','_self');</script>";
}else{
  $hash_password = mysqli_real_escape_string($con, $_GET['change_password']);
  $select_customer = "select * from customers where customer_pass='$hash_password'";
  $run_customer = mysqli_query($con,$select_customer);
  $row_customer = mysqli_fetch_array($run_customer);
  $customer_name = $row_customer["customer_name"];
  $count_customer = mysqli_num_rows($run_customer);
  if ($count_customer == 0 ) {
    echo "<script>window.open('checkout.php','_self');</script>";
  }
}
?>

<!DOCTYPE html>
<html>

<head>
<?php
	include("includes/head.php")
	?>
</head>



<body>


	<div id="top"> <!-- starts top-->


		<div class="container"><!-- starts container-->

			<div class="col-md-6 offer"><!-- starts col-md-6 oferr-->

				<a href="#" class="btn-sm">
					<?php

					if (!isset($_SESSION['customer_email'])) {

						echo "<em>Mirëserdhe!</em> <span>|</span>";
					}
					else {
						echo "<em>Mirëserdhe</em>  "  .  $_SESSION['customer_email'] . " <span>|</span> ";
					}
					?>
				</a>
				<a href="#">
					Shporta Totali: <?php total_price()?> Lekë
				</a>


			</div><!-- ends col-md-6 oferr-->

			<div class="col-md-6"><!-- starts col-md-6 -->

				<ul class="menu"> <!-- starts menu -->
					<li>
						<a href="customer_register.php">
							Regjistrohu
						</a>
					</li>
					<li>
						<?php

                         if (!isset($_SESSION['customer_email'])) {
                         	echo "<a href='checkout.php'> Llogaria Ime</a>";
                         }
                         else{
                         	echo "<a href='customer/my_account.php?my_orders'> Llogaria Ime </a>";
                         }
						?>
					</li>
					<li>
						<a href="cart.php">
							Shko tek Shporta
						</a>
					</li>
					<li>
						<?php

                         if (!isset($_SESSION['customer_email'])) {

                         	 echo "<a href='checkout.php'> Login </a>";
                         }
                         else{

                         	echo "<a href='logout.php'> Logout </a>";
                         }
						?>
					</li>

				</ul><!-- ends menu -->

			</div><!-- ends col-md-6 -->

	    </div><!-- ends container-->

	</div><!-- ends top-->


<div class="navbar navbar-default" id="navbar"><!-- navbar navbar-default starts-->

	<div class="container"><!-- container starts-->
		<?php
		include("includes/navbar-menu.php")
		 ?>
	</div><!-- container ends-->

</div><!-- navbar navbar-default ends-->


<div id="content" class="container"><!-- content starts-->

	   <div class="container"><!-- container starts-->

			<div class="col-md-12"><!-- col-md-12 starts-->

				<ul class="breadcrumb"><!-- breadcrumb starts-->

					<li>
						<a href="index.php">Kryefaqja</a>
					</li>

					<li>
						Reseto/Ndrysho Paswordin
					</li>

				</ul><!-- breadcrumb ends-->

			</div><!-- col-md-12 ends-->

		  <div class="col-md-4 col-md-offset-4 col-sm-12"><!--col-md-4 col-md-offset-4 starts-->
				<div class="box"><!-- box start-->
					<div class="box-header"><!-- box-header start-->
						<center>
							<p class="lead">I Dashur <?php echo $customer_name; ?>, Reseto/Ndrysho Paswordin</p>
						</center>
					</div><!-- box-header ends-->
					<div align="center"><!-- center div start-->
						<form class="" action="" method="post"><!-- form start-->
						<div class="form-group"><!-- form-group start-->
              <input type="password" class="form-control" name="customer_pass"
              placeholder="Paswordi i Ri" minlength="8" required>
              <label> (8 karaktere minimumi)</label>
            </div><!-- form-group end-->

            <div class="form-group"><!-- form-group start-->
              <input type="password" class="form-control" name="confirm_customer_pass"
              placeholder="Konfirmo Paswordin e Ri" minlength="8" required>
            </div><!-- form-group end-->

            <div class="form-group"><!-- form-group start-->
              <input type="submit" class="btn btn-primary" name="reset_password"
              value="Reseto Paswordin">
            </div><!-- form-group end-->
						</form><!-- form ends-->
					</div><!-- center div ends-->
				</div><!-- box ends-->
		  </div><!--col-md-4 col-md-offset-4 ends-->

  </div><!-- container ends-->

    </div><!-- content ends-->

</div><!--container ends-->

<?php
 include("includes/footer.php")
?>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>

</html>

<?php
if (isset($_POST['reset_password'])) {
	$hash_password = mysqli_real_escape_string($con, $_GET['change_password']);
  $customer_pass = mysqli_real_escape_string($con, $_POST['customer_pass']);
  $confirm_customer_pass = mysqli_real_escape_string($con, $_POST['confirm_customer_pass']);

  if ($customer_pass != $confirm_customer_pass) {
    echo "<script>alert('Paswordi nuk përputhet, të lutem provo përsëri!');</script>";
  }else {
    $encrypted_password = password_hash($confirm_customer_pass, PASSWORD_DEFAULT);
    $update_customer_password = "update customers set customer_pass='$encrypted_password'
    where customer_pass = '$hash_password'";
    $run_update_customer_password = mysqli_query($con, $update_customer_password);
    if ($run_update_customer_password) {
      echo "<script>alert('Paswordi juaj u ndryshua me sukses!');
        window.open('checkout.php','_self');
      </script>";
    }
  }
}
 ?>

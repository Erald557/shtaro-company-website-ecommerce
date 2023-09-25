<?php

session_start();

include("includes/db.php");

include("functions/functions.php");

if (isset($_SESSION['customer_email'])) {
  echo "<script>window.open('checkout.php','_self');</script>";
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
						Merr Paswordin
					</li>

				</ul><!-- breadcrumb ends-->

			</div><!-- col-md-12 ends-->

		  <div class="col-md-4 col-md-offset-4 col-sm-12"><!--col-md-4 col-md-offset-4 starts-->
				<div class="box"><!-- box start-->
					<div class="box-header"><!-- box-header start-->
						<center>
							<p class="lead">Ju lutem vendosni adresën tuaj të emailit.</p>
						</center>
					</div><!-- box-header ends-->
					<div align="center"><!-- center div start-->
						<form class="" action="" method="post"><!-- form start-->
						 <input type="text" class="form-control" name="c_email" placeholder="Vendosni Emailin Tuaj">
						 <br>
						 <button type="submit" name="forgot_pass" class="btn btn-primary">
							 <i class="fa fa-paper-plane"> Dërgo</i>
						 </button>
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
if (isset($_POST['forgot_pass'])) {
	$c_email = $_POST['c_email'];
	$sel_c = "select * from customers where customer_email='$c_email' ";
	$run_c = mysqli_query($con,$sel_c);
	$count_c = mysqli_num_rows($run_c);
	$row_c = mysqli_fetch_array($run_c);
	$c_name = $row_c['customer_name'];
	$c_pass = $row_c['customer_pass'];
	if ($count_c == 0) {
		echo "<script>alert('Na vjen keq por ky email nuk ekziston!') </script>";
		exit();
	} else{
		$message = "
      <center>
      <img src='http://shtaro.com/images/Logo_shtaro.png'/>
      </center>
			<h2 align='center'> Përshëndetje $c_name, </h2>
			<h3 align='center'>
				Për të resetuar/ndryshuar paswordin tuaj <span><strong><em>
        <a href='http://shtaro.com/change_password.php?change_password=$c_pass'>klikoni këtu</a></em></strong></span>.
			</h3>
			<h3 align='center'>
				Klikoni<a href='http://shtaro.com/checkout.php'> këtu </a> për të hyrë në llogarinë tuaj!
			</h3>
		";
		$from = "info@shtaro.com";
		$subject = "Reseto/Ndrysho Paswordin";
		$headers = "From: $from\r\n";
		$headers .= "Content-type: text/html\r\n";
		mail($c_email,$subject,$message,$headers);
		echo "<script>alert('Ju është dërguar një email për të krijuar një password të ri!') </script>";
		echo "<script>window.open('checkout.php','_self') </script>";
	}
}
 ?>

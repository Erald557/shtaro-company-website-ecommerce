
<?php

session_start();

include("includes/db.php");

include("functions/functions.php");
?>

<!DOCTYPE html>
<html>

<head>

<?php
	include("includes/head.php")
	?>
	<script src="https://www.google.com/recaptcha/api.js?render=6Lc-xMgUAAAAALFDMhczUXGv5H-UkhzGoLCf6Ts1"></script>

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


<div id="content"><!-- content starts-->

	   <div class="container"><!-- container starts-->

			<div class="col-md-12"><!-- col-md-12 starts-->

				<ul class="breadcrumb"><!-- breadcrumb starts-->

					<li>
						<a href="index.php">Kryefaqja</a>
					</li>

					<li>
						Rreth Nesh
					</li>

				</ul><!-- breadcrumb ends-->

			</div><!-- col-md-12 ends-->


		  	<div class="col-md-12"><!-- col-md-12 starts-->

		  		<div class="box"><!-- box starts-->
						<?php
						$get_about_us = "select * from about_us";
						$run_about_us = mysqli_query($con,$get_about_us);
						$row_about_us = mysqli_fetch_array($run_about_us);
						$about_heading = $row_about_us['about_heading'];
						$about_short_desc = $row_about_us['about_short_desc'];
						$about_desc = $row_about_us['about_desc'];
						  ?>
						<h1><?php echo $about_heading; ?></h1>
						<p class="lead"> <?php echo $about_short_desc; ?></p>
						<p><?php echo $about_desc; ?></p>
		  		</div><!-- box ends-->

		  	</div><!-- col-md-12 ends-->

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


<?php

session_start();

if (!isset($_SESSION['customer_email'])) {

	echo "<script>window.open('../checkout.php','_self') </script>";
}
else{


include("includes/db.php");

include("functions/functions.php");
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
						<a href="../customer_register.php">
							Regjistrohu
						</a>
					</li>
					<li>
						<?php

                         if (!isset($_SESSION['customer_email'])) {
                         	echo "<a href='../checkout.php'> Llogaria Ime</a>";
                         }
                         else{
                         	echo "<a href='my_account.php?my_orders'> Llogaria Ime </a>";
                         }
						?>
					</li>
					<li>
						<a href="../cart.php">
							Shko tek Shporta
						</a>
					</li>
					<li>
						<?php

                         if (!isset($_SESSION['customer_email'])) {

                         	 echo "<a href='../checkout.php'> Login </a>";
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

	<div class="container-fluid"><!-- container-fluid starts-->

		<div class="col-md-12"><!-- col-md-12 starts-->

			<ul class="breadcrumb"><!-- breadcrumb starts-->

				<li>
					<a href="../index.php">Kryefaqja</a>
				</li>

				<li>
					Llogaria ime
				</li>

			</ul><!-- breadcrumb ends-->

			</div><!-- col-md-12 ends-->

			<div class="col-md-12"><!-- col-md-12 start-->
				<?php
					$c_email = $_SESSION['customer_email'];
					$get_customer = "select * from customers where customer_email='$c_email' ";
					$run_customer = mysqli_query($con,$get_customer);
					$row_customer = mysqli_fetch_array($run_customer);
					$customer_confirm_code = $row_customer['customer_confirm_code'];
					$c_name = $row_customer['customer_name'];
					if (!empty($customer_confirm_code)) {
				 ?>
				 <div class="alert alert-danger"><!-- alert alert-danger start-->
				 	<strong>Kujdes!</strong> Ju lutem konfirmoni emailin tuaj!
					Nëse nuk ju ka ardhur emaili i konfirmimit atëhere kliko ->
					 <a href="my_account.php?send_email" class="alert-link">
						Dërgo sërish emailin.
					</a>
				 </div><!-- alert alert-danger end-->
				 <?php } ?>
			</div><!-- col-md-12 ends-->

			  <div class="col-md-3"><!-- col-md-3 starts-->

			  	<?php include("includes/sidebar.php");?>

			  </div><!-- col-md-3 ends-->

                <div class="col-md-9"><!-- col-md-9 starts-->

                	<div class="box"><!-- box starts-->

                		<?php
										if(isset($_GET[$customer_confirm_code])) {
                			$update_customer = "update customers set customer_confirm_code='' where
											 customer_confirm_code='$customer_confirm_code' ";
											$run_confirm = mysqli_query($con,$update_customer);
											echo "<script>alert('Emaili u konfirmua!') </script>";
											echo "<script>window.open('my_account.php?my_orders','_self') </script>";
                		}

										if(isset($_GET['send_email'])) {
											$subject = "Mesazhi i konfirmimit të emailit";

											$from = "info@shtaro.com";

											$message = "
											<h2>Përshëndetje <em>$c_name</em> !</h2><br />
											<h3>
												Emaili i konfirmimit nga shtaro.com
											</h3>
											<a href='http://shtaro.com/customer/my_account.php?$customer_confirm_code'>
												Kliko këtu për të konfirmuar emailin!
											</a>
											";

											$headers = "From: $from \r\n";

											$headers .= "Content-type: text/html\r\n";

											mail($c_email, $subject, $message, $headers);

											echo "<script>alert('Emaili juaj i konfirmimit u dërgua, kontrolloni Inbox e emailit.') </script>";
											echo "<script>window.open('my_account.php?my_orders', '_self') </script>";
										}

                		if(isset($_GET['my_orders'])) {
                			include("my_orders.php");
                		}

                    if(isset($_GET['my_addresses'])) {
                			include("my_addresses.php");
                		}

                		if (isset($_GET['pay_offline'])) {
                			include("pay_offline.php");
                		}

                		if (isset($_GET['edit_account'])) {
                			include("edit_account.php");
                		}

                		if (isset($_GET['change_pass'])) {
                			include("change_pass.php");
                		}

                		if (isset($_GET['delete_account'])) {
                			include("delete_account.php");
                		}

										if (isset($_GET['my_wishlist'])) {
                			include("my_wishlist.php");
                		}

										if (isset($_GET['delete_wishlist'])) {
                			include("delete_wishlist.php");
                		}
                		?>

                	</div><!-- box ends-->

                </div><!-- col-md-9 ends-->

		</div><!-- container-fluid ends-->

	</div><!-- content ends-->



<?php
 include("includes/footer.php")
?>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>


</html>

<?php }?>

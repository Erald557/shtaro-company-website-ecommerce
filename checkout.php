<?php

session_start();

include("includes/db.php");

include("functions/functions.php");

define("customer_login", TRUE);

define("review_order", TRUE);
?>

<!DOCTYPE html>
<html>

<head>
<?php
	include("includes/head.php")
	?>
<script src="js/jquery.min.js"></script>
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

        <?php if (!isset($_SESSION["customer_email"])) {

         ?>

				<ul class="breadcrumb"><!-- breadcrumb starts-->

					<li>
						<a href="index.php">Kryefaqja</a>
					</li>

					<li>
						Detajet e Login
					</li>

				</ul><!-- breadcrumb ends-->

      <?php }else{ ?>
        <ul class="breadcrumb"><!-- breadcrumb starts-->

					<li>
						<a href="index.php">Kryefaqja</a>
					</li>

					<li>
						Detajet e Blerjes
					</li>

				</ul><!-- breadcrumb ends-->

        <nav class="checkout-breadcrumbs text-center">
  				<a href="cart.php"> Shporta e Blerjeve</a>
  				<i class="fa fa-chevron-right"></i>
  				<a href="checkout.php" class="active"> Detajet e Blerjes</a>
  				<i class="fa fa-chevron-right"></i>
  				<a href="#"> Porosia u Krye</a>
  			</nav>
      <?php } ?>
			</div><!-- col-md-12 ends-->



		  <?php if (!isset($_SESSION['customer_email'])) {?>
        <div class="col-md-4 col-md-offset-4 col-sm-12"><!--col-md-4 col-md-offset-4 col-sm-12 starts-->
              <?php	include("customer/customer_login.php");?>
        </div><!--col-md-4 col-md-offset-4 col-sm-12 ends-->
      <?php  } else{?>

        <div class="col-md-12 col-sm-12"><!--col-md-12 col-sm-12 starts-->
                <?php	include("review_order.php");?>
        </div><!--col-md-12 col-sm-12 ends-->
     <?php  } ?>

  </div><!-- container ends-->

    </div><!-- content ends-->

</div><!--container ends-->

<?php
 include("includes/footer.php")
?>

<script src="js/bootstrap.min.js"></script>
</body>


</html>

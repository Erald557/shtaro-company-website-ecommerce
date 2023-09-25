
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
						Shërbime
					</li>

				</ul><!-- breadcrumb ends-->

			</div><!-- col-md-12 ends-->


		  	<div class="col-md-12"><!-- col-md-12 starts-->
          <div class="services row"><!-- services row starts-->
            <?php
            $get_services = "select * from services";
            $run_services = mysqli_query($con,$get_services);
            while ($row_services = mysqli_fetch_array($run_services)) {
              $service_id = $row_services['service_id'];
              $service_title = $row_services['service_title'];
              $service_image = $row_services['service_image'];
              $service_desc = $row_services['service_desc'];
              $service_button = $row_services['service_button'];
              $service_url = $row_services['service_url'];

             ?>

			<div class="col-lg-4 col-md-4 box-1"  style=""><!-- col-md-4 col-sm-6 box starts-->
				<div class="box text-center">
					<img id="box_<?php echo $service_id;?>" src="admin_area/services_images/<?php echo $service_image; ?>" alt="" class="img-responsive">
					<h2> <?php echo $service_title; ?></h2>
					<p>
						<?php echo $service_desc; ?>
						<a href="<?php echo $service_url; ?>" class="btn btn-primary text-center">
							<?php echo $service_button; ?>
						</a>
					</p>
				</div>

			</div><!-- col-md-4 col-sm-6 box starts-->
             <?php } ?>
          </div><!-- services row end-->

		  	</div><!-- col-md-12 ends-->

        </div><!-- container ends-->

    </div><!-- content ends-->

</div><!--container ends-->

<?php
 include("includes/footer.php")
?>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
    var maxHeight = 0;

    $("#box_<?php echo $service_id;?>").each(function(){
        if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }
    });

    $(".img-responsive").height(maxHeight);
</script>

</body>


</html>

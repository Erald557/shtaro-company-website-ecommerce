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

	<div id="content"><!-- content start-->
		<div class="container"><!-- container start-->
			<div class="col-md-12"><!-- col-md-12 start-->
				<ul class="breadcrumb"><!-- breadcrumb start-->
					<li><a href="index.php"> Kryefaqja</a></li>
					<li>Termat dhe Kushtet | Politikat e Rimbursimit</li>
				</ul><!-- breadcrumb end-->
			</div><!-- col-md-12 end-->

			<div class="col-md-3"><!-- col-md-3 start-->
				<div class="box"><!-- box start-->
					<ul class="nav nav-pills nav-stacked"><!-- nav nav-pills nav-stacked start-->
						<?php

							$get_terms = "select * from terms LIMIT 0,1 ";

							$run_terms = mysqli_query($con,$get_terms);

							while ($row_terms = mysqli_fetch_array($run_terms)) {

								$term_title = $row_terms['term_title'];

								$term_link = $row_terms['term_link'];


						 ?>

						 <li class="active">
						 	<a data-toggle="pill" href="#<?php echo $term_link;?>">
						 		<?php echo "$term_title"; ?>
						 	</a>
						 </li>

						 <?php } ?>

						 <?php

						 	$count_terms = "select * from terms ";

						 	$run_count = mysqli_query($con,$count_terms);

						 	$count = mysqli_num_rows($run_count);

						 	$get_terms = "select * from terms LIMIT 1,$count ";

						 	$run_terms = mysqli_query($con,$get_terms);

						 	while ($row_terms = mysqli_fetch_array($run_terms)) {

						 		$term_title = $row_terms['term_title'];

						 		$term_link = $row_terms['term_link'];

						  ?>
						  <li>
						  	<a data-toggle="pill" href="#<?php echo $term_link;?>">

						  		<?php echo "$term_title"; ?>
						  	</a>
						  </li>

						  <?php } ?>
					</ul><!-- nav nav-pills nav-stacked end-->
				</div><!-- box end-->
			</div><!-- col-md-3 end-->

			<div class="col-md-9"><!-- col-md-9 start-->
				<div class="box"><!-- box start-->
					<div class="tab-content"><!-- tab-content start-->
						<?php

							$get_terms = "select * from terms LIMIT 0,1 ";

							$run_terms = mysqli_query($con,$get_terms);

							while ($row_terms = mysqli_fetch_array($run_terms)) {

								$term_title = $row_terms['term_title'];

								$term_desc = $row_terms['term_desc'];

								$term_link = $row_terms['term_link'];

						 ?>
						 <div id="<?php echo $term_link;?>" class="tab-pane fade in active"><!-- tab-pane fade in active start-->

						 	<h1> <?php echo "$term_title"; ?> </h1>

						 	<p> <?php echo $term_desc; ?> </p>
						 </div><!-- tab-pane fade in active end-->

						 <?php } ?>

						 <?php

						 	$count_terms = "select * from terms ";

						 	$run_count = mysqli_query($con,$count_terms);

						 	$count = mysqli_num_rows($run_count);

						 	$get_terms = "select * from terms LIMIT 1,$count ";

						 	$run_terms = mysqli_query($con,$get_terms);

						 	while ($row_terms = mysqli_fetch_array($run_terms)) {

						 		$term_title = $row_terms['term_title'];

								$term_desc = $row_terms['term_desc'];

								$term_link = $row_terms['term_link'];

						  ?>

						  <div id="<?php echo $term_link;?>" class="tab-pane fade in"><!-- tab-pane fade in start-->

						 	<h1> <?php echo "$term_title"; ?> </h1>

						 	<p> <?php echo $term_desc; ?> </p>
						 </div><!-- tab-pane fade in end-->

						 <?php } ?>
					</div><!-- tab-content end-->
				</div><!-- box end-->
			</div><!-- col-md-9 end-->
		</div><!-- container end-->
	</div><!-- content ends-->

	<?php
	include("includes/footer.php")
	?>
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>


<?php

session_start();

if (!isset($_SESSION['customer_email'])) {

	echo "<script>window.open('../checkout.php','_self') </script>";
}
else{

include("includes/db.php");

include("functions/functions.php");

if(isset($_GET['order_id'])){

	$order_id = $_GET['order_id'];
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

						echo "<em>Mireserdhe!</em> <span>|</span>";
					}
					else {
						echo "<em>Mireserdhe</em>  "  .  $_SESSION['customer_email'] . " <span>|</span> ";
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

		<div class="navbar-header"><!-- navbar-header starts-->
			<a class="navbar-brand home" href="index.php"><!-- navbar-brand home starts-->

			<img src="images/Logo_shtaro.png" alt="eletkroshtepiake logo">

			</a><!-- navbar-brand home ends-->

			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation">
				<span class="sr-only">Toggle Navigation</span>
				<i class="fa fa-align-justify"></i>
			</button>

			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#search">
				<span class="sr-only">Toggle Search</span>
				<i class="fa fa-search"></i>
			</button>

		</div><!-- navbar-header ends-->

		<div class="navbar-collapse collapse" id="navigation"><!-- navbar-collapse collapse starts-->

			<div class="padding-nav"><!-- padding-nav starts-->

				<ul class="nav navbar-nav navbar-left"><!-- nav navbar-nav navbar-left starts-->
				  <li>
				  	<a href="../index.php">Kryefaqja</a>

				  </li>

				  <li>
				  	<a href="../shop.php">Dyqani</a>
				  </li>

				   <li class="active">
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
				  	<a href="../cart.php">Shporta Blerjeve</a>
				  </li>

				   <li>
				  	<a href="../contact.php">Na Kontaktoni</a>
				  </li>

				</ul><!-- nav navbar-nav navbar-left ends-->

			</div><!-- padding-nav ends-->

			<a class="btn btn-primary navbar-btn right" href="cart.php"><!-- btn btn-primary navbar-btn right starts-->
				<i class="fa fa-shopping-cart"></i>

				<span><?php items();?> Produkte në Shportë</span>

			</a><!-- btn btn-primary navbar-btn right ends-->

          <div class="navbar-collapse collapse right"><!-- navbar-collapse collapse right starts-->

          	<button class="btn navbar-btn btn-primary" type="button" data-toggle="collapse" data-target="#search">
          		<span class="sr-only">Toggle Search</span>
          		<i class="fa fa-search"></i>

          	</button>

          </div><!-- navbar-collapse collapse right ends-->

           <div class="collapse clearfix" id="search"><!--collapse clearfix starts-->

           	<form class="navbar-form" method="get" action="results.php"><!--navbar-form starts-->

           		<div class="input-group"><!--input-group starts-->

           			<input class="form-control" type="text" placeholder="Search" name="user_query" required>
           			<span class="input-group-btn"><!--input-group-btn starts-->

           			<button type="submit" value="Search" name="search" class="btn btn-primary">
           				<i class="fa fa-search"></i>
           			</button>
           			</span><!--input-group-btn ends-->
           		</div><!--input-group ends-->


           	</form><!--navbar-form ends-->

           </div><!--collapse clearfix ends-->


		</div><!-- navbar-collapse collapse ends-->
	</div><!-- container ends-->

</div><!-- navbar navbar-default ends-->


<div id="content"><!-- content starts-->

	<div class="container"><!-- container starts-->

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


			  <div class="col-md-3"><!-- col-md-3 starts-->

			  	<?php include("includes/sidebar.php");?>

			  </div><!-- col-md-3 ends-->

			<div class="col-md-9"><!-- col-md-9 starts-->

				<div class="box"><!-- Box starts-->
					<h1 align="center">Ju lutem Konfirmoni Pagesën </h1>

					<form action="confirm.php?update_id=<?php echo $order_id; ?>" method="post" enctype="multipart/form-data"><!-- Form starts-->
						<div class="form-group"><!-- Form-group starts-->
							<label>Nr Faturës:</label>
							<input type="text" class="form-control" name="invoice_no" required>
						</div><!-- Form-group ends-->

						<div class="form-group"><!-- Form-group starts-->
							<label>Shuma e Dërguar:</label>
							<input type="text" class="form-control" name="amount_sent" required>
						</div><!-- Form-group ends-->

						<div class="form-group"><!-- Form-group starts-->
							<label>Zgjidhni Mënyrën e Pagesës:</label>
							<select name="payment_mode" class="form-control"><!--Select starts-->
							  <option>Zgjidhni Mënyrën e Pagesës</option>
							  <option>Kodi i Bankës</option>
							  <option>Paypal</option>
							  <option>Credit Card</option>
							  <option>Western Union</option>
							</select><!--Select ends-->
						</div><!-- Form-group ends-->

						<div class="form-group"><!-- Form-group starts-->
							<label>Id e Transaksionit/Referencës:</label>
							<input type="text" class="form-control" name="ref_no" required>
						</div><!-- Form-group ends-->

						<div class="form-group"><!-- Form-group starts-->
							<label>Paypal:</label>
							<input type="text" class="form-control" name="code" required>
						</div><!-- Form-group ends-->

						<div class="form-group"><!-- Form-group starts-->
							<label>Data Pagesës:</label>
							<input type="text" class="form-control" name="date" required>
						</div><!-- Form-group ends-->

						<div class="text-center"><!-- Text-center starts-->
							<button type="submit" name="confirm_payment" class="btn btn-primary btn-lg">
								<i class="fa fa-user"></i> Konfirmo Pagesën

							</button>

						</div><!-- Text-center ends-->

					</form><!-- Form ends-->

					<?php
                		if (isset($_POST['confirm_payment'])) {

                			$update_id = $_GET['update_id'];

                			$invoice_no = $_POST['invoice_no'];

                			$amount = $_POST['amount_sent'];

                			$payment_mode = $_POST['payment_mode'];

                			$ref_no = $_POST['ref_no'];

                			$code = $_POST['code'];

                			$payment_date = $_POST['date'];

                			$complete = "Complete";

                			$insert_payment = "insert into payments (invoice_no, amount, payment_mode, ref_no, code, payment_date) values ('$invoice_no', '$amount', '$payment_mode', '$ref_no', '$code', '$payment_date')";

                			$run_payment = mysqli_query($con,$insert_payment);

                			$update_customer_order = "update customer_orders set order_status='$complete' where order_id='$update_id' ";
                			$run_customer_order = mysqli_query($con,$update_customer_order);

                			$update_pending_order = "update pending_orders set order_status='$complete' where order_id='$update_id' ";

                			$run_pending_order = mysqli_query($con,$update_pending_order);

                			if ($run_pending_order) {
                				echo "<script> alert('Pagesa u krye,porosia do të kompletohet brenda 24 orëve!') </script>";

                				echo "<script>window.open('my_account.php?my_orders','_self') </script>";
                			}


                		}
					?>
				</div><!-- Box ends-->


			</div><!-- col-md-9 ends-->



			  </div><!-- container ends-->

	</div><!-- content ends-->


<?php
 include("includes/footer.php")
?>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>


</html>

<?php }?>

<?php

if (!isset($_SESSION['admin_email'])) {

	echo "<script>window.open('login.php','_self') </script>";
}

else {


?>

<div class="row"><!--row start -->

	<div class="col-lg-12"><!--col-lg-12 start -->

		<h1 class="page-header"> Dashboard</h1>

		<ol class="breadcrumb"><!--breadcrumb start -->
			<li class="active">
				<i class="fa fa-dashboard"></i> Dashboard
			</li>
		</ol><!--breadcrumb end -->

	</div><!--col-lg-12 end -->
</div><!--row end -->

<div class="row"><!-- 2 row start -->

	<div class="col-lg-3 col-md-6"><!--col-lg-3 col-md-6 start -->

		<div class="panel panel-primary"><!--panel panel-primary start -->

			<div class="panel-heading"><!--panel-heading start -->

				<div class="row"><!--row start -->

					<div class="col-xs-3"><!--col-xs-3 start -->

						<i class="fa fa-tasks fa-5x"></i>
					</div><!--col-xs-3 start -->

					<div class="col-xs-9 text-right"><!--col-xs-9 text-right start -->

						<div class="huge"> <?php echo "$count_products"; ?></div>
						<div> Products</div>

					</div><!--col-xs-9 text-right end -->
				</div><!--row end -->

			</div><!--panel-heading end -->

			<a href="index.php?view_products">

				<div class="panel-footer"><!--panel-footer start -->

					<span class="pull-left"> View Details</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

					<div class="clearfix"></div>

				</div><!--panel-footer end -->
			</a>
		</div><!--panel panel-primary end -->
	</div><!--col-lg-3 col-md-6 end -->

	<div class="col-lg-3 col-md-6"><!--col-lg-3 col-md-6 start -->

		<div class="panel panel-green"><!--panel panel-green start -->

			<div class="panel-heading"><!--panel-heading start -->

				<div class="row"><!--row start -->

					<div class="col-xs-3"><!--col-xs-3 start -->

						<i class="fa fa-comments fa-5x"></i>
					</div><!--col-xs-3 start -->

					<div class="col-xs-9 text-right"><!--col-xs-9 text-right start -->

						<div class="huge"> <?php echo "$count_customers"; ?></div>
						<div> Customers</div>

					</div><!--col-xs-9 text-right end -->
				</div><!--row end -->

			</div><!--panel-heading end -->

			<a href="index.php?view_customers">

				<div class="panel-footer"><!--panel-footer start -->

					<span class="pull-left"> View Details</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

					<div class="clearfix"></div>

				</div><!--panel-footer end -->
			</a>
		</div><!--panel panel-green end -->
	</div><!--col-lg-3 col-md-6 end -->

	<div class="col-lg-3 col-md-6"><!--col-lg-3 col-md-6 start -->

		<div class="panel panel-yellow"><!--panel panel-yellow start -->

			<div class="panel-heading"><!--panel-heading start -->

				<div class="row"><!--row start -->

					<div class="col-xs-3"><!--col-xs-3 start -->

						<i class="fa fa-shopping-cart fa-5x"></i>
					</div><!--col-xs-3 start -->

					<div class="col-xs-9 text-right"><!--col-xs-9 text-right start -->

						<div class="huge"> <?php echo "$count_p_categories"; ?></div>
						<div> Products Categories</div>

					</div><!--col-xs-9 text-right end -->
				</div><!--row end -->

			</div><!--panel-heading end -->

			<a href="index.php?view_p_cats">

				<div class="panel-footer"><!--panel-footer start -->

					<span class="pull-left"> View Details</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

					<div class="clearfix"></div>

				</div><!--panel-footer end -->
			</a>
		</div><!--panel panel-yellow end -->
	</div><!--col-lg-3 col-md-6 end -->

	<div class="col-lg-3 col-md-6"><!--col-lg-3 col-md-6 start -->

		<div class="panel panel-red"><!--panel panel-red start -->

			<div class="panel-heading"><!--panel-heading start -->

				<div class="row"><!--row start -->

					<div class="col-xs-3"><!--col-xs-3 start -->

						<i class="fa fa-support fa-5x"></i>
					</div><!--col-xs-3 start -->

					<div class="col-xs-9 text-right"><!--col-xs-9 text-right start -->

						<div class="huge"> <?php echo "$count_pending_orders"; ?></div>
						<div> Pending Orders</div>

					</div><!--col-xs-9 text-right end -->
				</div><!--row end -->

			</div><!--panel-heading end -->

			<a href="index.php?view_orders">

				<div class="panel-footer"><!--panel-footer start -->

					<span class="pull-left"> View Details</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

					<div class="clearfix"></div>

				</div><!--panel-footer end -->
			</a>
		</div><!--panel panel-red end -->
	</div><!--col-lg-3 col-md-6 end -->

</div><!-- 2row end -->

<div class="row"><!-- 3 row start -->

	<div class="col-lg-8"><!-- col-lg-8 start -->

		<div class="panel panel-primary"><!-- panel panel-primary start -->

			<div class="panel-heading"><!-- panel-heading start -->

				<h3 class="panel-title"><!-- panel-title start -->

					<i class="fa fa-money fa-fw"></i> New Orders
				</h3><!-- panel-title end -->
			</div><!-- panel-heading end -->

			<div class="panel-body"><!-- panel-body start -->

				<div class="table-responsive"><!--table-responsive start -->

					<table class="table table-bordered table-hover table-striped"><!--table table-bordered table-hover table-striped start -->

						<thead><!--thead start -->
							<tr>
								<th>Order No:</th>
								<th>Customer Email:</th>
								<th>Invoice No:</th>
								<th>Total:</th>
								<th>Date:</th>
								<th>Status:</th>
							</tr>
						</thead><!--thead end -->

						<tbody><!--tbody start -->
              <?php
              $select_orders = "select * from orders order by 1 desc limit 0,5";
              $run_orders = mysqli_query($con,$select_orders);
              $i = 0;
              while ($row_orders = mysqli_fetch_array($run_orders)) {
                $i++;
                $order_id = $row_orders["order_id"];
                $customer_id = $row_orders["customer_id"];
                $invoice_no = $row_orders["invoice_no"];
                $order_total = $row_orders["order_total"];
                $order_date = $row_orders["order_date"];
                $order_status = $row_orders["order_status"];
                $get_customer = "select * from customers where customer_id='$customer_id'";
                $run_customer = mysqli_query($con, $get_customer);
                $row_customer = mysqli_fetch_array($run_customer);
                $customer_email = $row_customer['customer_email'];
               ?>
               <tr>
                 <td> <?php echo $i; ?></td>
                 <td> <?php echo $customer_email; ?></td>
                 <td> #<?php echo $invoice_no; ?></td>
                 <td> <?php echo $order_total; ?> Lekë</td>
                 <td> <?php echo $order_date; ?></td>
                 <td> <?php
                 if ($order_status == "pending") {
                   echo ucwords($order_status . " Payment");
                 }else {
                   echo ucwords($order_status);
                 }
                  ?></td>
               </tr>
             <?php } ?>
						</tbody><!--tbody end -->
					</table><!--table table-bordered table-hover table-striped end -->
				</div><!--table-responsive end -->

				<div class="text-right"><!--text-right start -->

					<a href="index.php?view_orders">
						View All Orders <i class="fa fa-arrow-circle-right"></i>
					</a>
				</div><!--text-right end -->
			</div><!-- panel-body end -->
		</div><!-- panel panel-primary end -->

	</div><!-- col-lg-8 end -->

	<div class="col-md-4"><!--col-md-4 start -->

		<div class="panel"><!--panel start -->

			<div class="panel-body"><!--panel-body start -->

				<div class="thumb-info mb-md"><!--thumb-info mb-md start -->

					<img src="admin_images/<?php echo $admin_image; ?>" alt="" class="rounded img-responsive">

					<div class="thumb-info-title"><!--thumb-info-title start -->

						<span class="thumb-info-inner"><?php echo "$admin_name"; ?></span>
						<span class="thumb-info-type"><?php echo "$admin_job"; ?></span>

					</div><!--thumb-info-title end -->
				</div><!--thumb-info mb-md end -->

				<div class="mb-md"><!--mb-md start -->

					<div class="widget-content-expanded"><!--widget-content-expanded start -->
						<i class="fa fa-user"></i> <span>Email:</span> <?php echo "$admin_email"; ?> <br>
						<i class="fa fa-user"></i> <span>Country:</span> <?php echo "$admin_country"; ?> <br>
						<i class="fa fa-user"></i> <span>Contact:</span> <?php echo "$admin_contact"; ?> <br>
					</div><!--widget-content-expanded end -->
					<hr class="dotted short">

					<h5 class="text-muted"> About</h5>

					<p>
						<?php echo "$admin_about"; ?>

					</p>
				</div><!--mb-md end -->
			</div><!--panel-body end -->
		</div><!--panel end -->
	</div><!--col-md-4 start -->
</div><!-- 3 row end -->

<?php } ?>

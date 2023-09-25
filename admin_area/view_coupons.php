<?php 

if (!isset($_SESSION['admin_email'])) {
	
	echo "<script>window.open('login.php','_self') </script>";
}

else {


?>


<div class="row"><!--row start-->
	
	<div class="col-lg-12"><!--col-lg-12 start-->
		
		<ol class="breadcrumb"><!--bredacrumb start-->
			<li>
				<i class="fa fa-dashboard"></i> Dashboard / View Coupons
			</li>
		</ol><!--bredacrumb end-->
	</div><!--col-lg-12 end-->
</div><!--row end-->

<div class="row"><!-- 2 row start-->
	
	<div class="col-lg-12"><!--col-lg-12 start-->
		
		<div class="panel panel-default"><!--panel panel-default start-->
			<div class="panel-heading"><!--panel-heading start-->
				<h3 class="panel-title">
					<i class="fa fa-money fa-fw"></i> View Coupons 
				</h3>
			</div><!--panel-heading end-->

			<div class="panel-body"><!--panel-body start-->

			 <div class="table-responsive"><!--table-responsive start-->
			 	<table class="table table-bordered table-hover table-striped"><!--table-bordered table-hover table-striped start-->
			 		<thead><!--thead start-->
			 			<tr>
			 				<th>Coupon Id :</th>
			 				<th>Coupon Title :</th>
			 				<th>Product Title :</th>
			 				<th>Coupon Price :</th>
			 				<th>Coupon Code :</th>
			 				<th>Coupon Limit :</th>
			 				<th>Coupon Used :</th>
			 				<th>Delete Coupon :</th>
			 				<th>Edit Coupon :</th>
			 			</tr>
			 		</thead><!--thead end-->
			 		<tbody>
			 			<?php 

			 				$i = 0;

			 				$get_coupons = "select * from coupons ";

			 				$run_coupons = mysqli_query($con,$get_coupons);

			 				while ($row_coupons = mysqli_fetch_array($run_coupons)) {
			 					
			 					$coupon_id = $row_coupons['coupon_id'];
			 					
			 					$product_id = $row_coupons['product_id'];

			 					$coupon_title = $row_coupons['coupon_title'];

			 					$coupon_price = $row_coupons['coupon_price'];

			 					$coupon_code = $row_coupons['coupon_code'];

			 					$coupon_limit = $row_coupons['coupon_limit'];

			 					$coupon_used = $row_coupons['coupon_used'];

			 					$get_products = "select * from products where product_id='$product_id' ";

			 					$run_products = mysqli_query($con,$get_products);

			 					$row_products = mysqli_fetch_array($run_products);
			 					$product_title = $row_products['product_title'];

			 					$i++;
			 			 ?>
							
							<tr>
			 				<td><?php echo $i; ?></td>
			 				<td><?php echo $coupon_title; ?></td>
			 				<td><?php echo $product_title; ?></td>
			 				<td><?php echo "$coupon_price Lekë"; ?></td>
			 				<td><?php echo $coupon_code; ?></td>
			 				<td><?php echo $coupon_limit; ?></td>
			 				<td><?php echo $coupon_used; ?></td>
			 				<td>
			 					<a href="index.php?delete_coupon=<?php echo $coupon_id;?>">
			 						<i class="fa fa-trash-o"></i> Delete
			 					</a>
			 				</td>

			 				<td>
			 					<a href="index.php?edit_coupon=<?php echo $coupon_id;?>">
			 						<i class="fa fa-pencil"></i> Edit
			 					</a>
			 				</td>
			 				</tr>

			 			<?php } ?>
			 			
			 		</tbody>
			 	</table><!--table-bordered table-hover table-striped end-->
			 </div><!--table-responsive end-->
			</div><!--panel-body end-->
		</div><!--panel panel-default end-->
	</div><!--col-lg-12 end-->
</div><!-- 2 row end-->

<?php } ?>
<?php

if (!isset($_SESSION['admin_email'])) {

	echo "<script>window.open('login.php','_self') </script>";
}

else {


?>

<?php

if (isset($_GET['edit_coupon'])) {
	$edit_id = $_GET['edit_coupon'];

	$edit_coupon = "select * from coupons where coupon_id='$edit_id' ";

	$run_edit = mysqli_query($con,$edit_coupon);

	$row_edit = mysqli_fetch_array($run_edit);

	$c_id = $row_edit['coupon_id'];

	$c_title = $row_edit['coupon_title'];

	$c_price = $row_edit['coupon_price'];

	$c_code = $row_edit['coupon_code'];

	$c_limit = $row_edit['coupon_limit'];

	$p_id = $row_edit['product_id'];

	$get_products = "select * from products where product_id='$p_id' ";

	$run_products = mysqli_query($con,$get_products);

	$row_products = mysqli_fetch_array($run_products);

	$product_id = $row_products['product_id'];

	$product_title = $row_products['product_title'];
}


 ?>

<div class="row"><!--row start-->

	<div class="col-lg-12"><!--col-lg-12 start-->

		<ol class="breadcrumb"><!--bredacrumb start-->
			<li>
				<i class="fa fa-dashboard"></i> Dashboard / Edit Coupon
			</li>
		</ol><!--bredacrumb end-->
	</div><!--col-lg-12 end-->
</div><!--row end-->

<div class="row"><!-- 2 row start-->

	<div class="col-lg-12"><!--col-lg-12 start-->

		<div class="panel panel-default"><!--panel panel-default start-->

			<div class="panel-heading"><!--panel-heading start-->
				<h3 class="panel-title"><!--panel-title start-->
					<i class="fa fa-money fa-fw"></i> Edit Coupon
				</h3><!--panel-title end-->
			</div><!--panel-heading end-->

			<div class="panel-body"><!--panel-body start-->

				<form class="form-horizontal" action="" method="post"><!--form-horizontal start-->

				   <div class="form-group"><!--1 form-group start-->
				   	 <label class="col-md-3 control-label"> Coupon Title</label>

				   	 <div class="col-md-6">
				   	 	<input type="text" name="coupon_title" class="form-control
				   	 	" value="<?php echo $c_title;?>">
				   	 </div>
				   </div><!-- 1 form-group end-->

				   <div class="form-group"><!--2 form-group start-->
				   	 <label class="col-md-3 control-label">Coupon Price</label>

				   	 <div class="col-md-6">
				   	 	<input type="text" name="coupon_price" class="form-control
				   	 	"  value="<?php echo $c_price;?>">
				   	 </div>
				   </div><!--2 form-group end-->

				   <div class="form-group"><!--3 form-group start-->
				   	 <label class="col-md-3 control-label">Coupon Code</label>

				   	 <div class="col-md-6">
				   	 	<input type="text" name="coupon_code" class="form-control
				   	 	"  value="<?php echo $c_code;?>">
				   	 </div>
				   </div><!--3 form-group end-->

				   <div class="form-group"><!--4 form-group start-->
				   	 <label class="col-md-3 control-label">Coupon Limit</label>

				   	 <div class="col-md-6">
				   	 	<input type="number" name="coupon_limit" class="form-control
				   	 	"  value="<?php echo $c_limit;?>">
				   	 </div>
				   </div><!--4 form-group end-->

				   <div class="form-group"><!--5 form-group start-->
				   	 <label class="col-md-3 control-label">Select Coupon Product/Bundle</label>

				   	 <div class="col-md-6">
				   	 	<select name="product_id" class="form-control">
				   	 		<option value="<?php echo $product_id;?>"><?php echo $product_title;?></option>
				   	 		<?php

				   	 		$get_p = "select * from products where status='product' ";

				   	 		$run_p = mysqli_query($con,$get_p);

				   	 		while ($row_p = mysqli_fetch_array($run_p)) {
				   	 			$p_id = $row_p['product_id'];
				   	 			$p_title = $row_p['product_title'];

				   	 			echo "<option value='$p_id'> $p_title</option>";
				   	 		}
				   	 		?>

								<option></option>
								<option style="font-weight:600;">Select Coupon For Bundle</option>
								<?php

				   	 		$get_p = "select * from products where status='bundle' ";

				   	 		$run_p = mysqli_query($con,$get_p);

				   	 		while ($row_p = mysqli_fetch_array($run_p)) {
				   	 			$p_id = $row_p['product_id'];
				   	 			$p_title = $row_p['product_title'];

				   	 			echo "<option value='$p_id'> $p_title</option>";
				   	 		}
				   	 		?>
				   	 	</select>
				   </div>
				</div><!--5 form-group end-->

				   <div class="form-group"><!--6 form-group start-->
				   	 <label class="col-md-3 control-label"></label>

				   	 <div class="col-md-6">
				   	 	<input type="submit" name="update" value="Update Coupon" class="btn btn-primary form-control">
				   	 </div>
				   </div><!--6 form-group end-->
				</form><!--form-horizontal end-->
			</div><!--panel-body end-->
		</div><!--panel panel-default end-->
	</div><!--col-lg-12 end-->
</div><!-- 2 row end-->


<?php

	if (isset($_POST['update'])) {

		$coupon_title = $_POST['coupon_title'];

		$coupon_price = $_POST['coupon_price'];

		$coupon_code = $_POST['coupon_code'];

		$coupon_limit = $_POST['coupon_limit'];

		$product_id = $_POST['product_id'];

		$update_coupon = "update coupons set product_id='$product_id',coupon_title='$coupon_title',coupon_price='$coupon_price',coupon_code='$coupon_code',coupon_limit='$coupon_limit',coupon_used='$c_used' where coupon_id='$c_id' ";

		$run_coupon = mysqli_query($con,$update_coupon);

		if ($run_coupon) {
			echo "<script>alert('One Coupon Has Been Updated') </script>";
			echo "<script>window.open('index.php?view_coupons','_self') </script>";
		}

	}

 ?>


<?php } ?>

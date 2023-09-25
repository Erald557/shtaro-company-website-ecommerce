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
				<i class="fa fa-dashboard"></i> Dashboard / Insert Relation
			</li>
		</ol><!--bredacrumb end-->
	</div><!--col-lg-12 end-->
</div><!--row end-->

<div class="row"><!-- 2 row start-->

	<div class="col-lg-12"><!--col-lg-12 start-->

		<div class="panel panel-default"><!--panel panel-default start-->

			<div class="panel-heading"><!--panel-heading start-->
				<h3 class="panel-title"><!--panel-title start-->
					<i class="fa fa-money fa-fw"></i> Insert Relation
				</h3><!--panel-title end-->
			</div><!--panel-heading end-->

			<div class="panel-body"><!--panel-body start-->

				<form class="form-horizontal" action="" method="post"><!--form-horizontal start-->

				   <div class="form-group"><!--1 form-group start-->
				   	 <label class="col-md-3 control-label">Relation Title</label>

				   	 <div class="col-md-6">
				   	 	<input type="text" name="rel_title" class="form-control
				   	 	">
				   	 </div>
				   </div><!-- 1 form-group end-->

				   <div class="form-group"><!--2 form-group start-->
				   	 <label class="col-md-3 control-label">Select Product</label>

				   	 <div class="col-md-6">
				   	 	<select name="product_id" class="form-control">
				   	 		<option>Select Product</option>}
				   	 		<?php
				   	 			$get_p = "select * from products where status='product' ";
				   	 			$run_p = mysqli_query($con,$get_p);

				   	 			while ($row_p = mysqli_fetch_array($run_p)) {
				   	 				$p_id = $row_p['product_id'];

				   	 				$p_title = $row_p['product_title'];

				   	 				echo "<option value='$p_id'> $p_title</option>";
				   	 			}
				   	 		 ?>
				   	 	</select>
				   	 </div>
				   </div><!--2 form-group end-->

				   <div class="form-group"><!--3 form-group start-->
				   	 <label class="col-md-3 control-label">Select Bundle</label>

				   	 <div class="col-md-6">
				   	 	<select name="bundle_id" class="form-control">
				   	 		<option>Select Bundle</option>}
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
				   </div><!--3 form-group end-->

				   <div class="form-group"><!--4 form-group start-->
				   	 <label class="col-md-3 control-label"></label>

				   	 <div class="col-md-6">
				   	 	<input type="submit" name="submit" value="Insert Relation" class="btn btn-primary form-control">
				   	 </div>
				   </div><!--4 form-group end-->
				</form><!--form-horizontal end-->
			</div><!--panel-body end-->
		</div><!--panel panel-default end-->
	</div><!--col-lg-12 end-->
</div><!-- 2 row end-->


<?php

	if (isset($_POST['submit'])) {

		$rel_title = $_POST['rel_title'];

		$product_id = $_POST['product_id'];

		$bundle_id = $_POST['bundle_id'];

		$insert_rel = "insert into bundle_product_relation (rel_title,product_id,bundle_id) values ('$rel_title', '$product_id', '$bundle_id') ";

		$run_rel = mysqli_query($con,$insert_rel);

		if ($run_rel) {
			echo "<script>alert('New Relation Has Been Inserted') </script>";
			echo "<script>window.open('index.php?view_rel','_self') </script>";
		}

	}

 ?>

<?php } ?>

<?php 

if (!isset($_SESSION['admin_email'])) {
	
	echo "<script>window.open('login.php','_self') </script>";
}

else {


?>

<div class="row"><!-- row start -->
	
	<div class="col-lg-12"><!-- col-lg-12 start -->
		
		<ol class="breadcrumb"><!-- breadcrumb start -->
			<li>
				<i class="fa fa-dashboard"></i> Dashboard / Insert Products Category
			</li>
		</ol><!-- breadcrumb end -->
	</div><!-- col-lg-12 end -->
</div><!-- row end -->

<div class="row"><!--2 row start -->
	
	<div class="col-lg-12"><!-- col-lg-12 start -->
		
		<div class="panel panel-default"><!-- panel panel-default start -->
			
			<div class="panel-heading"><!--  panel-heading start -->
				<h3 class="panel-title"><!--  panel-title start -->
					<i class="fa fa-money fa-fw"></i> Insert Product Category
				</h3><!--  panel-title end -->
			</div><!--  panel-heading end -->

			<div class="panel-body"><!--  panel-body start -->
				<form class="form-horizontal" action="" method="post" enctype="multipart/form-data"><!--  form-horizontal start -->
					<div class="form-group"><!-- form-group start -->
						<label class="col-md-3 control-label">
							Product Category Title
						</label>

						<div class="col-md-6">
							<input type="text" name="p_cat_title" class="form-control">
						</div>
					</div><!-- form-group end -->


					<div class="form-group"><!-- form-group start -->
						<label class="col-md-3 control-label">
							Show as Top Product Category
						</label>

						<div class="col-md-6">
						<input type="radio" name="p_cat_top" value="yes">
						<label>Yes</label>

						<input type="radio" name="p_cat_top" value="no">
						<label>No</label>
						</div>
					</div><!-- form-group end -->

					<div class="form-group"><!-- form-group start -->
						<label class="col-md-3 control-label">
							Select Product Category Image
						</label>

						<div class="col-md-6">
							<input type="file" name="p_cat_image" class="form-control">
						</div>
					</div><!-- form-group end -->

					<div class="form-group"><!-- form-group start -->
						<label class="col-md-3 control-label">
							
						</label>

						<div class="col-md-6">
							<input type="submit" name="submit" value="Submit Now" class="btn btn-primary form-control">
						</div>
					</div><!-- form-group end -->
				</form><!--  form-horizontal end -->
			</div><!--  panel-body end -->
		</div><!-- panel panel-default end -->
	</div><!-- col-lg-12 end -->
</div><!--2 row end -->


<?php 

	if (isset($_POST['submit'])) {
		
		$p_cat_title = $_POST['p_cat_title'];

		$p_cat_top = $_POST['p_cat_top'];

		$p_cat_image = $_FILES['p_cat_image']['name'];

		$temp_name = $_FILES['p_cat_image']['tmp_name'];

		move_uploaded_file($temp_name,"other_images/$p_cat_image");

		$insert_p_cat = "insert into product_categories (p_cat_title,p_cat_top,p_cat_image) values ('$p_cat_title','$p_cat_top','$p_cat_image') ";

		$run_p_cat = mysqli_query($con,$insert_p_cat);

		if ($run_p_cat) {
			
			echo "<script>alert('New Product Category Has Been Inserted') </script>";
			echo "<script>window.open('index.php?view_p_cats','_self') </script>";
		}
	}

 ?>


<?php } ?>
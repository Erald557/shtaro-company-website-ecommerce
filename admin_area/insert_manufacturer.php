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
				<i class="fa fa-dashboard"></i> Dashboard / Insert Manufacturer
			</li>
		</ol><!--bredacrumb end-->
	</div><!--col-lg-12 end-->
</div><!--row end-->

<div class="row"><!-- 2 row start-->
	
	<div class="col-lg-12"><!--col-lg-12 start-->
		
		<div class="panel panel-default"><!--panel panel-default start-->
			
			<div class="panel-heading"><!--panel-heading start-->
				<h3 class="panel-title"><!--panel-title start-->
					<i class="fa fa-money fa-fw"></i> Insert Manufacturer
				</h3><!--panel-title end-->
			</div><!--panel-heading end-->

			<div class="panel-body"><!--panel-body start-->
				
				<form class="form-horizontal" action="" method="post" enctype="multipart/form-data"><!--form-horizontal start-->
					
				   <div class="form-group"><!--form-group start-->
				   	 <label class="col-md-3 control-label">Manufacturer Name</label>

				   	 <div class="col-md-6">
				   	 	<input type="text" name="manufacturer_name" class="form-control
				   	 	">
				   	 </div>
				   </div><!--form-group end-->

				   <div class="form-group"><!--form-group start-->
				   	 <label class="col-md-3 control-label">Show as Top Manufacturers</label>

				   	 <div class="col-md-6">
						<input type="radio" name="manufacturer_top" value="yes">
						<label>Yes</label>

						<input type="radio" name="manufacturer_top" value="no">
						<label>No</label>
				   	 </div>
				   </div><!--form-group end-->

				   <div class="form-group"><!--form-group start-->
				   	 <label class="col-md-3 control-label">Select Manufacturer Image</label>

				   	 <div class="col-md-6">
				   	 	<input type="file" name="manufacturer_image" class="form-control
				   	 	">
				   	 </div>
				   </div><!--form-group end-->

				   <div class="form-group"><!--form-group start-->
				   	 <label class="col-md-3 control-label"></label>

				   	 <div class="col-md-6">
				   	 	<input type="submit" name="submit" value="Insert Manufacturer" class="btn btn-primary form-control">
				   	 </div>
				   </div><!--form-group end-->
				</form><!--form-horizontal end-->
			</div><!--panel-body end-->
		</div><!--panel panel-default end-->
	</div><!--col-lg-12 end-->
</div><!-- 2 row end-->

<?php 

	if (isset($_POST['submit'])) {
		
		$manufacturer_name = $_POST['manufacturer_name'];

		$manufacturer_top = $_POST['manufacturer_top'];

		$manufacturer_image = $_FILES['manufacturer_image']['name'];

		$tmp_name = $_FILES['manufacturer_image']['tmp_name'];

		move_uploaded_file($tmp_name,"other_images/$manufacturer_image");

		$insert_manufacturer = "insert into manufacturers (manufacturer_title,manufacturer_top,manufacturer_image) values ('$manufacturer_name','$manufacturer_top','$manufacturer_image') ";

		$run_manufacturer = mysqli_query($con,$insert_manufacturer);

		if ($run_manufacturer) {
			
			echo "<script>alert('New Manufacturer Has Been Inserted') </script>";
			echo "<script>window.open('index.php?view_manufacturers','_self') </script>";
		}
	}

 ?>

<?php } ?>
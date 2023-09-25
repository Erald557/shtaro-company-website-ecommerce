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
				<i class="fa fa-dashboard"></i> Dashboard / Insert Banner
			</li>
		</ol><!--bredacrumb end-->
	</div><!--col-lg-12 end-->
</div><!--row end-->

<div class="row"><!-- 2 row start-->
	
	<div class="col-lg-12"><!--col-lg-12 start-->
		
		<div class="panel panel-default"><!--panel panel-default start-->
			
			<div class="panel-heading"><!--panel-heading start-->
				<h3 class="panel-title"><!--panel-title start-->
					<i class="fa fa-money fa-fw"></i> Insert Banner
				</h3><!--panel-title end-->
			</div><!--panel-heading end-->

			<div class="panel-body"><!--panel-body start-->
				
				<form class="form-horizontal" action="" method="post" enctype="multipart/form-data"><!--form-horizontal start-->
					
				   <div class="form-group"><!--1 form-group start-->
				   	 <label class="col-md-3 control-label">Slide Name:</label>

				   	 <div class="col-md-6">
				   	 	<input type="text" name="slide_name" class="form-control
				   	 	">
				   	 </div>
				   </div><!-- 1 form-group end-->

				   <div class="form-group"><!--2 form-group start-->
				   	 <label class="col-md-3 control-label">Slide Url:</label>

				   	 <div class="col-md-6">
				   	 	<input type="text" name="slide_url" class="form-control
				   	 	">
				   	 </div>
				   </div><!--2 form-group end-->

				   <div class="form-group"><!--3 form-group start-->
				   	 <label class="col-md-3 control-label">Slide Image:</label>

				   	 <div class="col-md-6">
				   	 	<input type="file" name="slide_image" class="form-control
				   	 	">
				   	 </div>
				   </div><!--3 form-group end-->

				   <div class="form-group"><!--4 form-group start-->
				   	 <label class="col-md-3 control-label"></label>

				   	 <div class="col-md-6">
				   	 	<input type="submit" name="submit" value="Insert Slide" class="btn btn-primary form-control">
				   	 </div>
				   </div><!--4 form-group end-->
				</form><!--form-horizontal end-->
			</div><!--panel-body end-->
		</div><!--panel panel-default end-->
	</div><!--col-lg-12 end-->
</div><!-- 2 row end-->


<?php 

	if (isset($_POST['submit'])) {
		
		$slide_name = $_POST['slide_name'];

		$slide_url = $_POST['slide_url'];

		$slide_image = $_FILES['slide_image']['name'];

		$temp_name = $_FILES['slide_image']['tmp_name'];

		$view_slides = "select * from slider ";

		$view_run_slides = mysqli_query($con,$view_slides);

		$count = mysqli_num_rows($view_run_slides);

		if ($count<4) {
			
			move_uploaded_file($temp_name,"slides_images/$slide_image");

			$insert_slide = "insert into slider (slide_name,slide_url,slide_image) values ('$slide_name', '$slide_url', '$slide_image') ";

			$run_slide = mysqli_query($con,$insert_slide);

			echo "<script>alert('New Slide Has Been Inserted') </script>";
			echo "<script>window.open('index.php?view_slides','_self') </script>";
		}

		else {
			echo "<script>alert('You have already inserted 4 Slides') </script>";
		}
	}

 ?>

<?php } ?>
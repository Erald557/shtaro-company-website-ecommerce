<?php 

if (!isset($_SESSION['admin_email'])) {
	
	echo "<script>window.open('login.php','_self') </script>";
}

else {


?>

<?php 

	
	if (isset($_GET['edit_slide'])) {
		
		$edit_id = $_GET['edit_slide'];

		$edit_slide = "select * from slider where slide_id='$edit_id' ";

		$run_edit = mysqli_query($con,$edit_slide);

		$row_edit = mysqli_fetch_array($run_edit);

		$slide_id = $row_edit['slide_id'];

		$slide_name = $row_edit['slide_name'];

		$slide_url = $row_edit['slide_url'];

		$slide_image = $row_edit['slide_image'];

		$new_slide_image = $row_edit['slide_image'];
	}
 ?>

<div class="row"><!--row start-->
	
	<div class="col-lg-12"><!--col-lg-12 start-->
		
		<ol class="breadcrumb"><!--bredacrumb start-->
			<li>
				<i class="fa fa-dashboard"></i> Dashboard / Edit Banner
			</li>
		</ol><!--bredacrumb end-->
	</div><!--col-lg-12 end-->
</div><!--row end-->

<div class="row"><!-- 2 row start-->
	
	<div class="col-lg-12"><!--col-lg-12 start-->
		
		<div class="panel panel-default"><!--panel panel-default start-->
			
			<div class="panel-heading"><!--panel-heading start-->
				<h3 class="panel-title"><!--panel-title start-->
					<i class="fa fa-money fa-fw"></i> Edit Banner
				</h3><!--panel-title end-->
			</div><!--panel-heading end-->

			<div class="panel-body"><!--panel-body start-->
				
				<form class="form-horizontal" action="" method="post" enctype="multipart/form-data"><!--form-horizontal start-->
					
				   <div class="form-group"><!--form-group start-->
				   	 <label class="col-md-3 control-label">Slide Name:</label>

				   	 <div class="col-md-6">
				   	 	<input type="text" name="slide_name" class="form-control
				   	 	" value="<?php echo $slide_name; ?>">
				   	 </div>
				   </div><!--form-group end-->

				   <div class="form-group"><!--form-group start-->
				   	 <label class="col-md-3 control-label">Slide Url:</label>

				   	 <div class="col-md-6">
				   	 	<input type="text" name="slide_url" class="form-control
				   	 	" value="<?php echo $slide_url; ?>">
				   	 </div>
				   </div><!--form-group end-->

				   <div class="form-group"><!--form-group start-->
				   	 <label class="col-md-3 control-label">Slide Image:</label>

				   	 <div class="col-md-6">
				   	 	<input type="file" name="slide_image" class="form-control
				   	 	"> <br>
				   	 	<img src="slides_images/<?php echo $slide_image; ?>" width="70" height="70">
				   	 </div>
				   </div><!--form-group end-->

				   <div class="form-group"><!--form-group start-->
				   	 <label class="col-md-3 control-label"></label>

				   	 <div class="col-md-6">
				   	 	<input type="submit" name="update" value="Update Now" class="btn btn-primary form-control">
				   	 </div>
				   </div><!--form-group end-->
				</form><!--form-horizontal end-->
			</div><!--panel-body end-->
		</div><!--panel panel-default end-->
	</div><!--col-lg-12 end-->
</div><!-- 2 row end-->


<?php 

	if (isset($_POST['update'])) {
		
		$slide_name = $_POST['slide_name'];

		$slide_url = $_POST['slide_url'];

		$slide_image = $_FILES['slide_image']['name'];

		$temp_name = $_FILES['slide_image']['tmp_name'];

		move_uploaded_file($temp_name,"slides_images/$slide_image");

		if (empty($slide_image)) {
			$slide_image = $new_slide_image;
		}

		$update_slide = "update slider set slide_name='$slide_name', slide_url='$slide_url', slide_image='$slide_image' where slide_id='$slide_id' ";

		$run_slide = mysqli_query($con,$update_slide);

		if ($run_slide) {
			
			echo "<script>alert('One Slide Has Been Updated') </script>";
			echo "<script>window.open('index.php?view_slides','_self') </script>";
		}
	}

 ?>

<?php } ?>
<?php

if (!isset($_SESSION['admin_email'])) {

	echo "<script>window.open('login.php','_self') </script>";
}

else {


?>

 <script src="https://cdn.tiny.cloud/1/s41vpdg5vtlq2pveudurinw0hi27qqtzwnsh4fdmiszn2vt6/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
 <script>tinymce.init({selector:'#about_desc'});</script>

 <?php
 $get_about_us = "select * from about_us";
 $run_about_us = mysqli_query($con,$get_about_us);
 $row_about_us = mysqli_fetch_array($run_about_us);
 $about_heading = $row_about_us['about_heading'];
 $about_short_desc = $row_about_us['about_short_desc'];
 $about_desc = $row_about_us['about_desc'];
   ?>

<div class="row"><!--row start-->

	<div class="col-lg-12"><!--col-lg-12 start-->

		<ol class="breadcrumb"><!--bredacrumb start-->
			<li>
				<i class="fa fa-dashboard"></i> Dashboard / Edit About Us Page
			</li>
		</ol><!--bredacrumb end-->
	</div><!--col-lg-12 end-->
</div><!--row end-->

<div class="row"><!-- 2 row start-->

	<div class="col-lg-12"><!--col-lg-12 start-->

		<div class="panel panel-default"><!--panel panel-default start-->

			<div class="panel-heading"><!--panel-heading start-->
				<h3 class="panel-title"><!--panel-title start-->
					<i class="fa fa-money fa-fw"></i> Edit About Us Page
				</h3><!--panel-title end-->
			</div><!--panel-heading end-->

			<div class="panel-body"><!--panel-body start-->

				<form class="form-horizontal" action="" method="post"><!--form-horizontal start-->

				   <div class="form-group"><!--form-group start-->
				   	 <label class="col-md-3 control-label">About Us Heading</label>

				   	 <div class="col-md-8">
				   	 	<input type="text" name="about_heading" class="form-control
				   	 	" value="<?php echo $about_heading; ?>">
				   	 </div>
				   </div><!--form-group end-->

				   <div class="form-group"><!--form-group start-->
				   	 <label class="col-md-3 control-label">About Us Short Description</label>

				   	 <div class="col-md-8">
				   	 <textarea name="about_short_desc" rows="5"  class="form-control"><?php echo $about_short_desc; ?>
              </textarea>
				   	 </div>
				   </div><!--form-group end-->

				   <div class="form-group"><!--form-group start-->
				   	 <label class="col-md-3 control-label">About Us Description</label>

				   	 <div class="col-md-8">
				   	 	<textarea name="about_desc" id="about_desc" rows="17" class="form-control"><?php echo $about_desc; ?>
                </textarea>
				   	 </div>
				   </div><!--form-group end-->

				   <div class="form-group"><!--form-group start-->
				   	 <label class="col-md-3 control-label"></label>

				   	 <div class="col-md-8">
				   	 	<input type="submit" name="update" value="Update About Us Page" class="btn btn-primary form-control">
				   	 </div>
				   </div><!--form-group end-->
				</form><!--form-horizontal end-->
			</div><!--panel-body end-->
		</div><!--panel panel-default end-->
	</div><!--col-lg-12 end-->
</div><!-- 2 row end-->


<?php

	if (isset($_POST['update'])) {

		$about_heading = $_POST['about_heading'];
    $about_short_desc = $_POST['about_short_desc'];
    $about_desc = $_POST['about_desc'];

		$update_about_us = "update about_us set about_heading='$about_heading', about_short_desc='$about_short_desc', about_desc='$about_desc'";

		$run_about_us = mysqli_query($con,$update_about_us);

		if ($run_about_us) {

			echo "<script>alert('About Us Page Has Been Updated') </script>";
			echo "<script>window.open('index.php?dashboard','_self') </script>";
		}
	}

 ?>

<?php } ?>

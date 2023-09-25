<?php

if (!isset($_SESSION['admin_email'])) {

	echo "<script>window.open('login.php','_self') </script>";
}

else {


?>
<script src="https://cdn.tiny.cloud/1/s41vpdg5vtlq2pveudurinw0hi27qqtzwnsh4fdmiszn2vt6/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>tinymce.init({selector:'textarea'});</script>

<div class="row"><!--row start-->

	<div class="col-lg-12"><!--col-lg-12 start-->

		<ol class="breadcrumb"><!--bredacrumb start-->
			<li>
				<i class="fa fa-dashboard"></i> Dashboard / Insert Service
			</li>
		</ol><!--bredacrumb end-->
	</div><!--col-lg-12 end-->
</div><!--row end-->

<div class="row"><!-- 2 row start-->

	<div class="col-lg-12"><!--col-lg-12 start-->

		<div class="panel panel-default"><!--panel panel-default start-->

			<div class="panel-heading"><!--panel-heading start-->
				<h3 class="panel-title"><!--panel-title start-->
					<i class="fa fa-money fa-fw"></i> Insert Service
				</h3><!--panel-title end-->
			</div><!--panel-heading end-->

			<div class="panel-body"><!--panel-body start-->

				<form class="form-horizontal" action="" method="post" enctype="multipart/form-data"><!--form-horizontal start-->

				   <div class="form-group"><!--form-group start-->
				   	 <label class="col-md-3 control-label">Service Title</label>

				   	 <div class="col-md-6">
				   	 	<input type="text" name="service_title" class="form-control
				   	 	">
				   	 </div>
				   </div><!--form-group end-->

           <div class="form-group"><!--form-group start-->
				   	 <label class="col-md-3 control-label">Service Image</label>

				   	 <div class="col-md-6">
				   	 	<input type="file" name="service_image" class="form-control
				   	 	">
				   	 </div>
				   </div><!--form-group end-->

				   <div class="form-group"><!--form-group start-->
				   	 <label class="col-md-3 control-label">Service Description</label>

				   	 <div class="col-md-6">
						<textarea type="text" name="service_desc" class="form-control" rows="15" cols="19"></textarea>
				   	 </div>
				   </div><!--form-group end-->

           <div class="form-group"><!--form-group start-->
				   	 <label class="col-md-3 control-label">Service Button</label>

				   	 <div class="col-md-6">
				   	 	<input type="text" name="service_button" class="form-control
				   	 	">
				   	 </div>
				   </div><!--form-group end-->

           <div class="form-group"><!--form-group start-->
				   	 <label class="col-md-3 control-label">Service Url</label>

				   	 <div class="col-md-6">
				   	 	<input type="url" name="service_url" class="form-control
				   	 	">
				   	 </div>
				   </div><!--form-group end-->

				   <div class="form-group"><!--form-group start-->
				   	 <label class="col-md-3 control-label"></label>

				   	 <div class="col-md-6">
				   	 	<input type="submit" name="submit" value="Insert Service" class="btn btn-primary form-control">
				   	 </div>
				   </div><!--form-group end-->
				</form><!--form-horizontal end-->
			</div><!--panel-body end-->
		</div><!--panel panel-default end-->
	</div><!--col-lg-12 end-->
</div><!-- 2 row end-->

<?php

	if (isset($_POST['submit'])) {

		$service_title = $_POST['service_title'];
    $service_desc = $_POST['service_desc'];
    $service_button = $_POST['service_button'];
    $service_url = $_POST['service_url'];
    $service_image = $_FILES['service_image']['name'];
    $tmp_image = $_FILES['service_image']['tmp_name'];

    $sel_services = "select * from services";
    $run_services = mysqli_query($con, $sel_services);
    $count = mysqli_num_rows($run_services);
		if ($count == 3) {
      echo "<script>alert('You Have Already Inserted 3 Services Columns!') </script>";
	}else {
    move_uploaded_file($tmp_image, "services_images/$service_image");
    $insert_service = "insert into services (service_title,service_image,service_desc,service_button,service_url)
    values ('$service_title','$service_image','$service_desc','$service_button','$service_url')";

    $run_service = mysqli_query($con,$insert_service);
    if ($run_service) {
      echo "<script>alert('New Service Column Has Been Inserted!')</script>";
      echo "<script>window.open('index.php?view_services','_self')</script>";
    }
  }
}
 ?>

<?php } ?>

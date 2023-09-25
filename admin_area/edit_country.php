<?php

if (!isset($_SESSION['admin_email'])) {

	echo "<script>window.open('login.php','_self') </script>";
}

else {

$edit_country_id = $_GET['edit_country'];
$select_country = "select * from countries where country_id='$edit_country_id'";
$run_country = mysqli_query($con, $select_country);
$row_country = mysqli_fetch_array($run_country);
$country_name = $row_country['country_name'];

?>

<div class="row"><!--row start-->

	<div class="col-lg-12"><!--col-lg-12 start-->

		<ol class="breadcrumb"><!--bredacrumb start-->
			<li>
				<i class="fa fa-dashboard"></i> Dashboard / Edit Country
			</li>
		</ol><!--bredacrumb end-->
	</div><!--col-lg-12 end-->
</div><!--row end-->

<div class="row"><!-- 2 row start-->

	<div class="col-lg-12"><!--col-lg-12 start-->

		<div class="panel panel-default"><!--panel panel-default start-->

			<div class="panel-heading"><!--panel-heading start-->
				<h3 class="panel-title"><!--panel-title start-->
					<i class="fa fa-money fa-fw"></i> Edit Country
				</h3><!--panel-title end-->
			</div><!--panel-heading end-->

			<div class="panel-body"><!--panel-body start-->

				<form class="form-horizontal" action="" method="post"><!--form-horizontal start-->

				   <div class="form-group"><!--form-group start-->
				   	 <label class="col-md-3 control-label">Country Name</label>

				   	 <div class="col-md-7">
				   	 	<input type="text" name="country_name" class="form-control
				   	 	" value="<?php echo $country_name; ?>" >
				   	 </div>
				   </div><!--form-group end-->

				   <div class="form-group"><!--form-group start-->
				   	 <label class="col-md-3 control-label"></label>
             <div class="col-md-7">
				   	 	<input type="submit" name="update" value="Update Country" class="btn btn-primary form-control">
				   	 </div>
				   </div><!--form-group end-->
				</form><!--form-horizontal end-->
			</div><!--panel-body end-->
		</div><!--panel panel-default end-->
	</div><!--col-lg-12 end-->
</div><!-- 2 row end-->

<?php

	if (isset($_POST['update'])) {
    $country_name = mysqli_real_escape_string($con, $_POST['country_name']);
    $update_country = "update countries set country_name='$country_name' where
    country_id='$edit_country_id'";
    $run_update_country = mysqli_query($con, $update_country);
    if ($run_update_country) {
      echo "<script>
        alert('Country Has Been Updated Successfully!');
        window.open('index.php?view_countries','_self');
      </script>";
    }

}
 ?>

<?php } ?>

<?php

if (!isset($_SESSION['admin_email'])) {

	echo "<script>window.open('login.php','_self') </script>";
}

else {

if (isset($_GET['edit_shipping_type'])) {
  $edit_type_id = $_GET['edit_shipping_type'];
  $get_shipping_type = "select * from shipping_types where type_id='$edit_type_id'";
  $run_shipping_type = mysqli_query($con, $get_shipping_type);
  $row_shipping_type = mysqli_fetch_array($run_shipping_type);
  $type_name = $row_shipping_type['type_name'];
  $type_default = $row_shipping_type['type_default'];
  $type_local = $row_shipping_type['type_local'];
}

?>

<div class="row"><!--row start-->

	<div class="col-lg-12"><!--col-lg-12 start-->

		<ol class="breadcrumb"><!--bredacrumb start-->
			<li>
				<i class="fa fa-dashboard"></i> Dashboard / Edit Shipping Type
			</li>
		</ol><!--bredacrumb end-->
	</div><!--col-lg-12 end-->
</div><!--row end-->

<div class="row"><!-- 2 row start-->

	<div class="col-lg-12"><!--col-lg-12 start-->

		<div class="panel panel-default"><!--panel panel-default start-->

			<div class="panel-heading"><!--panel-heading start-->
				<h3 class="panel-title"><!--panel-title start-->
					<i class="fa fa-money fa-fw"></i> Edit Shipping Type
				</h3><!--panel-title end-->
			</div><!--panel-heading end-->

			<div class="panel-body"><!--panel-body start-->

				<form class="form-horizontal" action="" method="post"><!--form-horizontal start-->

				   <div class="form-group"><!--form-group start-->
				   	 <label class="col-md-3 control-label">Type Name</label>

				   	 <div class="col-md-7">
				   	 	<input type="text" name="type_name" class="form-control
				   	 	" value="<?php echo $type_name; ?>" required>
				   	 </div>
				   </div><!--form-group end-->

           <div class="form-group"><!--form-group start-->
				   	 <label class="col-md-3 control-label">Type Default</label>

				   	 <div class="col-md-7">
              <label>
                <input type="radio" name="type_default" value="yes" required
                <?php if($type_default == "yes"){echo "checked";} ?>
                > Yes
              </label>
              <label>
                <input type="radio" name="type_default" value="no" required
                <?php if($type_default == "no"){echo "checked";} ?>
                > No
              </label>
				   	 </div>
				   </div><!--form-group end-->

				   <div class="form-group"><!--form-group start-->
				   	 <label class="col-md-3 control-label"></label>
             <div class="col-md-7">
				   	 	<input type="submit" name="update" value="Update Shipping Type" class="btn btn-primary form-control">
				   	 </div>
				   </div><!--form-group end-->
				</form><!--form-horizontal end-->
			</div><!--panel-body end-->
		</div><!--panel panel-default end-->
	</div><!--col-lg-12 end-->
</div><!-- 2 row end-->

<?php

	if (isset($_POST['update'])) {
    $type_name = mysqli_real_escape_string($con, $_POST['type_name']);
    $type_default = mysqli_real_escape_string($con, $_POST['type_default']);
    if ($type_default == "yes") {
      $update_type_default = "update shipping_types set type_default='no' where
      type_local='$type_local'";
      $run_update_type_default = mysqli_query($con, $update_type_default);
    }

    $update_shipping_type = "update shipping_types set type_name='$type_name', type_default='$type_default'
    where type_id='$edit_type_id'";
    $run_update_shipping_type = mysqli_query($con, $update_shipping_type);
    if ($run_update_shipping_type) {
      echo "<script>
        alert('The Shipping Type Has Been Updated Successfully!');
        window.open('index.php?view_shipping_types','_self');
      </script>";
    }

}
 ?>

<?php } ?>

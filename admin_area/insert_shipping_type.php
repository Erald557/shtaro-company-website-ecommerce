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
				<i class="fa fa-dashboard"></i> Dashboard / Insert Shipping Type
			</li>
		</ol><!--bredacrumb end-->
	</div><!--col-lg-12 end-->
</div><!--row end-->

<div class="row"><!-- 2 row start-->

	<div class="col-lg-12"><!--col-lg-12 start-->

		<div class="panel panel-default"><!--panel panel-default start-->

			<div class="panel-heading"><!--panel-heading start-->
				<h3 class="panel-title"><!--panel-title start-->
					<i class="fa fa-money fa-fw"></i> Insert Shipping Type
				</h3><!--panel-title end-->
			</div><!--panel-heading end-->

			<div class="panel-body"><!--panel-body start-->

				<form class="form-horizontal" action="" method="post"><!--form-horizontal start-->

				   <div class="form-group"><!--form-group start-->
				   	 <label class="col-md-3 control-label">Type Name</label>

				   	 <div class="col-md-7">
				   	 	<input type="text" name="type_name" class="form-control
				   	 	" required>
				   	 </div>
				   </div><!--form-group end-->

           <div class="form-group"><!--form-group start-->
				   	 <label class="col-md-3 control-label">Type Default</label>

				   	 <div class="col-md-7">
              <label>
                <input type="radio" name="type_default" value="yes" required> Yes
              </label>
              <label>
                <input type="radio" name="type_default" value="no" required> No
              </label>
				   	 </div>
				   </div><!--form-group end-->

           <div class="form-group"><!--form-group start-->
				   	 <label class="col-md-3 control-label"> Type Local</label>
             <div class="col-md-7">
               <label>
                 <input type="radio" name="type_local" value="yes" required> Yes
               </label>
               <label>
                 <input type="radio" name="type_local" value="no" required> No
               </label>
				   	 </div>
           </div><!--form-group end-->

				   <div class="form-group"><!--form-group start-->
				   	 <label class="col-md-3 control-label"></label>
             <div class="col-md-7">
				   	 	<input type="submit" name="submit" value="Insert Shipping Type" class="btn btn-primary form-control">
				   	 </div>
				   </div><!--form-group end-->
				</form><!--form-horizontal end-->
			</div><!--panel-body end-->
		</div><!--panel panel-default end-->
	</div><!--col-lg-12 end-->
</div><!-- 2 row end-->

<?php

	if (isset($_POST['submit'])) {
    $type_name = mysqli_real_escape_string($con, $_POST['type_name']);
    $type_default = mysqli_real_escape_string($con, $_POST['type_default']);
    $type_local = mysqli_real_escape_string($con, $_POST['type_local']);
    if ($type_default == "yes") {
      $update_type_default = "update shipping_types set type_default='no' where
      type_local='$type_local'";
      $run_update_type_default = mysqli_query($con, $update_type_default);
    }
    $select_type_order = "select max(type_order) AS type_order from shipping_types where
    type_local='$type_local'";
    $run_type_order = mysqli_query($con, $select_type_order);
    $row_type_order = mysqli_fetch_array($run_type_order);
    $type_order = $row_type_order['type_order'] + 1;
    $insert_shipping_type = "insert into shipping_types (type_name,type_default,type_local,type_order) values
    ('$type_name','$type_default','$type_local','$type_order')";

    $run_insert_shipping_type = mysqli_query($con, $insert_shipping_type);
    if ($run_insert_shipping_type) {
      echo "<script>
        alert('New Shipping Type Has Been Inserted!');
        window.open('index.php?view_shipping_types','_self');
      </script>";
    }

}
 ?>

<?php } ?>

<?php

if (!isset($_SESSION['admin_email'])) {

	echo "<script>window.open('login.php','_self') </script>";
}

else {

$edit_zone_id = $_GET['edit_shipping_zone'];
$get_zone = "select * from zones where zone_id='$edit_zone_id'";
$run_zone = mysqli_query($con, $get_zone);
$row_zone = mysqli_fetch_array($run_zone);
$zone_name = $row_zone['zone_name'];

?>

<link rel="stylesheet" href="css/chosen.min.css">
<script src="js/chosen.jquery.min.js"></script>

<div class="row"><!--row start-->

	<div class="col-lg-12"><!--col-lg-12 start-->

		<ol class="breadcrumb"><!--bredacrumb start-->
			<li>
				<i class="fa fa-dashboard"></i> Dashboard / Edit Shipping Zone
			</li>
		</ol><!--bredacrumb end-->
	</div><!--col-lg-12 end-->
</div><!--row end-->

<div class="row"><!-- 2 row start-->

	<div class="col-lg-12"><!--col-lg-12 start-->

		<div class="panel panel-default"><!--panel panel-default start-->

			<div class="panel-heading"><!--panel-heading start-->
				<h3 class="panel-title"><!--panel-title start-->
					<i class="fa fa-money fa-fw"></i> Edit Shipping Zone
				</h3><!--panel-title end-->
			</div><!--panel-heading end-->

			<div class="panel-body"><!--panel-body start-->

				<form class="form-horizontal" action="" method="post" enctype="multipart/form-data"><!--form-horizontal start-->

				   <div class="form-group"><!--form-group start-->
				   	 <label class="col-md-3 control-label">Zone Name</label>

				   	 <div class="col-md-7">
				   	 	<input type="text" name="zone_name" class="form-control" value="<?php echo $zone_name; ?>">
				   	 </div>
				   </div><!--form-group end-->

           <div class="form-group"><!--form-group start-->
				   	 <label class="col-md-3 control-label">Zone Regions</label>

				   	 <div class="col-md-7">
				   	 	<select name="zone_countries[]" class="form-control chosen-select" data-placeholder="Select Zone Regions" multiple>
                <?php
                $select_countries = "select * from countries";
                $run_countries = mysqli_query($con, $select_countries);
                while ($row_countries = mysqli_fetch_array($run_countries)) {
                  $country_id = $row_countries['country_id'];
                  $country_name = $row_countries['country_name'];
                  $get_zone_locations = "select * from zones_locations where zone_id='$edit_zone_id'
                  and location_type='country' and location_code='$country_id'";
                  $run_zone_locations = mysqli_query($con, $get_zone_locations);
                  $row_zone_locations = mysqli_num_rows($run_zone_locations);

                  if ($count_zone_locations == 0) {
                    echo "<option value='$country_id'> $country_name</option>";
                  }else {
                    echo "<option value='$country_id' selected> $country_name</option>";
                  }

                }
                 ?>

              </select>
              <script>
                $('.chosen-select').chosen();
              </script>
				   	 </div>
				   </div><!--form-group end-->

           <div class="form-group"><!--form-group start-->
				   	 <label class="col-md-3 control-label"> Limit to Specific Zip/Postcodes</label>
             <div class="col-md-7">
				   	 	<textarea name="zone_post_codes" class="form-control" rows="5" placeholder="List 1 Postcode Per Line"><?php
              $result = "";
              $get_zone_locations = "select * from zones_locations where zone_id='$edit_zone_id'
              and location_type='postcode'";
              $run_zone_locations = mysqli_query($con, $get_zone_locations);
              while ($row_zone_locations = mysqli_fetch_array($run_zone_locations)) {
                $location_code = $row_zone_locations['location_code'];
                $result .= "$location_code\n";
              }
              echo rtrim($result, "\n");
               ?></textarea>
             </div>
           </div><!--form-group end-->

				   <div class="form-group"><!--form-group start-->
				   	 <label class="col-md-3 control-label"></label>
             <div class="col-md-7">
				   	 	<input type="submit" name="update" value="Update Shipping Zone" class="btn btn-primary form-control">
				   	 </div>
				   </div><!--form-group end-->
				</form><!--form-horizontal end-->
			</div><!--panel-body end-->
		</div><!--panel panel-default end-->
	</div><!--col-lg-12 end-->
</div><!-- 2 row end-->

<?php

	if (isset($_POST['update'])) {
    $zone_name = mysqli_real_escape_string($con, $_POST['zone_name']);
    $zone_countries = $_POST['zone_countries'];
    $update_zone = "update zones set zone_name='$zone_name' where zone_id='$edit_zone_id'";
    $run_update_zone = mysqli_query($con, $update_zone);
    if ($run_update_zone) {
      $delete_zone_locations = "delete zones_locations where zone_id='$edit_zone_id'";
      $run_delete_zone_locations = mysqli_query($con, $delete_zone_locations);

      foreach ($zone_countries as $country_id) {
        $country_id = mysqli_real_escape_string($con, $country_id);
        $insert_zone_location = "insert into zones_locations (zone_id,location_code,location_type)
        values ('$edit_zone_id','$country_id','country')";
        $run_zone_location = mysqli_query($con, $insert_zone_location);
      }

      if (!empty($_POST['zone_post_codes'])) {
        if (strpos($_POST['zone_post_codes'], "\n")) {
          $post_codes = explode("\n", $_POST['zone_post_codes']);
        }else {
          $post_codes = array($_POST['zone_post_codes']);
        }

        foreach ($post_codes as $post_code) {
        $location_code = mysqli_real_escape_string($con, trim($post_code));
        $insert_zone_location = "insert into zones_locations (zone_id,location_code,location_type)
        values ('$edit_zone_id','$location_code','postcode')";
        $run_zone_location = mysqli_query($con, $insert_zone_location);
        }
      }

      echo "<script>
      alert('One Shipping Zone Has Been Updated!');
      window.open('index.php?view_shipping_zones','_self');
      </script>";
    }
}
 ?>

<?php } ?>

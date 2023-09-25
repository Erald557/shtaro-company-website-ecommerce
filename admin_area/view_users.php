<?php

if (!isset($_SESSION['admin_email'])) {

	echo "<script>window.open('login.php','_self') </script>";
}

else {

?>

<div class="row"><!-- row start-->
	<div class="col-lg-12"><!-- col-lg-12 start-->

		<ol class="breadcrumb"><!-- breadcrumb start-->
			<li class="active">
				<i class="fa fa-dashboard"></i>Dashboard / View Users
			</li>
		</ol><!-- breadcrumb start-->
	</div><!-- col-lg-12 end-->

</div><!-- row end-->

<div class="row"><!--2 row start-->
   <div class="col-lg-12"><!-- col-lg-12 start-->

   	<div class="panel panel-default"><!-- panel panel-default start-->
   		<div class="panel-heading"><!-- panel-heading start-->

   			<h3 class="panel-title"><!-- panel-title start-->
   				<i class="fa fa-money fa-fw"></i> View Users
   			</h3><!-- panel-title end-->
   		</div><!-- panel-heading end-->

   		<div class="panel-body"><!-- panel-body start-->
   			<div class="table-responsive"><!-- table-responsive start-->
   				<table class="table table-bordered table-hover table-striped"><!-- table table-bordered table-hover table-striped start-->

   					<thead>
   						<tr>
   							<th>User Name:</th>
   							<th>User Email:</th>
   							<th>User Image:</th>
   							<th>User Country:</th>
   							<th>User Job:</th>
   							<th>Delete User:</th>
   						</tr>
   					</thead>
   					<tbody>
   						<?php

   							$get_admin = "select * from admins ";

   							$run_admin = mysqli_query($con,$get_admin);

   							while ($row_admin=mysqli_fetch_array($run_admin)) {

   								$admin_id = $row_admin['admin_id'];

   								$admin_name = $row_admin['admin_name'];

   								$admin_email = $row_admin['admin_email'];

   								$admin_image = $row_admin['admin_image'];

   								$admin_country = $row_admin['admin_country'];

   								$admin_job = $row_admin['admin_job'];


   						 ?>

   						 <tr>
   							<td><?php echo "$admin_name"; ?></td>
                        <td><?php echo "$admin_email"; ?></td>
                        <td><img src="admin_images/<?php echo $admin_image; ?>" width="60" height="60"></td>
                        <td><?php echo "$admin_country"; ?></td>
                        <td><?php echo "$admin_job"; ?></td>

   							<td>
   								<a href="index.php?user_delete=<?php echo $admin_id; ?>">
   									<i class="fa fa-trash-o"></i> Delete
   								</a>
   							</td>

   						</tr>

   						 <?php } ?>

   					</tbody>
   				</table> <!-- table table-bordered table-hover table-striped end-->

   			</div><!-- table-responsive end-->

   		</div><!-- panel-body end-->

   	</div><!-- panel panel-default end-->

   </div><!-- col-lg-12 end-->

</div><!--2 row end-->


<?php } ?>

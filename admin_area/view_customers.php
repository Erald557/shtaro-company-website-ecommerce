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
				<i class="fa fa-dashboard"></i>Dashboard / View Customers
			</li>
		</ol><!-- breadcrumb start-->
	</div><!-- col-lg-12 end-->

</div><!-- row end-->

<div class="row"><!--2 row start-->
   <div class="col-lg-12"><!-- col-lg-12 start-->

   	<div class="panel panel-default"><!-- panel panel-default start-->
   		<div class="panel-heading"><!-- panel-heading start-->

   			<h3 class="panel-title"><!-- panel-title start-->
   				<i class="fa fa-money fa-fw"></i> View Customers
   			</h3><!-- panel-title end-->
   		</div><!-- panel-heading end-->

   		<div class="panel-body"><!-- panel-body start-->
   			<div class="table-responsive"><!-- table-responsive start-->
   				<table class="table table-bordered table-hover table-striped"><!-- table table-bordered table-hover table-striped start-->

   					<thead>
   						<tr>
   							<th>Customer No:</th>
   							<th>Customer Name:</th>
   							<th>Customer Email:</th>
   							<th>Customer Image:</th>
   							<th>Customer Country:</th>
   							<th>Customer City:</th>
   							<th>Customer Phone Number:</th>
   							<th>Customer Delete:</th>
   						</tr>
   					</thead>
   					<tbody>
   						<?php

   							$i = 0;

   							$get_c= "select * from customers ";

   							$run_c = mysqli_query($con,$get_c);

   							while ($row_c=mysqli_fetch_array($run_c)) {

   								$c_id = $row_c['customer_id'];

   								$c_name = $row_c['customer_name'];

   								$c_email = $row_c['customer_email'];

   								$c_image = $row_c['customer_image'];

   								$c_country = $row_c['customer_country'];

   								$c_city = $row_c['customer_city'];

                           $c_contact = $row_c['customer_contact'];

   								$i++;

   						 ?>

   						 <tr>
   							<td><?php echo "$i"; ?></td>
   							<td><?php echo "$c_name"; ?></td>
                        <td><?php echo "$c_email"; ?></td>
   							<td><img src="../customer/customer_images/<?php echo "$c_image"; ?>" width="60" height="60"></td>
                        <td><?php echo "$c_country"; ?></td>
                        <td><?php echo "$c_city"; ?></td>
                        <td><?php echo "$c_contact"; ?></td>
   							<td>
                           <a href="index.php?customer_delete=<?php echo $c_id; ?>">
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

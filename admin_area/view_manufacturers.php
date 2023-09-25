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
				<i class="fa fa-dashboard"></i>Dashboard / View Manufacturers
			</li>
		</ol><!-- breadcrumb start-->
	</div><!-- col-lg-12 end-->
	
</div><!-- row end-->

<div class="row"><!--2 row start-->
   <div class="col-lg-12"><!-- col-lg-12 start-->

   	<div class="panel panel-default"><!-- panel panel-default start-->
   		<div class="panel-heading"><!-- panel-heading start-->
   			
   			<h3 class="panel-title"><!-- panel-title start-->
   				<i class="fa fa-money fa-fw"></i> View Manufacturers
   			</h3><!-- panel-title end-->
   		</div><!-- panel-heading end-->

   		<div class="panel-body"><!-- panel-body start-->
   			<div class="table-responsive"><!-- table-responsive start-->
   				<table class="table table-bordered table-hover table-striped"><!-- table table-bordered table-hover table-striped start-->

   					<thead>
   						<tr>
   							<th>Manufacturer ID</th>
   							<th>Manufacturer Title</th>
   							<th>Manufacturer Delete</th>
   							<th>Manufacturer Edit</th>
   						</tr>
   					</thead>
   					<tbody>
   						<?php 

   							$i = 0;

   							$get_manufacturers = "select * from manufacturers ";

   							$run_manufacturers = mysqli_query($con,$get_manufacturers);

   							while ($row_manufacturers=mysqli_fetch_array($run_manufacturers)) {
   								
   								$manufacturer_id = $row_manufacturers['manufacturer_id'];

   								$manufacturer_title = $row_manufacturers['manufacturer_title'];

   								$i++;
   							
   						 ?>

   						 <tr>
   							<td><?php echo "$i"; ?></td>
   							<td><?php echo "$manufacturer_title"; ?></td>
   							
   							<td>
   								<a href="index.php?delete_manufacturer=<?php echo $manufacturer_id; ?>">
   									<i class="fa fa-trash-o"></i> Delete 
   								</a>
   							</td>

   							<td>
   								<a href="index.php?edit_manufacturer=<?php echo $manufacturer_id; ?>">
   									<i class="fa fa-pencil"></i> Edit 
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
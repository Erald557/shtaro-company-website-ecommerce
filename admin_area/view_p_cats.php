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
				<i class="fa fa-dashboard"></i> Dashboard / View Products Categories
			</li>
		</ol><!-- breadcrumb end-->
	</div><!-- col-lg-12 end-->
</div><!-- row end-->

<div class="row"><!-- 2 row start-->
	
	<div class="col-lg-12"><!-- col-lg-12 start-->
		
		<div class="panel panel-default"><!--panel panel-default start-->
			
			<div class="panel-heading"><!--panel-heading start-->
				<h3 class="panel-title"><!--panel-title start-->
					<i class="fa fa-money fa-fw"></i> View Products Categories
				</h3><!--panel-title end-->
			</div><!--panel-heading end-->

			<div class="panel-body"><!--panel-body start-->
				
				<div class="table-responsive"><!--table-responsive start-->
					
					<table class="table table-bordered table-hover table-striped"><!--table table-bordered table-hover table-striped start-->
						<thead><!--thead start-->
							<tr>
								<th>Product Category Id</th>
								<th>Product Category Title</th>
								<th>Delete Product Category</th>
								<th>Edit Product Category</th>
							</tr>
						</thead><!--thead end-->
						<tbody><!--tbody start-->
							<?php 

								$i=0;

								$get_p_cats = "select * from product_categories ";

								$run_p_cats = mysqli_query($con,$get_p_cats);

								while ($row_p_cats = mysqli_fetch_array($run_p_cats)) {
									
									$p_cat_id = $row_p_cats['p_cat_id'];

									$p_cat_title = $row_p_cats['p_cat_title'];

									$i++;
							
							 ?>
								
								<tr>
									<td> <?php echo "$i"; ?> </td>
									<td> <?php echo "$p_cat_title"; ?> </td>
									<td>
										<a href="index.php?delete_p_cat=<?php echo $p_cat_id;?>" >
											<i class="fa fa-trash-o"></i> Delete
										</a>
									</td>
									<td>
										<a href="index.php?edit_p_cat=<?php echo $p_cat_id;?>" >
											<i class="fa fa-pencil"></i> Edit
										</a>
									</td>
								</tr>

							<?php } ?>
						</tbody><!--tbody end-->
					</table><!--table table-bordered table-hover table-striped end-->
				</div><!--table-responsive end-->
			</div><!--panel-body end-->
		</div><!--panel panel-default end-->
	</div><!-- col-lg-12 end-->
</div><!-- 2 row end-->

<?php } ?>
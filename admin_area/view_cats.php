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
				<i class="fa fa-dashboard"></i> Dashboard / View Categories
			</li>
		</ol><!--bredacrumb end-->
	</div><!--col-lg-12 end-->
</div><!--row end-->

<div class="row"><!-- 2 row start-->
	
	<div class="col-lg-12"><!--col-lg-12 start-->
		
		<div class="panel panel-default"><!--panel panel-default start-->
			<div class="panel-heading"><!--panel-heading start-->
				<h3 class="panel-title">
					<i class="fa fa-money fa-fw"></i> View Categories 
				</h3>
			</div><!--panel-heading end-->

			<div class="panel-body"><!--panel-body start-->
				
				<div class="table-responsive"><!--table-responsive start-->
					<table class="table table-bordered table-hover table-striped"><!--table-bordered table-hover table-striped start-->
						<thead><!--thead start-->
							<tr>
								<th>Category ID:</th>
								<th>Category Title:</th>
								<th>Delete Category</th>
								<th>Edit Category</th>
							</tr>
						</thead><!--thead end-->
						<tbody><!--tbody start-->
							
							<?php 

								$i=0;

								$get_cats = "select * from categories ";

								$run_cats = mysqli_query($con,$get_cats);

								while ($row_cats = mysqli_fetch_array($run_cats)) {
									
									$cat_id = $row_cats['cat_id'];

									$cat_title = $row_cats['cat_title'];

									$i++;
								
							 ?>
								
								<tr>
									<td> <?php echo "$i"; ?></td>
									<td><?php echo "$cat_title"; ?></td>
									<td>
										<a href="index.php?delete_cat=<?php echo $cat_id;?>">
											<i class="fa fa-trash-o"></i> Delete
										</a>
									</td>
									<td>
										<a href="index.php?edit_cat=<?php echo $cat_id;?>">
											<i class="fa fa-pencil"></i> Edit
										</a>
									</td>
								</tr>
							 <?php } ?>
						</tbody><!--tbody end-->
					</table><!--table-bordered table-hover table-striped end-->
				</div><!--table-responsive end-->
			</div><!--panel-body end-->
		</div><!--panel panel-default end-->
	</div><!--col-lg-12 end-->
</div><!-- 2 row end-->

<?php } ?>
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
				<i class="fa fa-dashboard"></i> Dashboard / View Terms
			</li>
		</ol><!--bredacrumb end-->
	</div><!--col-lg-12 end-->
</div><!--row end-->

<div class="row"><!-- 2 row start-->
	
	<div class="col-lg-12"><!--col-lg-12 start-->
		
		<div class="panel panel-default"><!--panel panel-default start-->
			<div class="panel-heading"><!--panel-heading start-->
				<h3 class="panel-title">
					<i class="fa fa-money fa-fw"></i> View Terms 
				</h3>
			</div><!--panel-heading end-->

			<div class="panel-body"><!--panel-body start-->

				<?php 

					$get_terms = "select * from terms ";

					$run_terms = mysqli_query($con,$get_terms);

					while ($row_terms = mysqli_fetch_array($run_terms)) {
						
						$term_id = $row_terms['term_id'];

						$term_title = $row_terms['term_title'];

						$term_desc = substr($row_terms['term_desc'],0,400);

				 ?>
				

					 <div class="col-lg-4 col-md-4"><!--col-lg-4 col-md-4 start-->
					 	<div class="panel panel-primary"><!--panel panel-primary start-->

					 		<div class="panel-heading"><!--panel-heading start-->
					 			<h3 class="panel-title" align="center"><!--panel-title start-->
					 				<?php echo "$term_title"; ?>
					 			</h3><!--panel-title end-->
					 			
					 		</div><!--panel-heading end-->
					 		<div class="panel-body"><!--panel-body start-->
					 			<?php echo "$term_desc"; ?>
					 		</div><!--panel-body end-->
					 		<div class="panel-footer"><!--panel-footer start-->
					 			<a href="index.php?delete_term=<?php echo $term_id;?>" class="pull-left">
									<i class="fa fa-trash-o"></i> Delete
								</a>
								<a href="index.php?edit_term=<?php echo $term_id;?>" class="pull-right">
									<i class="fa fa-pencil"></i> Edit
								</a>
								<div class="clearfix"></div>
					 		</div><!--panel-footer end-->
					 	</div><!--panel panel-primary end-->
					 </div><!--col-lg-4 col-md-4 end-->
		 		<?php } ?>
			</div><!--panel-body end-->
		</div><!--panel panel-default end-->
	</div><!--col-lg-12 end-->
</div><!-- 2 row end-->

<?php } ?>
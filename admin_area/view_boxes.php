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
				<i class="fa fa-dashboard"></i> Dashboard / View Boxes
			</li>
		</ol><!--bredacrumb end-->
	</div><!--col-lg-12 end-->
</div><!--row end-->

<div class="row"><!-- 2 row start-->
	
	<div class="col-lg-12"><!--col-lg-12 start-->
		
		<div class="panel panel-default"><!--panel panel-default start-->
			<div class="panel-heading"><!--panel-heading start-->
				<h3 class="panel-title">
					<i class="fa fa-money fa-fw"></i> View Boxes 
				</h3>
			</div><!--panel-heading end-->

			<div class="panel-body"><!--panel-body start-->

				<?php 

					$get_boxes = "select * from boxes_section ";

					$run_boxes = mysqli_query($con,$get_boxes);

					while ($row_boxes = mysqli_fetch_array($run_boxes)) {
						
						$box_id = $row_boxes['box_id'];

						$box_title = $row_boxes['box_title'];

						$box_desc = $row_boxes['box_desc'];

				 ?>
				

					 <div class="col-lg-4 col-md-4"><!--col-lg-4 col-md-4 start-->
					 	<div class="panel panel-primary"><!--panel panel-primary start-->

					 		<div class="panel-heading"><!--panel-heading start-->
					 			<h3 class="panel-title" align="center"><!--panel-title start-->
					 				<?php echo "$box_title"; ?>
					 			</h3><!--panel-title end-->
					 			
					 		</div><!--panel-heading end-->
					 		<div class="panel-body"><!--panel-body start-->
					 			<?php echo "$box_desc"; ?>
					 		</div><!--panel-body end-->
					 		<div class="panel-footer"><!--panel-footer start-->
					 			<a href="index.php?delete_box=<?php echo $box_id;?>" class="pull-left">
									<i class="fa fa-trash-o"></i> Delete
								</a>
								<a href="index.php?edit_box=<?php echo $box_id;?>" class="pull-right">
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
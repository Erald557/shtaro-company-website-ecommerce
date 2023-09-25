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
				<i class="fa fa-dashboard"></i> Dashboard / View Slides
			</li>
		</ol><!--bredacrumb end-->
	</div><!--col-lg-12 end-->
</div><!--row end-->

<div class="row"><!-- 2 row start-->
	
	<div class="col-lg-12"><!--col-lg-12 start-->
		
		<div class="panel panel-default"><!--panel panel-default start-->
			<div class="panel-heading"><!--panel-heading start-->
				<h3 class="panel-title">
					<i class="fa fa-money fa-fw"></i> View Slides
				</h3>
			</div><!--panel-heading end-->

			<div class="panel-body"><!--panel-body start-->

				<?php 

					$get_slides = "select * from slider ";

					$run_slides = mysqli_query($con,$get_slides);

					while ($row_slides = mysqli_fetch_array($run_slides)) {
						
						$slide_id = $row_slides['slide_id'];

						$slide_name = $row_slides['slide_name'];

						$slide_image = $row_slides['slide_image'];

					
				 ?>

				 <div class="col-md-3"><!--col-md-3 start-->

				 	<div class="panel panel-primary"><!--panel panel-primary start-->
				 		
				 		<div class="panel-heading"><!--panel-heading start-->
				 			<h3 class="panel-title" align="center">
				 				<?php echo "$slide_name"; ?>
				 			</h3>
				 		</div><!--panel-heading end-->

				 		<div class="panel-body"><!--panel-body start-->
				 			<img src="slides_images/<?php echo $slide_image; ?>" class="img-responsive">
				 		</div><!--panel-body end-->

				 		<div class="panel-footer"><!--panel-footer start-->
				 			<center><!--center start-->
				 				<a href="index.php?delete_slide=<?php echo $slide_id;?>" class="pull-left">
				 					<i class="fa fa-trash-o"></i> Delete
				 				</a>
				 				<a href="index.php?edit_slide=<?php echo $slide_id;?>" class="pull-right">
				 					<i class="fa fa-trash-o"></i> Edit
				 				</a>

				 				<div class="clearfix">
				 					
				 				</div>
				 			</center><!--center end-->
				 		</div><!--panel-footer end-->
				 	</div><!--panel panel-primary end-->
				 </div><!--col-md-3 end-->

				 <?php } ?>
					
			</div><!--panel-body end-->
		</div><!--panel panel-default end-->
	</div><!--col-lg-12 end-->
</div><!-- 2 row end-->

<?php } ?>
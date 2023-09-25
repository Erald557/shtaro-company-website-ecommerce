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
				<i class="fa fa-dashboard"></i> Dashboard / Insert Box
			</li>
		</ol><!--bredacrumb end-->
	</div><!--col-lg-12 end-->
</div><!--row end-->

<div class="row"><!-- 2 row start-->
	
	<div class="col-lg-12"><!--col-lg-12 start-->
		
		<div class="panel panel-default"><!--panel panel-default start-->
			
			<div class="panel-heading"><!--panel-heading start-->
				<h3 class="panel-title"><!--panel-title start-->
					<i class="fa fa-money fa-fw"></i> Insert Box
				</h3><!--panel-title end-->
			</div><!--panel-heading end-->

			<div class="panel-body"><!--panel-body start-->
				
				<form class="form-horizontal" action="" method="post"><!--form-horizontal start-->
					
				   <div class="form-group"><!--form-group start--> 
				   	 <label class="col-md-3 control-label">Box Title:</label>

				   	 <div class="col-md-6">
				   	 	<input type="text" name="box_title" class="form-control
				   	 	">
				   	 </div>
				   </div><!--form-group end-->

				   <div class="form-group"><!--form-group start-->
				   	 <label class="col-md-3 control-label">Box Description</label>

				   	 <div class="col-md-6">
						<textarea type="text" name="box_desc" class="form-control" rows="6" cols="19"></textarea>
				   	 </div>
				   </div><!--form-group end-->

				   <div class="form-group"><!--form-group start-->
				   	 <label class="col-md-3 control-label"></label>

				   	 <div class="col-md-6">
				   	 	<input type="submit" name="submit" value="Insert Box" class="btn btn-primary form-control">
				   	 </div>
				   </div><!--form-group end-->
				</form><!--form-horizontal end-->
			</div><!--panel-body end-->
		</div><!--panel panel-default end-->
	</div><!--col-lg-12 end-->
</div><!-- 2 row end-->

<?php 

	if (isset($_POST['submit'])) {
		
		$box_title = $_POST['box_title'];

		$box_desc = $_POST['box_desc'];

		$insert_box = "insert into boxes_section (box_title,box_desc) values ('$box_title','$box_desc') ";

		$run_box = mysqli_query($con,$insert_box);

		if ($run_box) {
			
			echo "<script>alert('New Box Has Been Inserted') </script>";
			echo "<script>window.open('index.php?view_boxes','_self') </script>";
		}
	}

 ?>

<?php } ?>
<?php 

if (!isset($_SESSION['admin_email'])) {
	
	echo "<script>window.open('login.php','_self') </script>";
}

else {


?>

<?php 

	if (isset($_GET['edit_box'])) {
		
		$edit_box = $_GET['edit_box'];

		$get_boxes = "select * from boxes_section where box_id='$edit_box' ";

		$run_boxes = mysqli_query($con,$get_boxes);

		$row_boxes = mysqli_fetch_array($run_boxes);

		$box_id = $row_boxes['box_id'];

		$box_title = $row_boxes['box_title'];

		$box_desc = $row_boxes['box_desc'];
	}

 ?>

<div class="row"><!--row start-->
	
	<div class="col-lg-12"><!--col-lg-12 start-->
		
		<ol class="breadcrumb"><!--bredacrumb start-->
			<li>
				<i class="fa fa-dashboard"></i> Dashboard / Edit Box
			</li>
		</ol><!--bredacrumb end-->
	</div><!--col-lg-12 end-->
</div><!--row end-->

<div class="row"><!-- 2 row start-->
	
	<div class="col-lg-12"><!--col-lg-12 start-->
		
		<div class="panel panel-default"><!--panel panel-default start-->
			
			<div class="panel-heading"><!--panel-heading start-->
				<h3 class="panel-title"><!--panel-title start-->
					<i class="fa fa-money fa-fw"></i> Edit Box
				</h3><!--panel-title end-->
			</div><!--panel-heading end-->

			<div class="panel-body"><!--panel-body start-->
				
				<form class="form-horizontal" action="" method="post"><!--form-horizontal start-->
					
				   <div class="form-group"><!--form-group start--> 
				   	 <label class="col-md-3 control-label">Box Title:</label>

				   	 <div class="col-md-6">
				   	 	<input type="text" name="box_title" class="form-control
				   	 	" value="<?php echo $box_title;?>">
				   	 </div>
				   </div><!--form-group end-->

				   <div class="form-group"><!--form-group start-->
				   	 <label class="col-md-3 control-label">Box Description</label>

				   	 <div class="col-md-6">
						<textarea type="text" name="box_desc" class="form-control" rows="6" cols="19"> <?php echo $box_desc;?></textarea>
				   	 </div>
				   </div><!--form-group end-->

				   <div class="form-group"><!--form-group start-->
				   	 <label class="col-md-3 control-label"></label>

				   	 <div class="col-md-6">
				   	 	<input type="submit" name="update" value="Update Box" class="btn btn-primary form-control">
				   	 </div>
				   </div><!--form-group end-->
				</form><!--form-horizontal end-->
			</div><!--panel-body end-->
		</div><!--panel panel-default end-->
	</div><!--col-lg-12 end-->
</div><!-- 2 row end-->

<?php 

	if (isset($_POST['update'])) {
		
		$box_title = $_POST['box_title'];

		$box_desc = $_POST['box_desc'];

		$update_box = "update boxes_section set box_title='$box_title', box_desc='$box_desc' where box_id='$box_id' ";

		$run_box = mysqli_query($con,$update_box);

		if ($run_box) {
			
			echo "<script>alert('Box Has Been Updated') </script>";
			echo "<script>window.open('index.php?view_boxes','_self') </script>";
		}
	}

 ?>

<?php } ?>
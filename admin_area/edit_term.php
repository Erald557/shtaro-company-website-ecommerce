<?php 

if (!isset($_SESSION['admin_email'])) {
	
	echo "<script>window.open('login.php','_self') </script>";
}

else {


?>

<?php 

	if (isset($_GET['edit_term'])) {
		
		$edit_id = $_GET['edit_term'];

		$get_term = "select * from terms where term_id='$edit_id' ";

		$run_term = mysqli_query($con,$get_term);

		$row_term = mysqli_fetch_array($run_term);

		$term_id = $row_term['term_id'];

		$term_title = $row_term['term_title'];

		$term_link = $row_term['term_link'];

		$term_desc = $row_term['term_desc'];
	}

 ?>

<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>

<div class="row"><!--row start-->
	
	<div class="col-lg-12"><!--col-lg-12 start-->
		
		<ol class="breadcrumb"><!--bredacrumb start-->
			<li>
				<i class="fa fa-dashboard"></i> Dashboard / Edit Terms
			</li>
		</ol><!--bredacrumb end-->
	</div><!--col-lg-12 end-->
</div><!--row end-->

<div class="row"><!-- 2 row start-->
	
	<div class="col-lg-12"><!--col-lg-12 start-->
		
		<div class="panel panel-default"><!--panel panel-default start-->
			
			<div class="panel-heading"><!--panel-heading start-->
				<h3 class="panel-title"><!--panel-title start-->
					<i class="fa fa-money fa-fw"></i> Edit Terms
				</h3><!--panel-title end-->
			</div><!--panel-heading end-->

			<div class="panel-body"><!--panel-body start-->
				
				<form class="form-horizontal" action="" method="post"><!--form-horizontal start-->
					
				   <div class="form-group"><!--form-group start--> 
				   	 <label class="col-md-3 control-label">Term Title</label>

				   	 <div class="col-md-6">
				   	 	<input type="text" name="term_title" class="form-control
				   	 	" value="<?php echo $term_title;?>">
				   	 </div>
				   </div><!--form-group end-->

				   <div class="form-group"><!--form-group start-->
				   	 <label class="col-md-3 control-label">Term Description</label>

				   	 <div class="col-md-6">
						<textarea type="text" name="term_desc" class="form-control" rows="6" cols="19"><?php echo $term_desc;?></textarea>
				   	 </div>
				   </div><!--form-group end-->

				   <div class="form-group"><!--form-group start--> 
				   	 <label class="col-md-3 control-label">Term Link</label>

				   	 <div class="col-md-6">
				   	 	<input type="text" name="term_link" class="form-control
				   	 	" value="<?php echo $term_link;?>">
				   	 </div>
				   </div><!--form-group end-->

				   <div class="form-group"><!--form-group start-->
				   	 <label class="col-md-3 control-label"></label>

				   	 <div class="col-md-6">
				   	 	<input type="submit" name="update" value="Update Term" class="btn btn-primary form-control">
				   	 </div>
				   </div><!--form-group end-->
				</form><!--form-horizontal end-->
			</div><!--panel-body end-->
		</div><!--panel panel-default end-->
	</div><!--col-lg-12 end-->
</div><!-- 2 row end-->

<?php 

	if (isset($_POST['update'])) {
		
		$term_title = $_POST['term_title'];

		$term_desc = $_POST['term_desc'];

		$term_link = $_POST['term_link'];

		$update_term = "update terms set term_title='$term_title', term_link='$term_link', term_desc='$term_desc' where term_id='$term_id' ";

		$run_term = mysqli_query($con,$update_term);

		if ($run_term) {
			
			echo "<script>alert('Term Has Been Updated') </script>";
			echo "<script>window.open('index.php?view_terms','_self') </script>";
		}
	}

 ?>

<?php } ?>
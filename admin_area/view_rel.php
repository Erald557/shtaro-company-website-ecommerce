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
				<i class="fa fa-dashboard"></i> Dashboard / View Relations
			</li>
		</ol><!--bredacrumb end-->
	</div><!--col-lg-12 end-->
</div><!--row end-->

<div class="row"><!-- 2 row start-->

	<div class="col-lg-12"><!--col-lg-12 start-->

		<div class="panel panel-default"><!--panel panel-default start-->

			<div class="panel-heading"><!--panel-heading start-->
				<h3 class="panel-title"><!--panel-title start-->
					<i class="fa fa-money fa-fw"></i> View Relations
				</h3><!--panel-title end-->
			</div><!--panel-heading end-->

			<div class="panel-body"><!--panel-body start-->
			 <div class="table-responsive"><!--table-responsive start-->
			 	 <table class="table table-bordered table-hover table-striped"><!--table-bordered table-hover table-striped start-->
			 	 	<thead><!--thead start-->
			 	 		<th>Relation Id:</th>
						<th>Relation Title:</th>
						<th>Relation Product:</th>
						<th>Relation Bundle:</th>
						<th>Delete Relation:</th>
						<th>Edit Relation:</th>
			 	 	</thead><!--thead end-->
					<tbody><!--tbody start-->
						<?php
							$i = 0;
							$get_rel = "select * from bundle_product_relation ";
							$run_rel = mysqli_query($con,$get_rel);
							while ($row_rel = mysqli_fetch_array($run_rel)) {
								$rel_id =$row_rel['rel_id'];
								$rel_title =$row_rel['rel_title'];
								$bundle_id =$row_rel['bundle_id'];
								$product_id =$row_rel['product_id'];
								$get_p = "select * from products where product_id='$product_id' ";
								$run_p = mysqli_query($con,$get_p);
								$row_p = mysqli_fetch_array($run_p);
								$p_title = $row_p['product_title'];

								$get_b = "select * from products where product_id='$bundle_id' ";
								$run_b = mysqli_query($con,$get_b);
								$row_b = mysqli_fetch_array($run_b);
								$b_title = $row_b['product_title'];
								$i++;
						 ?>
						 <tr>
						 	<td><?php echo $i; ?></td>
							<td><?php echo $rel_title; ?></td>
							<td><?php echo $p_title; ?></td>
							<td><?php echo $b_title; ?></td>
							<td>
								<a href="index.php?delete_rel=<?php echo $rel_id; ?>">
									<i class="fa fa-trash-o"></i>Delete
								</a>
							</td>
							<td>
								<a href="index.php?edit_rel=<?php echo $rel_id; ?>">
									<i class="fa fa-pencil"></i>Edit
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

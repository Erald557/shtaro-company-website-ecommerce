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
				<i class="fa fa-dashboard"></i>Dashboard / View Bundles
			</li>
		</ol><!-- breadcrumb start-->
	</div><!-- col-lg-12 end-->

</div><!-- row end-->

<div class="row"><!--2 row start-->
   <div class="col-lg-12"><!-- col-lg-12 start-->

   	<div class="panel panel-default"><!-- panel panel-default start-->
   		<div class="panel-heading"><!-- panel-heading start-->

   			<h3 class="panel-title"><!-- panel-title start-->
   				<i class="fa fa-money fa-fw"></i> View Bundles
   			</h3><!-- panel-title end-->
   		</div><!-- panel-heading end-->

   		<div class="panel-body"><!-- panel-body start-->
   			<div class="table-responsive"><!-- table-responsive start-->
   				<table class="table table-bordered table-hover table-striped"><!-- table table-bordered table-hover table-striped start-->

   					<thead>
   						<tr>
   							<th>Bundle ID</th>
   							<th>Bundle Title</th>
                <th>Bundle Code</th>
   							<th>Bundle Image</th>
   							<th>Bundle Price</th>
   							<th>Bundle Sold</th>
   							<th>Bundle Keywords</th>
   							<th>Bundle Date</th>
   							<th>Bundle Delete</th>
   							<th>Bundle Edit</th>
   						</tr>
   					</thead>
   					<tbody>
   						<?php

   							$i = 0;

   							$get_pro = "select * from products where status='bundle' ";

   							$run_pro = mysqli_query($con,$get_pro);

   							while ($row_pro=mysqli_fetch_array($run_pro)) {

   								$pro_id = $row_pro['product_id'];

   								$pro_title = $row_pro['product_title'];

                  $pro_code = $row_pro['product_code'];

   								$pro_image = $row_pro['product_img1'];

   								$pro_price = $row_pro['product_price'];

   								$pro_keywords = $row_pro['product_keywords'];

   								$pro_date = $row_pro['date'];

   								$i++;

   						 ?>

   						 <tr>
   							<td><?php echo "$i"; ?></td>
   							<td><?php echo "$pro_title"; ?></td>
                <td><?php echo "$pro_code"; ?></td>
   							<td><img src="product_images/<?php echo "$pro_image"; ?>" width="60" height="60"></td>
   							<td> <?php echo "$pro_price"; ?> Lekë</td>
   							<td>
                <?php
                $order_sold = 0;
                $select_order_items = "select * from orders_items where product_id='$pro_id'";
                $run_order_items = mysqli_query($con,$select_order_items);
                while ($row_order_items = mysqli_fetch_array($run_order_items)) {
                  $qty = $row_order_items["qty"];
                  $order_sold += $qty;
                }

                echo $order_sold;

   							 ?>

   							 </td>

   							<td><?php echo "$pro_keywords"; ?></td>

   							<td><?php echo "$pro_date"; ?></td>

   							<td>
   								<a href="index.php?delete_bundle=<?php echo $pro_id; ?>">
   									<i class="fa fa-trash-o"></i> Delete
   								</a>
   							</td>

   							<td>
   								<a href="index.php?edit_bundle=<?php echo $pro_id; ?>">
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

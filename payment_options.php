<div class="box"><!-- box starts-->

	<?php

     $session_email = $_SESSION['customer_email'];

     $select_customer = "select * from customers where customer_email='$session_email'";

     $run_customer = mysqli_query($con,$select_customer);

     $row_customer = mysqli_fetch_array($run_customer);

     $customer_id = $row_customer['customer_id'];
	?>
	<div class="box-header">
	<h1 class="lead text-center"> Mënyrat e Pagesës</h1>
	</div>
	<p class="lead text-center">
		<a href="order.php?c_id=<?php echo $customer_id; ?>"> Paguaj Offline</a>

	</p>
<hr />
	<center><!-- center starts-->
	<form class="" action="https://www.paypal.com/cgi-bin/webscr" method="post"><!-- form start-->
		<input type="hidden" name="business" value="elektroitaliashtaro@gmail.com">
		<input type="hidden" name="cmd" value="_cart">
		<input type="hidden" name="upload" value="1">
		<input type="hidden" name="currency_code" value="ALL">
		<input type="hidden" name="return" value="http://shtaro.com/paypal_order.php?c_id=<?php $customer_id; ?>">
		<input type="hidden" name="cancel_return" value="http://shtaro.com/index.php">
		<?php
		$i = 0;
		$ip_add = getRealUserIp();
		$get_cart = "select * from cart where ip_add='$ip_add'";
		$run_cart = mysqli_query($con, $get_cart);
		while ($row_cart = mysqli_fetch_array($run_cart)) {
			$pro_id = $row_cart['p_id'];
			$pro_qty = $row_cart['qty'];
			$pro_price = $row_cart['p_price'];
			$get_products = "select * from products where product_id='$pro_id'";
			$run_products = mysqli_query($con, $get_products);
			$row_products = mysqli_fetch_array($run_products);
			$product_title = $row_products['product_title'];
			$i++;

		 ?>

		 <input type="hidden" name="item_name_<?php echo $i; ?>" value="<?php echo $product_title; ?>">
		 <input type="hidden" name="item_number_<?php echo $i; ?>" value="<?php echo $i; ?>">
		 <input type="hidden" name="item_amount_<?php echo $i; ?>" value="<?php echo $pro_price; ?>">
		 <input type="hidden" name="item_quantity_<?php echo $i; ?>" value="<?php echo $pro_qty; ?>">

		 <?php } ?>

		 <input type="image" name="submit" width="300" height="150" src="images/paypal.png">

	</form><!-- form end-->

	</center><!-- center ends-->

</div><!-- box ends-->

<?php

session_start();

include("includes/db.php");

include("functions/functions.php");

if (!isset($_SESSION["customer_email"])) {
echo "<script>window.open('checkout.php','_self');</script>";
}

if (!isset($_GET["order_id"])) {
echo "<script>window.open('checkout.php','_self');</script>";
}
?>

<!DOCTYPE html>
<html>

<head>
<?php
	include("includes/head.php")
	?>
<script src="js/jquery.min.js"></script>
</head>



<body>


	<div id="top"> <!-- starts top-->


		<div class="container"><!-- starts container-->

			<div class="col-md-6 offer"><!-- starts col-md-6 oferr-->

				<a href="#" class="btn-sm">
					<?php

					if (!isset($_SESSION['customer_email'])) {

						echo "<em>Mirëserdhe!</em> <span>|</span>";
					}
					else {
						echo "<em>Mirëserdhe</em>  "  .  $_SESSION['customer_email'] . " <span>|</span> ";
					}
					?>
				</a>
				<a href="#">
					Shporta Totali: <?php total_price()?> Lekë
				</a>


			</div><!-- ends col-md-6 oferr-->

			<div class="col-md-6"><!-- starts col-md-6 -->

				<ul class="menu"> <!-- starts menu -->
					<li>
						<a href="customer_register.php">
							Regjistrohu
						</a>
					</li>
					<li>
						<?php

               if (!isset($_SESSION['customer_email'])) {
               	echo "<a href='checkout.php'> Llogaria Ime</a>";
               }
               else{
               	echo "<a href='customer/my_account.php?my_orders'> Llogaria Ime </a>";
               }
						?>
					</li>
					<li>
						<a href="cart.php">
							Shko tek Shporta
						</a>
					</li>
					<li>
						<?php

               if (!isset($_SESSION['customer_email'])) {

               	 echo "<a href='checkout.php'> Login </a>";
               }
               else{

               	echo "<a href='logout.php'> Logout </a>";
               }
						?>
					</li>

				</ul><!-- ends menu -->

			</div><!-- ends col-md-6 -->

	    </div><!-- ends container-->

	</div><!-- ends top-->


<div class="navbar navbar-default" id="navbar"><!-- navbar navbar-default starts-->

	<div class="container"><!-- container starts-->
		<?php
		include("includes/navbar-menu.php")
		 ?>
	</div><!-- container ends-->

</div><!-- navbar navbar-default ends-->


<div id="content" class="container"><!-- content starts-->

	   <div class="container"><!-- container starts-->

			<div class="col-md-12"><!-- col-md-12 starts-->

        <ul class="breadcrumb"><!-- breadcrumb starts-->

					<li>
						<a href="index.php">Kryefaqja</a>
					</li>

					<li>
						Porosia u Krye
					</li>

				</ul><!-- breadcrumb ends-->

        <nav class="checkout-breadcrumbs text-center">
  				<a href="cart.php"> Shporta e Blerjeve</a>
  				<i class="fa fa-chevron-right"></i>
  				<a href="checkout.php"> Detajet e Blerjes</a>
  				<i class="fa fa-chevron-right"></i>
  				<a href="#" class="active"> Porosia u Krye</a>
  			</nav>
			</div><!-- col-md-12 ends-->

    <div class="col-md-8"><!-- col-md-8 start-->
      <?php if (isset($_GET["order_id"])) {
        $customer_email = $_SESSION['customer_email'];
        $get_customer = "select * from customers where customer_email='$customer_email'";
        $run_customer = mysqli_query($con, $get_customer);
        $row_customer = mysqli_fetch_array($run_customer);
        $customer_id = $row_customer['customer_id'];
        $customer_contact = $row_customer['customer_contact'];
        $order_id = $_GET["order_id"];
        $select_order = "select * from orders where order_id='$order_id' and
        customer_id='$customer_id'";
        $run_order = mysqli_query($con,$select_order);
        $row_order = mysqli_fetch_array($run_order);
        $invoice_no = $row_order["invoice_no"];
        $shipping_type = $row_order["shipping_type"];
        $shipping_cost = $row_order["shipping_cost"];
        $payment_method = $row_order["payment_method"];
        $order_date = $row_order["order_date"];
        $order_total = $row_order["order_total"];
        $order_status = $row_order["order_status"];
        $select_order_addresses = "select * from orders_addresses where order_id='$order_id'";
        $run_order_addresses = mysqli_query($con,$select_order_addresses);
        $row_order_addresses = mysqli_fetch_array($run_order_addresses);
        $billing_first_name = $row_order_addresses["billing_first_name"];
        $billing_last_name = $row_order_addresses["billing_last_name"];
        $billing_country = $row_order_addresses["billing_country"];
        $billing_address_1 = $row_order_addresses["billing_address_1"];
        $billing_address_2 = $row_order_addresses["billing_address_2"];
        $billing_state = $row_order_addresses["billing_state"];
        $billing_city = $row_order_addresses["billing_city"];
        $billing_postcode = $row_order_addresses["billing_postcode"];

        //Shipping details start
        $is_shipping_address_same = $row_order_addresses["is_shipping_address_same"];
        $shipping_first_name = $row_order_addresses["shipping_first_name"];
        $shipping_last_name = $row_order_addresses["shipping_last_name"];
        $shipping_country = $row_order_addresses["shipping_country"];
        $shipping_address_1 = $row_order_addresses["shipping_address_1"];
        $shipping_address_2 = $row_order_addresses["shipping_address_2"];
        $shipping_state = $row_order_addresses["shipping_state"];
        $shipping_city = $row_order_addresses["shipping_city"];
        $shipping_postcode = $row_order_addresses["shipping_postcode"];
      } ?>

      <div class="box" id="order-summary"><!--box order-summary start-->
        <h3>Detajet e Porosisë</h3>
        <table class="table"><!--table start-->
          <thead>
            <tr>
              <th class="text-muted lead">Produkti </th>
              <th class="text-muted lead">Totali  </th>
            </tr>
          </thead>
          <tbody>
            <?php
            $items_subtotal = 0;
            $select_order_items = "select * from orders_items where order_id='$order_id'";
            $run_order_items = mysqli_query($con, $select_order_items);
            while ($row_order_items = mysqli_fetch_array($run_order_items)) {
            $product_id = $row_order_items["product_id"];
            $product_qty = $row_order_items["qty"];
            $product_price = $row_order_items["price"];
            $sub_total = $product_price * $product_qty;
            $select_product = "select * from products where product_id='$product_id'";
            $run_product = mysqli_query($con,$select_product);
            $row_product = mysqli_fetch_array($run_product);
            $product_title  = $row_product["product_title"];

            $items_subtotal += $sub_total;

             ?>
             <tr>
               <td>
                 <a href="#" class="bold"> <?php echo $product_title; ?> </a>
                 <i class="fa fa-times" title="Sasia e Produktit"></i> <?php echo $product_qty; ?>
               </td>
               <th> <?php echo $sub_total; ?> Lekë</th>
             </tr>
             <?php } ?>

             <tr>
               <th class="text-muted"> Nëntotali :</th>
               <th><?php echo $items_subtotal; ?> Lekë</th>
             </tr>

             <tr>
               <th class="text-muted"> Transporti :</th>
               <th>
                 <span class="text-muted">
                   <i class="fa fa-truck"></i> <?php echo $shipping_type; ?> :
                 </span>
                 <?php echo $shipping_cost; ?> Lekë
               </th>
             </tr>

             <tr class="total">
               <td> Totali :</td>
               <td> <?php echo $order_total; ?> Lekë </td>
             </tr>
          </tbody>
        </table><!--table end-->

        <h3> Detajet e Klientit</h3>
        <table class="table"><!--table start-->
          <tbody>
            <tr>
              <th class="text-muted"> Email :</th>
              <th> <?php echo $customer_email; ?> </th>
            </tr>
            <tr>
              <th class="text-muted"> Telefon :</th>
              <th> <?php echo $customer_contact; ?> </th>
            </tr>
          </tbody>
        </table><!--table end-->

        <div class="row"><!--row start-->
          <div class="col-sm-6"><!--col-sm-6 start-->
            <h4> Detajet e Faturimit</h4>
           <address class="text-muted" style="font-size:15px;">
             <?php echo $billing_first_name . " " . $billing_last_name; ?> <br />
             <?php echo $billing_address_1; ?> <br />
             <?php echo $billing_address_2; ?> <br />
             <?php echo $billing_city; ?> <br />
             <?php echo $billing_state; ?> <br />
             <?php echo $billing_postcode; ?> <br />
             <?php
             $select_country = "select * from countries where country_id='$billing_country'";
             $run_country = mysqli_query($con,$select_country);
             $row_country = mysqli_fetch_array($run_country);
             echo $country_name = $row_country["country_name"];
              ?> <br />
           </address>
          </div><!--col-sm-6 end-->

          <?php if ($is_shipping_address_same == "no") { ?>
          <div class="col-sm-6"><!--col-sm-6 start-->

            <h4> Detajet e Transportit</h4>
           <address class="text-muted" style="font-size:15px;">
             <?php echo $shipping_first_name . " " . $shipping_last_name; ?> <br />
             <?php echo $shipping_address_1; ?> <br />
             <?php echo $shipping_address_2; ?> <br />
             <?php echo $shipping_city; ?> <br />
             <?php echo $shipping_state; ?> <br />
             <?php echo $shipping_postcode; ?> <br />
             <?php
             $select_country = "select * from countries where country_id='$shipping_country'";
             $run_country = mysqli_query($con,$select_country);
             $row_country = mysqli_fetch_array($run_country);
             echo $country_name = $row_country["country_name"];
              ?> <br />
           </address>
          </div><!--col-sm-6 end-->
          <?php } ?>
        </div><!--row end-->
      </div><!--box order-summary end-->
    </div><!-- col-md-8 ends-->
    <div class="col-md-4"><!-- col-md-4 start-->
      <div class="box"><!-- box start-->
        <h4 class="text-success"> Faleminderit.<br /> Porosia juaj u kompletua.</h4>
        <ul class="order-received-list"><!-- order-received-list start-->
          <li> Numri Faturës/Porosisë : <strong>#<?php echo $invoice_no; ?></strong></li>
          <li> Data : <strong><?php echo $order_date; ?></strong></li>
          <li> Metoda Pagesës : <strong><?php echo ucwords($payment_method); ?></strong></li>
          <li> Totali : <strong><?php echo $order_total; ?> Lekë</strong></li>
          <li>
            Kliko këtu për tek
            <strong>
              <a href="customer/my_account.php?my_orders" class="text-muted"> Llogaria Ime </a>
            </strong>
          </li>
        </ul><!-- order-received-list end-->
      </div><!-- box end-->
    </div><!-- col-md-4 ends-->

  </div><!-- container ends-->

</div><!-- content ends-->

</div><!--container ends-->

<?php
 include("includes/footer.php")
?>

<script src="js/bootstrap.min.js"></script>
</body>


</html>

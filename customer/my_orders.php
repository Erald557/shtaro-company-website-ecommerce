
<center><!-- center starts-->

	<p class="lead"> Porositë e tua në një vend. </p>

	<p class="text-muted">
		Nëse keni ndonjë pyetje ,
		ju lutemi ndjehuni të lirë të <a href="../contact.php">na kontaktoni</a>,
		qëndra jonë e shërbimit të klientit punon për ju 12/6.
	</p>


</center><!-- center ends-->


<hr>

<div class="table-responsive"><!-- table-responsive starts-->

	<table class="table table-border table-hover"><!-- table table-border table-hover starts-->

		<thead> <!-- thead starts-->

			<tr>
				<th> Nr i Porosisë :</th>
        <th> Nr i Faturës :</th>
        <th> Data e Porosisë :</th>
        <th> Statusi i Porosisë :</th>
        <th> Totali i Porosisë</th>
        <th> Veprime :</th>
			</tr>

		</thead><!-- thead ends-->

		<tbody><!-- tbody starts-->
      <?php
      $customer_email = $_SESSION['customer_email'];
      $get_customer = "select * from customers where customer_email='$customer_email'";
      $run_customer = mysqli_query($con, $get_customer);
      $row_customer = mysqli_fetch_array($run_customer);
      $customer_id = $row_customer['customer_id'];
      $select_orders = "select * from orders where customer_id='$customer_id' order by 1 desc";
      $run_orders = mysqli_query($con,$select_orders);
      $i = 0;
      while ($row_orders = mysqli_fetch_array($run_orders)) {
        $i++;
        $order_id = $row_orders["order_id"];
        $invoice_no = $row_orders["invoice_no"];
        $order_total = $row_orders["order_total"];
        $order_date = $row_orders["order_date"];
        $order_status = $row_orders["order_status"];

       ?>
       <tr>
         <th> <?php echo $i; ?></th>
         <td> #<?php echo $invoice_no; ?></td>
         <td> <?php echo $order_date; ?></td>
         <td> <?php
         if ($order_status == "pending") {
           echo ucwords($order_status . " Payment");
         }else {
           echo ucwords($order_status);
         }
          ?></td>
          <td>
            <strong> <?php echo $order_total; ?> Lekë</strong>
            për
            <?php
            $total_items = 0;
            $select_order_items = "select * from orders_items where order_id='$order_id'";
            $run_order_items = mysqli_query($con,$select_order_items);
            while ($row_order_items = mysqli_fetch_array($run_order_items)) {
              $qty = $row_order_items["qty"];
              $total_items += $qty;
            }

            if ($total_items == 1) {
              echo $total_items . " artikull";
            }else {
              echo $total_items . " artikuj";
            }
             ?>
          </td>
          <td>
            <div class="dropdown"><!--dropdown start-->
              <button class="btn btn-success dropdown-toggle" data-toggle="dropdown">

                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu dropdown-menu-right">
                  <?php if ($order_status == "pending") { ?>
                  <li>
                    <a href="confirm.php?order_id=<?php echo $order_id; ?>" target="_blank" class="bg-danger">
                      Konfirmo Pagesën
                    </a>
                  </li>
                  <?php } ?>
                  <li>
                    <a href="view_order.php?order_id=<?php echo $order_id; ?>" target="_blank"> Shiko</a>
                  </li>
                </ul>
              </div>
            </div><!--dropdown end-->
          </td>
       </tr>
      <?php } ?>
		</tbody><!-- tbody ends-->


	</table><!-- table table-border table-hover ends-->

</div><!--table-responsive ends-->

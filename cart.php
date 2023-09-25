
<?php

session_start();

include("includes/db.php");

include("functions/functions.php");
?>

<!DOCTYPE html>
<html>

<head>

<?php
	include("includes/head.php")
	?>
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
					Shporta Totali: <span class="subtotal-cart-price"> <?php total_price();?> Lekë</span>
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


<div id="content"><!-- content starts-->

	<div class="container-fluid"><!-- container starts-->

		<div class="col-md-12"><!-- col-md-12 starts-->

			<ul class="breadcrumb"><!-- breadcrumb starts-->

				<li>
					<a href="index.php">Kryefaqja</a>
				</li>

				<li>
					Shporta
				</li>

			</ul><!-- breadcrumb ends-->

			<nav class="checkout-breadcrumbs text-center">
				<a href="cart.php" class="active"> Shporta e Blerjeve</a>
				<i class="fa fa-chevron-right"></i>
				<a href="checkout.php"> Detajet e Blerjes</a>
				<i class="fa fa-chevron-right"></i>
				<a href="#"> Porosia u Krye</a>
			</nav>

		</div><!-- col-md-12 ends-->

		<div class="col-md-9" id="cart"><!-- col-md-9 starts-->

			<div class="box"><!-- box starts-->

				<form action="cart.php" method="post" enctype="multipart-form-data"><!-- form starts-->

					<h1> Shporta e Blerjeve</h1>

					<?php

            $ip_add = getRealUserIp();

            $select_cart = "select * from cart where ip_add='$ip_add'";

            $run_cart = mysqli_query($con, $select_cart);

            $count = mysqli_num_rows($run_cart);

					?>

					<p class="text-muted"> Ju aktualisht keni <?php echo items();?> produkte në shportë</p>

					<div class="table-responsive"><!-- table-responsive starts-->

						<table class="table"><!-- table starts-->

							<thead><!-- thead starts-->

								<tr>
									<th colspan="2"> Produkte</th>
									<th>Kodi</th>
									<th> Sasia </th>
									<th> Çmimi/Copë </th>
									<th colspan="1"> Fshi</th>
								    <th colspan="2"> Nëntotali</th>

								</tr>

               </thead><!-- thead ends-->

               <tbody id="cart-products-tbody"><!-- tbody starts-->

               	<?php

                   $total = 0;

                   $total_weight = 0;

                   while ($row_cart = mysqli_fetch_array($run_cart)) {

                   $pro_id = $row_cart ['p_id'];

                   $pro_qty = $row_cart ['qty'];

                   $only_price = $row_cart['p_price'];

                   $get_products = "select * from products where product_id='$pro_id'";

                   $run_products = mysqli_query($con, $get_products);

                   while ($row_products = mysqli_fetch_array($run_products)) {

                   	$product_title = $row_products['product_title'];

                   	$product_code = $row_products['product_code'];

                   	$product_img1 = $row_products['product_img1'];

                   	$product_weight = $row_products['product_weight'];

                    $product_url = $row_products['product_url'];

                    $sub_total_weight = $product_weight * $pro_qty;

                    $total_weight += $sub_total_weight;

                   	$sub_total = (int)$only_price * (int)$pro_qty;

                   	$_SESSION['pro_qty'] = (int)$pro_qty;

                   	$total += (int)$sub_total;


                    $select_product_stock = "select * from products_stock where product_id='$pro_id'";

                    $run_product_stock = mysqli_query($con, $select_product_stock);

                    $row_product_stock = mysqli_fetch_array($run_product_stock);

                    $count_product_stock = mysqli_num_rows($run_product_stock);

                    if ($count_product_stock == 0) {
                      $enable_stock = "no";
                      $stock_status = "";
                      $stock_quantity = 0;
                      $allow_backorders = "";
                    } else {
                      $enable_stock = $row_product_stock["enable_stock"];
                      $stock_status = $row_product_stock["stock_status"];
                      $stock_quantity = $row_product_stock["stock_quantity"];
                      $allow_backorders = $row_product_stock["allow_backorders"];
                    }


               	?>

               		 <tr> <!-- tr starts-->

               			<td>

               				<img src="admin_area/product_images/<?php echo $product_img1;?>">

               			</td>

               			<td>
               				<a href="<?php echo $product_url; ?>" target="_blank" class="bold"> <?php echo $product_title;?> </a>
               			</td>

               			<td>
               				<?php echo "$product_code"; ?>
               			</td>

               			<td>
                      <?php if($enable_stock == "yes" and $allow_backorders == "no") {?>
               				<input type="text" name="quantity" value="<?php echo $_SESSION['pro_qty'];?>"data-product_id="<?php echo $pro_id; ?>"
                      min="1" max="<?php echo $stock_quantity; ?>" class="quantity form-control">
                    <?php } elseif($enable_stock == "yes" and ($allow_backorders == "yes" or $allow_backorders == "notify")){ ?>
                      <input type="text" name="quantity" value="<?php echo $_SESSION['pro_qty'];?>"data-product_id="<?php echo $pro_id; ?>"
                      min="1"  class="quantity form-control">
                    <?php } elseif($enable_stock == "no"){?>
                      <input type="text" name="quantity" value="<?php echo $_SESSION['pro_qty'];?>"data-product_id="<?php echo $pro_id; ?>"
                      min="1"  class="quantity form-control">
                    <?php } ?>

               			</td>

               			<td>
               				<?php echo $only_price;?> Lekë
               			</td>

               			<td>
               				<input type="checkbox" name="remove[]" value="<?php echo $pro_id;?>">
               			</td>

               			<td>
               				<?php echo $sub_total;?> Lekë
               			</td>

               		</tr><!-- tr ends-->

               		<?php } } ?>

               </tbody><!-- tbody ends-->


               	<tfoot><!-- tfoot starts-->

               		<tr>

               			<th colspan="5"> Totali </th>

               			<th colspan="2"><span class="subtotal-cart-price"> <?php echo $total;?></span> Lekë </th>

               		</tr>

               	</tfoot><!-- tfoot ends-->

						</table><!-- table ends-->

						<div class="form-inline pull-right"><!--form-inline pull-right start-->
							<div class="form-group"><!--form-group start-->
								<label>Kodi i Kuponit :</label>
								<input type="text" name="code" class="form-control">
							</div><!--form-group end-->
							<input class="btn btn-primary" type="submit" name="apply_coupon" value="Vendos Kuponin">
						</div><!--form-inline pull-right end-->


							<div class="box-footer"><!-- box-footer starts-->

								<div class="pull-left"><!-- pull-left starts-->

									<a href="index.php" class="btn btn-default">

										<i class="fa fa-chevron-left"></i> Vazhdoni Blerjen


									</a>

								</div><!-- pull-left ends-->


									<div class="pull-right"><!-- pull-right starts-->

										<button class="btn btn-default" type="submit" name="update" value="Update Cart">

											<i class="fa fa-refresh"></i> Përditëso Shportën

										</button>

											<a href="checkout.php" class="btn btn-primary">

												Përfundo Blerjen <i class="fa fa-chevron-right"></i>
											</a>

									</div><!-- pull-right ends-->

							</div><!-- box-footer ends-->

					</div><!-- table-responsive ends-->

				</form><!-- form ends-->

			</div><!-- box ends-->

			<?php
				if (isset($_POST['apply_coupon'])) {
					$code = $_POST['code'];

					if ($code == "") {

					} else {
						$get_coupons = " select * from coupons where coupon_code='$code' ";

						$run_coupons = mysqli_query($con,$get_coupons);

						$check_coupons = mysqli_num_rows($run_coupons);

						if ($check_coupons == 1) {
							$row_coupons = mysqli_fetch_array($run_coupons);

							$coupon_pro = $row_coupons['product_id'];

							$coupon_price = $row_coupons['coupon_price'];

							$coupon_limit = $row_coupons['coupon_limit'];

							$coupon_used = $row_coupons['coupon_used'];

							if ($coupon_limit == $coupon_used) {
								echo "<script>alert('Kuponi juaj ka skaduar') </script>";
							} else {
								$get_cart = "select *from cart where p_id='$coupon_pro' AND ip_add='$ip_add' ";
								$run_cart = mysqli_query($con,$get_cart);

								$check_cart = mysqli_num_rows($run_cart);

								if ($check_cart == 1) {
									$add_used = "update coupons set coupon_used=coupon_used+1 where coupon_code='$code' ";
									$run_used = mysqli_query($con,$add_used);

									$update_cart = "update cart set p_price='$coupon_price' where p_id='$coupon_pro' AND ip_add='$ip_add' ";

									$run_update = mysqli_query($con,$update_cart);

									echo "<script>alert('Kuponi u aplikua') </script>";
									echo "<script>window.open('cart.php','_self') </script>";

								} else {
									echo "<script>alert('Produkti nuk ndodhet në shportë!') </script>";
								}

							}

						} else {
							echo "<script>alert('Kuponi juaj nuk është i vlefshëm!') </script>";
						}

					}

				}

			 ?>

			<?php

        function update_cart(){

            global $con;

            if(isset($_POST['update'])){

            	foreach ($_POST['remove'] as $remove_id) {

            		$delete_product = "delete from cart where p_id='$remove_id'";

            		$run_delete = mysqli_query($con, $delete_product);

            		if ($run_delete) {
            			echo "<script>window.open('cart.php','_self')</script>";
            		}
            	}
            }
        }

        echo $up_cart = update_cart();
			?>

				<div id="row same-height-row"><!-- row same-height-row starts-->

          	<div class="box interesting"><!-- box starts-->


            	<div class="headlines"><!-- headlines starts-->

            		<h3 class="text-left"> Mund t'ju interesojnë edhe këto Produkte</h3>

            	</div><!-- headlines ends-->

          	</div><!-- box ends-->

<?php

   $get_products = "select * from products order by rand() LIMIT 0,3";

   $run_products = mysqli_query($con, $get_products);

   while ($row_products=mysqli_fetch_array($run_products)) {

   	$pro_id = $row_products['product_id'];
		$pro_title = $row_products['product_title'];
		$pro_price = $row_products['product_price'];
		$pro_img1 = $row_products['product_img1'];
    $pro_label = $row_products['product_label'];

    $manufacturer_id = $row_products['manufacturer_id'];

    $get_manufacturer = "select * from manufacturers where manufacturer_id='$manufacturer_id' ";

    $run_manufacturer = mysqli_query($db,$get_manufacturer);

    $row_manufacturer = mysqli_fetch_array($run_manufacturer);

    $manufacturer_name = $row_manufacturer['manufacturer_title'];

    $pro_psp_price = $row_products['product_psp_price'];

    $pro_url = $row_products['product_url'];

    if ($pro_label == "Oferte" or $pro_label == "I Ri") {

      $product_price = "<del>$pro_price Lekë</del>";

      $product_psp_price = "| $pro_psp_price Lekë";
    }
    else{

      $product_psp_price = "";

      $product_price ="$pro_price Lekë";
    }

    if ($pro_label == "") {

    	 $product_label = "";

    } else{

       $product_label = "

          <a class='label sale' href='#' style='color:black;'>
            <div class='thelabel'>
              $pro_label
            </div>
            <div class='label-background'> </div>
          </a>
        ";
    }

		echo "
          <div class='col-md-4 col-sm-6 center-responsive'>
           <div class='product'>
           	  <a class='crop' href='$pro_url'>
                 <img src='admin_area/product_images/$pro_img1' class='img-responsive'>
           	  </a>

           	  <div class='text'>
              <center>
                <p class='btn btn-primary title-tag'> $manufacturer_name</p>
              </center>
              <hr>
                <h3> <a href='$pro_url'> $pro_title </a> </h3>
                <p class='price'> $product_price $product_psp_price </p>
                <p class='buttons'>
                 <a href='$pro_url' class='btn btn-default'> Shiko Detajet</a>
                 <a href='$pro_url' class='btn btn-primary'> Shto në Shportë</a>
                </p>
           	  </div>

              $product_label

           </div>

          </div>
		";
                         }
                  		?>

                  </div><!-- row same-height-row ends-->

		</div><!-- col-md-9 ends-->

			<div class="col-md-3"><!-- col-md-3 starts-->

				<div class="box" id="order-summary"><!-- box starts-->

					<div class="box-header"><!-- box-header starts-->

						<h3> Përmbledhje e Porosisë</h3>

					</div><!-- box-header ends-->

						 <p class="text-muted">
						 	Transporti dhe kostot shtesë janë të përllogaritura në bazë të vlerës që keni zgjedhur.

						 </p>

						 <div class="table-responsive"><!-- table-responsive starts-->

						 	<table class="table"><!-- table starts-->

						 		<tbody id="cart-summary-tbody"><!-- tbody starts-->

						 			<tr>
                    <td> Nëntotali i përgjithshëm i Porosisë</td>

						 				<th> <?php echo $total;?> Lekë</th>
	                </tr>

						 			<tr>
						 				<th colspan="2">
                      <p class="shipping-header text-muted">
                      Totali i Peshës : <?php echo $total_weight; ?> <small>Kg</small>
						 				</p>
                    <p class="shipping-header text-muted">
                    <i class="fa fa-truck"></i> Transporti:
                  </p>
										<ul class="list-unstyled"><!-- list-unstyled starts-->
											<?php
                      if (isset($_SESSION['customer_email'])) {
												$customer_email = $_SESSION['customer_email'];
												$get_customer = "select * from customers where customer_email='$customer_email'";
												$run_customer = mysqli_query($con, $get_customer);
												$row_customer = mysqli_fetch_array($run_customer);
												$customer_id = $row_customer['customer_id'];
												$select_customers_addresses = "select * from customers_addresses where customer_id='$customer_id'";
												$run_customers_addresses = mysqli_query($con, $select_customers_addresses);
												$row_customers_addresses = mysqli_fetch_array($run_customers_addresses);
												$billing_country = $row_customers_addresses['billing_country'];
												$billing_postcode = $row_customers_addresses['billing_postcode'];
												$shipping_country = $row_customers_addresses['shipping_country'];
												$shipping_postcode = $row_customers_addresses['shipping_postcode'];
                        $shipping_zone_id = "";
                        if (@$_SESSION["is_shipping_address_same"] == "yes") {
                          if (empty($billing_country) and empty($billing_postcode)) {
                            echo "<li>
                            <p>
                            Nuk është i disponueshëm transporti. Ju lutem kontrolloni adresën përsëri,
                            ose na kontaktoni nëse keni nevojë për ndihmë.
                            </p>
                            </li>";
                          }

                          $select_zones = "select * from zones order by zone_order DESC";
                          $run_zones = mysqli_query($con, $select_zones);
                          while ($row_zones = mysqli_fetch_array($run_zones)) {
                            $zone_id = $row_zones['zone_id'];
                            $select_zones_locations = "select DISTINCT zone_id from zones_locations where
                            zone_id='$zone_id' and (location_code='$billing_country' and location_type='country')";
                            $run_zones_locations = mysqli_query($con, $select_zones_locations);
                            $count_zones_locations = mysqli_num_rows($run_zones_locations);
                            if ($count_zones_locations !="0") {
                              $row_zones_locations = mysqli_fetch_array($run_zones_locations);
                              $zone_id = $row_zones_locations['zone_id'];
                              $select_zone_shipping = "select * from shipping where shipping_zone='$zone_id'";
                              $run_zone_shipping = mysqli_query($con, $select_zone_shipping);
                              $count_zone_shipping = mysqli_num_rows($run_zone_shipping);
                              if ($count_zone_shipping !="0") {
                                $select_zone_postcodes = "select * from zones_locations where zone_id='$zone_id'
                                and location_type='postcode'";
                                $run_zone_postcodes = mysqli_query($con, $select_zone_postcodes);
                                $count_zone_postcodes = mysqli_num_rows($run_zone_postcodes);
                                if ($count_zone_postcodes != "0") {
                                  while ($row_zones_postcodes = mysqli_fetch_array($run_zone_postcodes)) {
                                    $location_code = $row_zones_postcodes['location_code'];
                                    if ($location_code == $billing_postcode) {
                                      $shipping_zone_id = $zone_id;
                                    }
                                  }
                                } else {
                                 $shipping_zone_id = $zone_id;
                                }

                              }
                            }
                          }
                        }elseif (@$_SESSION["is_shipping_address_same"] == "no") {
                          if (empty($shipping_country) and empty($shipping_postcode)) {
                            echo "<li>
                            <p>
                            Nuk është i disponueshëm transporti. Ju lutem kontrolloni adresën përsëri,
                            ose na kontaktoni nëse keni nevojë për ndihmë.
                            </p>
                            </li>";
                          }

                          $select_zones = "select * from zones order by zone_order DESC";
                          $run_zones = mysqli_query($con, $select_zones);
                          while ($row_zones = mysqli_fetch_array($run_zones)) {
                            $zone_id = $row_zones['zone_id'];
                            $select_zones_locations = "select DISTINCT zone_id from zones_locations where
                            zone_id='$zone_id' and (location_code='$shipping_country' and location_type='country')";
                            $run_zones_locations = mysqli_query($con, $select_zones_locations);
                            $count_zones_locations = mysqli_num_rows($run_zones_locations);
                            if ($count_zones_locations !="0") {
                              $row_zones_locations = mysqli_fetch_array($run_zones_locations);
                              $zone_id = $row_zones_locations['zone_id'];
                              $select_zone_shipping = "select * from shipping where shipping_zone='$zone_id'";
                              $run_zone_shipping = mysqli_query($con, $select_zone_shipping);
                              $count_zone_shipping = mysqli_num_rows($run_zone_shipping);
                              if ($count_zone_shipping !="0") {
                                $select_zone_postcodes = "select * from zones_locations where zone_id='$zone_id'
                                and location_type='postcode'";
                                $run_zone_postcodes = mysqli_query($con, $select_zone_postcodes);
                                $count_zone_postcodes = mysqli_num_rows($run_zone_postcodes);
                                if ($count_zone_postcodes != "0") {
                                  while ($row_zones_postcodes = mysqli_fetch_array($run_zone_postcodes)) {
                                    $location_code = $row_zones_postcodes['location_code'];
                                    if ($location_code == $shipping_postcode) {
                                      $shipping_zone_id = $zone_id;
                                    }
                                  }
                                } else {
                                 $shipping_zone_id = $zone_id;
                                }

                              }
                            }
                          }
                        }else {
                          if (empty($billing_country) and empty($billing_postcode)) {
                            echo "<li>
                            <p>
                            Nuk është i disponueshëm transporti. Ju lutem kontrolloni adresën përsëri,
                            ose na kontaktoni nëse keni nevojë për ndihmë.
                            </p>
                            </li>";
                          }

                          $select_zones = "select * from zones order by zone_order DESC";
                          $run_zones = mysqli_query($con, $select_zones);
                          while ($row_zones = mysqli_fetch_array($run_zones)) {
                            $zone_id = $row_zones['zone_id'];
                            $select_zones_locations = "select DISTINCT zone_id from zones_locations where
                            zone_id='$zone_id' and (location_code='$billing_country' and location_type='country')";
                            $run_zones_locations = mysqli_query($con, $select_zones_locations);
                            $count_zones_locations = mysqli_num_rows($run_zones_locations);
                            if ($count_zones_locations !="0") {
                              $row_zones_locations = mysqli_fetch_array($run_zones_locations);
                              $zone_id = $row_zones_locations['zone_id'];
                              $select_zone_shipping = "select * from shipping where shipping_zone='$zone_id'";
                              $run_zone_shipping = mysqli_query($con, $select_zone_shipping);
                              $count_zone_shipping = mysqli_num_rows($run_zone_shipping);
                              if ($count_zone_shipping !="0") {
                                $select_zone_postcodes = "select * from zones_locations where zone_id='$zone_id'
                                and location_type='postcode'";
                                $run_zone_postcodes = mysqli_query($con, $select_zone_postcodes);
                                $count_zone_postcodes = mysqli_num_rows($run_zone_postcodes);
                                if ($count_zone_postcodes != "0") {
                                  while ($row_zones_postcodes = mysqli_fetch_array($run_zone_postcodes)) {
                                    $location_code = $row_zones_postcodes['location_code'];
                                    if ($location_code == $billing_postcode) {
                                      $shipping_zone_id = $zone_id;
                                    }
                                  }
                                } else {
                                 $shipping_zone_id = $zone_id;
                                }

                              }
                            }
                          }
                        }

                        if (!empty($shipping_zone_id)) {
                          $select_shipping_types = "select *,if(
                            $total_weight > (
                              select max(shipping_weight) from shipping
                              where shipping_type=type_id AND shipping_zone='$shipping_zone_id'
                            ),
                            (
                            select shipping_cost from shipping where
                            shipping_type=type_id AND shipping_zone='$shipping_zone_id' order by shipping_weight
                            DESC LIMIT 0,1
                            ),
                            (
                              select shipping_cost from shipping where shipping_type=type_id
                              AND shipping_zone='$shipping_zone_id' AND shipping_weight >= '$total_weight'
                              order by shipping_weight ASC LIMIT 0,1
                              )
                            ) AS shipping_cost from shipping_types where type_local='yes'
                          order by type_order ASC ";
                          $run_shipping_types = mysqli_query($con, $select_shipping_types);
                          $i = 0;
                          while ($row_shipping_types = mysqli_fetch_array($run_shipping_types)) {
                            $i++;
                            $type_id = $row_shipping_types['type_id'];
                            $type_name = $row_shipping_types['type_name'];
                            $type_default = $row_shipping_types['type_default'];
                            $shipping_cost = $row_shipping_types['shipping_cost'];
                            if (!empty($shipping_cost)) {
                              ?>

                              <li>
                                <input type="radio" name="shipping_type" value="<?php echo $type_id; ?>" class="shipping_type"
                                data-shipping_cost="<?php echo $shipping_cost; ?>"
                                <?php
                                if ($type_default == "yes") {
                                  $_SESSION["shipping_type"] = $type_id;
                                  $_SESSION["shipping_cost"] = $shipping_cost;
                                  echo "checked";

                                }elseif ($i == 1) {
                                  $_SESSION["shipping_type"] = $type_id;
                                  $_SESSION["shipping_cost"] = $shipping_cost;
                                  echo "checked";
                                }
                                 ?> >

                                 <?php echo $type_name; ?> : <span class="text-muted"> <?php echo $shipping_cost; ?> Lekë</span>
                              </li>

                              <?php
                            }
                          }
                        }
											} else {
												echo "
												<li>
												<p> Ju lutem logohuni për të zgjedhur transportin.</p>
												</li>";
											}
											 ?>
										</ul><!-- list-unstyled end-->
									</th>
                </tr>
                <tr>
					 				<td> Taksa </td>

					 				<th> 0 Lekë</th>
					 			</tr>

                <?php
                $total_cart_price = (int)$total + (int)@$_SESSION["shipping_cost"];
                 ?>

					 			<tr class="total">

					 				<td> Totali</td>
					 				<th class="total-cart-price"> <?php echo $total_cart_price;?> Lekë</th>

					 			</tr>

						 		</tbody><!-- tbody ends-->

						 	</table><!-- table ends-->

						 </div><!-- table-responsive ends-->

				</div><!-- box ends-->

			</div><!-- col-md-3 ends-->

    </div><!-- container ends-->

	</div><!-- content ends-->

</div><!--container ends-->

<?php
	include("includes/footer.php")
?>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script>

	$(document).ready(function(data) {
		$(document).on('keyup' , '.quantity', function() {
      var value = parseInt($(this).val());
      var max = parseInt($(this).attr("max"));
      var min = parseInt($(this).attr("min"));

      if (value > max) {
        value = max;
        $(this).val(value);

      } else if(value < min) {
        value = min;
        $(this).val(value);
      }
			var id = $(this).data("product_id");
			var quantity = $(this).val();
      var shipping_type = $("input[name=shipping_type]:checked").val();
      var shipping_cost = Number($("input[name=shipping_type]:checked").data("shipping_cost"));

			if (quantity !='') {

				$.ajax({

					url:"change.php",
					method:"POST",
					data:{id:id, quantity:quantity, shipping_type:shipping_type, shipping_cost:shipping_cost},

					success:function(data){
            $(".subtotal-cart-price").html(data);
						$("#cart-products-tbody").load("cart_products_tbody.php");
            $("#cart-summary-tbody").load("cart_summary_tbody.php");
					}
				})
			}
		});


      $(document).on("change",".shipping_type", function(){
        var shipping_cost = Number($(this).data("shipping_cost"));
        var total = Number(<?php echo $total; ?>);
        var total_cart_price = total + shipping_cost;
        $(".total-cart-price").html(total_cart_price);
      });


	});
</script>
</body>


</html>

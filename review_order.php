<?php
if (!defined("review_order")) {
  echo "<script>window.open('checkout.php','_self');</script>";
}
 ?>
<div class="row"><!-- row start-->
  <?php
  $ip_add = getRealUserIp();

  $select_cart = "select * from cart where ip_add='$ip_add'";

  $run_cart = mysqli_query($con, $select_cart);

  $count = mysqli_num_rows($run_cart);

  if ($count == 0) {

   ?>
<div class="col-md-12"><!-- col-md-12 start -->
  <div class="box text-center"><!-- box text-center start -->
    <p class="lead"> Ju nuk keni asnjë produkt në Shportë!</p>
    <a href="shop.php" class="btn btn-primary btn-lg"> Kthehu tek Dyqani</a>
  </div><!-- box text-center end -->
</div><!-- col-md-12 end -->

 <?php }else{ ?>
 <div class="col-md-8"><!-- col-md-8 start -->
   <div class="box"><!-- box start -->
     <p class="lead"> Ju lutem kontrolloni Detajet e Faturimit dhe të Transportit.</p>
     <?php
     $customer_email = $_SESSION['customer_email'];
     $get_customer = "select * from customers where customer_email='$customer_email'";
     $run_customer = mysqli_query($con, $get_customer);
     $row_customer = mysqli_fetch_array($run_customer);
     $customer_id = $row_customer['customer_id'];
     $select_customers_addresses = "select * from customers_addresses where customer_id='$customer_id'";
     $run_customers_addresses = mysqli_query($con, $select_customers_addresses);
     $row_customers_addresses = mysqli_fetch_array($run_customers_addresses);
     $billing_first_name = $row_customers_addresses['billing_first_name'];
     $billing_last_name = $row_customers_addresses['billing_last_name'];
     $billing_country = $row_customers_addresses['billing_country'];
     $billing_address_1 = $row_customers_addresses['billing_address_1'];
     $billing_address_2 = $row_customers_addresses['billing_address_2'];
     $billing_state = $row_customers_addresses['billing_state'];
     $billing_city = $row_customers_addresses['billing_city'];
     $billing_postcode = $row_customers_addresses['billing_postcode'];

     // Shipping Details Start
     $shipping_first_name = $row_customers_addresses['shipping_first_name'];
     $shipping_last_name = $row_customers_addresses['shipping_last_name'];
     $shipping_country = $row_customers_addresses['shipping_country'];
     $shipping_address_1 = $row_customers_addresses['shipping_address_1'];
     $shipping_address_2 = $row_customers_addresses['shipping_address_2'];
     $shipping_state = $row_customers_addresses['shipping_state'];
     $shipping_city = $row_customers_addresses['shipping_city'];
     $shipping_postcode = $row_customers_addresses['shipping_postcode'];

     ?>

      <form method="post" id="shipping-billing-details-form"><!--shipping-billing-details-form start-->
        <h2> Detajet e Faturimit</h2>
        <div class="row"><!--row start-->

          <div class="col-sm-6"><!--col-sm-6 start-->
            <div class="form-group"><!--form-group start-->
              <label> Emri:</label>
              <input type="text" name="billing_first_name" class="form-control"
              value="<?php echo $billing_first_name; ?>" required>
            </div><!--form-group end-->
          </div><!--col-sm-6 end-->

          <div class="col-sm-6"><!--col-sm-6 start-->
            <div class="form-group"><!--form-group start-->
              <label> Mbiemri:</label>
              <input type="text" name="billing_last_name" class="form-control"
              value="<?php echo $billing_last_name; ?>" required>
            </div><!--form-group end-->
          </div><!--col-sm-6 end-->
        </div><!--row end-->

        <div class="form-group"><!--form-group start-->
          <label> Shteti:</label>
          <select class="form-control" name="billing_country" required>
            <option value=""> Zgjidhni Shtetin</option>\
            <?php
            $get_countries = "select * from countries";
            $run_countries = mysqli_query($con,$get_countries);
            while ($row_country = mysqli_fetch_array($run_countries)) {
              $country_id = $row_country['country_id'];
              $country_name = $row_country['country_name'];

             ?>
             <option value="<?php echo $country_id; ?>"
               <?php if ($billing_country == $country_id) {
                 echo "selected";
               } ?>
               >
               <?php echo $country_name; ?>
             </option>

             <?php } ?>
          </select>
        </div><!--form-group end-->

        <div class="form-group"><!--form-group start-->
          <label> Adresa 1:</label>
          <input type="text" name="billing_address_1" class="form-control"
          value="<?php echo $billing_address_1; ?>" required>
        </div><!--form-group end-->

        <div class="form-group"><!--form-group start-->
          <label> Adresa 2 (opsionale):</label>
          <input type="text" name="billing_address_2" class="form-control"
          value="<?php echo $billing_address_2; ?>">
        </div><!--form-group end-->

        <div class="row"><!--row start-->

          <div class="col-sm-6"><!--col-sm-6 start-->
            <div class="form-group"><!--form-group start-->
              <label> Shteti:</label>
              <input type="text" name="billing_state" class="form-control"
              value="<?php echo $billing_state; ?>" required>
            </div><!--form-group end-->
          </div><!--col-sm-6 end-->

          <div class="col-sm-6"><!--col-sm-6 start-->
            <div class="form-group"><!--form-group start-->
              <label> Qyteti:</label>
              <input type="text" name="billing_city" class="form-control"
              value="<?php echo $billing_city; ?>" required>
            </div><!--form-group end-->
          </div><!--col-sm-6 end-->

        </div><!--row end-->

        <div class="form-group"><!--form-group start-->
          <label> Kodi Postal/Zip:</label>
          <input type="text" name="billing_postcode" class="form-control"
          value="<?php echo $billing_postcode; ?>" required>
        </div><!--form-group end-->

        <?php if ($count > 0) { ?>
          <hr />
          <div class="form-group">
            <h4> A janë detajet e transportit te njëjtat?</h4>
            <?php if (!isset($_SESSION["is_shipping_address_same"])) {
             $_SESSION["is_shipping_address_same"] = "yes";
            }?>

            <input type="radio" name="is_shipping_address_same" value="yes"
            <?php if (@$_SESSION["is_shipping_address_same"] == "yes") {
              echo "checked";
            } ?>
            >
            <label> Po</label>

            <input type="radio" name="is_shipping_address_same" value="no"
            <?php if (@$_SESSION["is_shipping_address_same"] == "no") {
              echo "checked";
            } ?>
            >
            <label> Jo</label>

          </div>


         <div id="shipping-details-form-div"><!--shipping-details-form-div start-->
           <h2> Detajet e Transportit</h2>
           <div class="row"><!--row start-->

             <div class="col-sm-6"><!--col-sm-6 start-->
               <div class="form-group"><!--form-group start-->
                 <label> Emri:</label>
                 <input type="text" name="shipping_first_name" class="form-control"
                 value="<?php echo $shipping_first_name; ?>" required>
               </div><!--form-group end-->
             </div><!--col-sm-6 end-->

             <div class="col-sm-6"><!--col-sm-6 start-->
               <div class="form-group"><!--form-group start-->
                 <label> Mbiemri:</label>
                 <input type="text" name="shipping_last_name" class="form-control"
                 value="<?php echo $shipping_last_name; ?>" required>
               </div><!--form-group end-->
             </div><!--col-sm-6 end-->
           </div><!--row end-->

           <div class="form-group"><!--form-group start-->
             <label> Shteti:</label>
             <select class="form-control" name="shipping_country" required>
               <option value=""> Zgjidhni Shtetin</option>\
               <?php
               $get_countries = "select * from countries";
               $run_countries = mysqli_query($con,$get_countries);
               while ($row_country = mysqli_fetch_array($run_countries)) {
                 $country_id = $row_country['country_id'];
                 $country_name = $row_country['country_name'];

                ?>
                <option value="<?php echo $country_id; ?>"
                  <?php if ($shipping_country == $country_id) {
                    echo "selected";
                  } ?>
                  >
                  <?php echo $country_name; ?>
                </option>

                <?php } ?>
             </select>
           </div><!--form-group end-->

           <div class="form-group"><!--form-group start-->
             <label> Adresa 1:</label>
             <input type="text" name="shipping_address_1" class="form-control"
             value="<?php echo $shipping_address_1; ?>" required>
           </div><!--form-group end-->

           <div class="form-group"><!--form-group start-->
             <label> Adresa 2 (opsionale):</label>
             <input type="text" name="shipping_address_2" class="form-control"
             value="<?php echo $shipping_address_2; ?>">
           </div><!--form-group end-->

           <div class="row"><!--row start-->

             <div class="col-sm-6"><!--col-sm-6 start-->
               <div class="form-group"><!--form-group start-->
                 <label> Shteti:</label>
                 <input type="text" name="shipping_state" class="form-control"
                 value="<?php echo $shipping_state; ?>" required>
               </div><!--form-group end-->
             </div><!--col-sm-6 end-->

             <div class="col-sm-6"><!--col-sm-6 start-->
               <div class="form-group"><!--form-group start-->
                 <label> Qyteti:</label>
                 <input type="text" name="shipping_city" class="form-control"
                 value="<?php echo $shipping_city; ?>" required>
               </div><!--form-group end-->
             </div><!--col-sm-6 end-->

           </div><!--row end-->

           <div class="form-group"><!--form-group start-->
             <label> Kodi Postal/Zip:</label>
             <input type="text" name="shipping_postcode" class="form-control"
             value="<?php echo $shipping_postcode; ?>" required>
           </div><!--form-group end-->

         </div><!--shipping-details-form-div end-->
       <?php } ?>

       <div class="form-group"><!--form-group start-->
         <label> Shënime:</label>
         <textarea name="order_note" rows="3" placeholder="Shënime rreth Porosisë, psh. shpjegime shtesë për dorëzimin"
           class="form-control"></textarea>
       </div><!--form-group end-->
       <input type="submit" name="submit" id="shipping-details-form-submit-button" value="Ruaj" style="display:none;">
      </form><!--shipping-billing-details-form end-->

   </div><!-- box end -->
 </div><!-- col-md-8 end -->
 <div class="col-md-4"><!-- col-md-4 start -->
   <div class="box" id="order-summary"><!-- box start -->
     <div class="box-header"><!-- box-header start -->
       <h3> Përmbledhje e Porosisë</h3>
     </div><!-- box-header end -->
     <table class="table"><!-- table start -->
       <thead>
         <tr>
           <th class="text-muted"> Produkti:</th>
           <th class="text-muted"> Totali:</th>
         </tr>
       </thead>
       <tbody id="checkout-tbody-reload"><!-- tbody start -->
         <?php
         $total = 0;
         $total_weight = 0;
         $select_cart = "select * from cart where ip_add='$ip_add'";
         $run_cart = mysqli_query($con, $select_cart);
         while ($row_cart = mysqli_fetch_array($run_cart)) {
          $product_id = $row_cart['p_id'];
          $product_price = $row_cart['p_price'];
          $product_qty = $row_cart['qty'];
          $get_product = "select * from products where product_id='$product_id'";
          $run_product = mysqli_query($con, $get_product);
          $row_product = mysqli_fetch_array($run_product);
          $product_title = $row_product['product_title'];
          $product_weight = $row_product['product_weight'];
          $sub_total = $product_price * $product_qty;
          $total += $sub_total;
          $sub_total_weight = $product_weight * $product_qty;
          $total_weight += $sub_total_weight;
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
          <td class="text-muted bold"> Nëntotali i Porosisë</td>

          <th> <?php echo $total;?>.00 Lekë</th>
        </tr>
        <tr>
          <th colspan="2">
            <p class="shipping-header text-muted">
            <i class="fa fa-truck"></i> Transporti:
            </p>
            <ul class="list-unstyled"><!-- shipping ul list-unstyled start-->
              <?php
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
              }else if (@$_SESSION["is_shipping_address_same"] == "no") {
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

                      }else if ($i == 1) {
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

              $total_cart_price = $total + @$_SESSION["shipping_cost"];
               ?>
            </ul><!-- shipping ul list-unstyled end-->
          </th>
        </tr>

        <tr>
          <td class="text-muted bold"> Taksa </td>
          <th> 0.00 Lekë</th>
        </tr>

        <tr class="total">
          <td> Totali</td>
          <th class="total-cart-price"> <?php echo $total_cart_price;?>.00 Lekë</th>
        </tr>

        <tr>
          <th colspan="2">
            <input type="radio" name="payment_method" id="offline-radio" value="pay_offline">
            <label for="offline-radio"> Paguaj Offline</label>
            <p id="offline-desc" class="text-muted">
              Porosia juaj do të dërgohet pasi të jetë bërë pagesa.
            </p>
          </th>
        </tr>

        <tr>
          <th colspan="2">
            <input type="radio" name="payment_method" id="paypal-radio" value="paypal" checked>
            <label for="paypal-radio"> Paypal</label>
            <p id="paypal-desc" class="text-muted">
              Paguaj me Paypal me anë të kartës së kreditit , debitit ose nëpërmjet llogarisë tuaj Paypal.
            </p>
          </th>
        </tr>

        <tr>
          <td id="payment-method-forms-td" colspan="2"><!--payment-method-forms-td start-->
            <form id="offline-form" action="order.php" method="post"><!--offline-form start-->
              <input type="hidden" name="amount" value="<?php echo $total_cart_price; ?>">
              <input type="submit" value="Bëj Porosinë" id="offline-submit" class="btn btn-success btn-lg"
              style="border-radius:0px;">
            </form><!--offline-form end-->

            <form id="paypal-form" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post"><!--paypal-form start-->
              <input type="hidden" name="business" value="elektroitaliashtaro@gmail.com">
              <input type="hidden" name="cmd" value="_cart">
              <input type="hidden" name="upload" value="1">
              <input type="hidden" name="currency_code" value="USD">
              <input type="hidden" name="return" value="http://localhost/ecom_store/paypal_order.php?c_id=
              <?php echo $customer_id;?>&amount=<?php echo $total_cart_price;?>" >
              <input type="hidden" name="cancel_return" value="http://localhost/ecom_store/checkout.php">
              <?php
              $i = 0;
              $select_cart = "select * from cart where ip_add='$ip_add'";
              $run_cart = mysqli_query($con, $select_cart);
              while ($row_cart = mysqli_fetch_array($run_cart)) {
               $product_id = $row_cart['p_id'];
               $product_qty = $row_cart['qty'];
               $product_price = $row_cart['p_price'];
               $get_product = "select * from products where product_id='$product_id'";
               $run_product = mysqli_query($con, $get_product);
               $row_product = mysqli_fetch_array($run_product);
               $product_title =$row_product['product_title'];
               $i++;
               ?>
               <input type="hidden" name="item_name_<?php echo $i;?>" value="<?php echo $product_title;?>">
               <input type="hidden" name="item_number_<?php echo $i;?>" value="<?php echo $i;?>">
               <input type="hidden" name="amount_<?php echo $i;?>" value="<?php echo $product_price;?>">
               <input type="hidden" name="quantity_<?php echo $i;?>" value="<?php echo $product_qty;?>">
             <?php } ?>

             <input type="hidden" name="shipping_1" value="<?php echo @$_SESSION['shipping_cost'];?>">
             <input type="hidden" name="first_name" value="<?php echo $billing_first_name;?>">
             <input type="hidden" name="last_name" value="<?php echo $billing_last_name;?>">
             <input type="hidden" name="address1" value="<?php echo $billing_address_1;?>">
             <input type="hidden" name="address2" value="<?php echo $billing_address_2;?>">
             <input type="hidden" name="city" value="<?php echo $billing_city;?>">
             <input type="hidden" name="state" value="<?php echo $billing_state;?>">
             <input type="hidden" name="zip" value="<?php echo $billing_postcode;?>">
             <input type="hidden" name="email" value="<?php echo $customer_email;?>">
             <input type="submit" id="paypal-submit" name="submit" value="Vazhdo me Paypal"
             class="btn btn-success btn-lg" style="border-radius:0px;">
            </form><!--paypal-form end-->
          </td><!--payment-method-forms-td end-->
        </tr>
       </tbody><!-- tbody end -->
     </table><!-- table end -->
   </div><!-- box end -->
 </div><!-- col-md-4 end -->
<?php } ?>
</div><!-- row end-->

<script>
  $(document).ready(function(){
    <?php if (@$_SESSION["is_shipping_address_same"] == "yes") { ?>
    $("#shipping-details-form-div :input").prop("disabled",true);
    $("#shipping-details-form-div").hide();
    <?php } ?>
    $("input[name='is_shipping_address_same']").click(function(){
      var radio_value = $(this).val();
      if (radio_value == "yes") {
        $("#shipping-details-form-div :input").prop("disabled",true);
        $("#shipping-details-form-div").hide();
      } else if (radio_value == "no") {
        $("#shipping-details-form-div :input").prop("disabled",false);
        $("#shipping-details-form-div").show();
      }
    });

    $("#shipping-billing-details-form :input").change(function(){
      var form = document.getElementById("shipping-billing-details-form");
      var form_data = new FormData(form);
      var shipping_type = $("input[name='shipping_type']:checked").val();
      var payment_method = $("input[name='payment_method']:checked").val();
      form_data.append("shipping_type", shipping_type);
      form_data.append("payment_method", payment_method);
      $("table").addClass("wait-loader");
      $.ajax({
        url: "update_billing_shipping_details.php",
        method: "POST",
        processData: false,
        contentType: false,
        cache: false,
        data: form_data
      }).done(function(){
        $("#checkout-tbody-reload").load("checkout_tbody.php");
        $("table").removeClass("wait-loader");
      });
    });
    <?php if ($product_qty >0) {?>
      $(document).on("change",".shipping_type",function(){
        var total = Number(<?php echo $total; ?>);
        var shipping_type = $(this).val();
        var shipping_cost = Number($(this).data("shipping_cost"));
        var payment_method = $("input[name='payment_method']:checked").val();
        var total_cart_price = total + shipping_cost;
        $("table").addClass("wait-loader");
        $.ajax({
          url:"change_checkout_shipping.php",
          method: "POST",
          data:{total: total, shipping_type: shipping_type, shipping_cost: shipping_cost,
          payment_method: payment_method}
        }).done(function(data){
          $(".total-cart-price").html(total_cart_price + ".00" + "Lekë");
          $("#payment-method-forms-td").html(data);
          $("table").removeClass("wait-loader");
        });
      });
    <?php } ?>
    $("#offline-desc").hide();
    $("#offline-form").hide();
    $("#paypal-desc").show();
    $("#paypal-form").show();
    $("#offline-radio").click(function(){
      $("#offline-desc").show();
      $("#offline-form").show();
      $("#paypal-desc").hide();
      $("#paypal-form").hide();
    });
    $("#paypal-radio").click(function(){
      $("#offline-desc").hide();
      $("#offline-form").hide();
      $("#paypal-desc").show();
      $("#paypal-form").show();
    });

    $("#offline-submit").click(function(event){
      event.preventDefault();
      $("#shipping-billing-details-form").submit(function(event){
        event.preventDefault();
        var confirm_action = confirm("Dëshironi të Porosisni Produktet e Shportës me anë të metodës offline?");
        if(confirm_action == true){
          $("#offline-submit").click();
        }
      });
      $("#shipping-details-form-submit-button").click();
    });

   $("#paypal-submit").click(function(event){
    event.preventDefault();
    $("#shipping-billing-details-form").submit(function(event){
      event.preventDefault();
      var confirm_action = confirm("Dëshironi të Porosisni Produktet e Shportës me anë të metodës Paypal?");
      if(confirm_action == true){
        $("#paypal-submit").click();
      }
    });
    $("#shipping-details-form-submit-button").click();
  });
  });
</script>

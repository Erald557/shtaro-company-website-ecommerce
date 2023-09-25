<?php

session_start();

include("includes/db.php");

include("functions/functions.php");

if (isset($_SESSION["customer_email"])) {
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
  $ip_add = getRealUserIp();
  $select_cart = "select * from cart where ip_add='$ip_add'";
  $run_cart = mysqli_query($con, $select_cart);

?>

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

 <th> <?php echo $total;?> Lekë</th>
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
             if (@$_SESSION["shipping_type"] == $type_id) {
               $_SESSION["shipping_type"] = $type_id;
               $_SESSION["shipping_cost"] = $shipping_cost;
               echo "checked";

             }elseif ($i == 1) {
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
 <th> 0 Lekë</th>
</tr>

<tr class="total">
 <td> Totali</td>
 <th class="total-cart-price"> <?php echo $total_cart_price;?> Lekë</th>
</tr>

<tr>
 <th colspan="2">
   <input type="radio" name="payment_method" id="offline-radio" value="pay_offline"
   <?php if(@$_SESSION["payment_method"] == "pay_offline"){echo"checked";} ?> >
   <label for="offline-radio"> Paguaj Offline</label>
   <p id="offline-desc" class="text-muted">
     Porosia juaj do të dërgohet pasi të jetë bërë pagesa.
   </p>
 </th>
</tr>

<tr>
 <th colspan="2">
   <input type="radio" name="payment_method" id="paypal-radio" value="paypal"
   <?php if(@$_SESSION["payment_method"] == "paypal"){echo"checked";} ?> >
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
     <input type="hidden" name="currency_code" value="ALL">
     <input type="hidden" name="return" value="http://localhost/ecom_store/paypal_order.php?c_id=
     <?php echo $customer_id;?>&amount=<?php echo $total_cart_price;?>">
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
<script>
  $(document).ready(function(){
    <?php if(@$_SESSION["payment_method"] == "paypal"){ ?>
    $("#offline-desc").hide();
    $("#offline-form").hide();
    $("#paypal-desc").show();
    $("#paypal-form").show();
    <?php } elseif(@$_SESSION["payment_method"] == "pay_offline"){?>
      $("#offline-desc").show();
      $("#offline-form").show();
      $("#paypal-desc").hide();
      $("#paypal-form").hide();
    <?php } ?>
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

<?php } ?>

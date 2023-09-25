<?php
@session_start();

if (!isset($_SESSION["customer_email"])) {
  echo "<script>window.open('../checkout.php','_self');</script>";
}
 ?>
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

 <h2> Adresa e Faturimit</h2>

 <form class="" method="post"><!-- billing adress form start-->
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

   <div class="form-group"><!--form-group start-->
     <input type="submit" name="update_billing_address" value="Përditëso Adresen e Faturimit"
     class="btn btn-success form-control">
   </div><!--form-group end-->
 </form><!-- billing adress form end-->

 <h2>Adresa e Transportit</h2>

 <form class="" method="post"><!-- shipping address form start-->
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

   <div class="form-group"><!--form-group start-->
     <input type="submit" name="update_shipping_address" value="Përditëso Adresen e Transportit"
     class="btn btn-success form-control">
   </div><!--form-group end-->
 </form><!-- shipping address form end-->

 <?php
if (isset($_POST["update_billing_address"])){

  $billing_first_name = mysqli_real_escape_string($con,$_POST["billing_first_name"]);
  $billing_last_name = mysqli_real_escape_string($con,$_POST["billing_last_name"]);
  $billing_country = mysqli_real_escape_string($con,$_POST["billing_country"]);
  $billing_address_1 = mysqli_real_escape_string($con,$_POST["billing_address_1"]);
  $billing_address_2 = mysqli_real_escape_string($con,$_POST["billing_address_2"]);
  $billing_state = mysqli_real_escape_string($con,$_POST["billing_state"]);
  $billing_city = mysqli_real_escape_string($con,$_POST["billing_city"]);
  $billing_postcode = mysqli_real_escape_string($con,$_POST["billing_postcode"]);

  $update_billing_address = "update customers_addresses set billing_first_name='$billing_first_name',
  billing_last_name='$billing_last_name',billing_country='$billing_country',billing_address_1='$billing_address_1',
  billing_address_2='$billing_address_2',billing_state='$billing_state',billing_city='$billing_city',
  billing_postcode='$billing_postcode' where customer_id='$customer_id'";

  $run_update_billing_address = mysqli_query($con, $update_billing_address);

  if ($run_update_billing_address) {
    echo "<script>
      alert('Adresa juaj e Faturimit u Përditësua!');
      window.open('my_account.php?my_addresses','_self');
    </script>";
  }
}

if (isset($_POST["update_shipping_address"])) {

  $shipping_first_name = mysqli_real_escape_string($con,$_POST["shipping_first_name"]);
  $shipping_last_name = mysqli_real_escape_string($con,$_POST["shipping_last_name"]);
  $shipping_country = mysqli_real_escape_string($con,$_POST["shipping_country"]);
  $shipping_address_1 = mysqli_real_escape_string($con,$_POST["shipping_address_1"]);
  $shipping_address_2 = mysqli_real_escape_string($con,$_POST["shipping_address_2"]);
  $shipping_state = mysqli_real_escape_string($con,$_POST["shipping_state"]);
  $shipping_city = mysqli_real_escape_string($con,$_POST["shipping_city"]);
  $shipping_postcode = mysqli_real_escape_string($con,$_POST["shipping_postcode"]);
  $update_shipping_address = "update customers_addresses set shipping_first_name='$shipping_first_name',
  shipping_last_name='$shipping_last_name',shipping_country='$shipping_country',
  shipping_address_1='$shipping_address_1',shipping_address_2='$shipping_address_2',
  shipping_state='$shipping_state', shipping_city='$shipping_city',shipping_postcode='$shipping_postcode'
  where customer_id='$customer_id'";

  $run_update_shipping_address = mysqli_query($con, $update_shipping_address);

  if ($run_update_shipping_address) {
    echo "<script>
      alert('Adresa juaj e Transportit u Përditësua!');
      window.open('my_account.php?my_addresses','_self');
    </script>";
  }
}
  ?>

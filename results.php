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

<div class="navbar navbar-default" id="navbar"><!-- navbar navbar-default Starts -->
<div class="container" ><!-- container Starts -->

  <?php
  include("includes/navbar-menu.php")
   ?>

</div><!-- container Ends -->
</div><!-- navbar navbar-default Ends -->

<div id="content" ><!-- content Starts -->
<div class="container" ><!-- container Starts -->

<div class="col-md-12" ><!--- col-md-12 Starts -->

<ul class="breadcrumb" ><!-- breadcrumb Starts -->

<li>
<a href="index.php">Home</a>
</li>

<li>Rezultati i Kërkimit</li>

</ul><!-- breadcrumb Ends -->

</div><!--- col-md-12 Ends -->

<div class="col-md-12" ><!-- col-md-12 Starts --->

<div class="row" id="Products" ><!-- row Starts -->

<?php

if(isset($_GET['search'])){

$user_keyword = $_GET['user_query'];

$get_products = "select * from products where product_keywords like '%$user_keyword%'";

$run_products = mysqli_query($con,$get_products);

$count = mysqli_num_rows($run_products);

if($count==0){

echo "
<div class='col-md-12'>
<div class='box'>

<h3 style='padding-bottom: 121px;'>Nuk u gjet asnjë Rezultat.....</h3>

</div>
</div>
";

}else{

  while ($row_products = mysqli_fetch_array($run_products)) {

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

    $product_price = "<del> $pro_price Lekë </del>";

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
     <div class='item active'>
        <div class='col-md-3 col-sm-6 col-xs-12 center-responsive'>
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
       </div>
  ";
        }

}

}
 ?>

</div><!-- row Ends -->

</div><!-- col-md-9 Ends --->

</div><!-- container Ends -->

</div><!-- content Ends -->

<?php

include("includes/footer.php");

?>

<script src="js/jquery.min.js"> </script>

<script src="js/bootstrap.min.js"></script>

</body>

</html>

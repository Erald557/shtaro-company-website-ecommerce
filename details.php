
<?php

session_start();

include("includes/db.php");

include("functions/functions.php");
?>

<?php



    $product_id = $_GET['pro_id'];

  	$get_product = "select * from products where product_url='$product_id'";

  	$run_product = mysqli_query($con,$get_product);

  	$check_product = mysqli_num_rows($run_product);

  	if ($check_product == 0) {
  		echo "<script>window.open('index.php','_self') </script>";
  	} else {

  	$row_product = mysqli_fetch_array($run_product);

  	$p_cat_id = $row_product['p_cat_id'];

  	$pro_id = $row_product['product_id'];

  	$pro_title = $row_product['product_title'];

    $pro_manufacturer = $row_product['manufacturer_id'];

  	$pro_code = $row_product['product_code'];

  	$pro_price = $row_product['product_price'];

  	$pro_desc = $row_product['product_desc'];

  	$pro_img1 = $row_product['product_img1'];

  	$pro_img2 = $row_product['product_img2'];

  	$pro_img3 = $row_product['product_img3'];

  	$pro_label = $row_product['product_label'];

  	$pro_psp_price = $row_product['product_psp_price'];

  	$pro_features = $row_product['product_features'];

  	$pro_video = $row_product['product_video'];

    $pro_seo_desc = $row_product['product_seo_desc'];

    $pro_weight = $row_product['product_weight'];

    $pro_keywords = $row_product['product_keywords'];

  	$status = $row_product['status'];

    $pro_url = $row_product['product_url'];

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

  	$get_p_cat = "select * from product_categories where p_cat_id='$p_cat_id'";

  	$run_p_cat = mysqli_query($con,$get_p_cat);

  	$row_p_cat = mysqli_fetch_array($run_p_cat);

  	$p_cat_title = $row_p_cat['p_cat_title'];

    $get_manufacturer = "select * from manufacturers where manufacturer_id='$pro_manufacturer'";
    $run_manufacturer = mysqli_query($con,$get_manufacturer);
    $row_manufacturer = mysqli_fetch_array($run_manufacturer);
    $manufacturer_image = $row_manufacturer['manufacturer_image'];
    $manufacturer_name = $row_manufacturer['manufacturer_title'];


    $select_product_stock = "select * from products_stock where product_id='$pro_id'";

    $run_product_stock = mysqli_query($con, $select_product_stock);

    $row_product_stock = mysqli_fetch_array($run_product_stock);

    $enable_stock = $row_product_stock["enable_stock"];
    $stock_status = $row_product_stock["stock_status"];
    $stock_quantity = $row_product_stock["stock_quantity"];
    $allow_backorders = $row_product_stock["allow_backorders"];

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
					Shporta Totali: <?php total_price();?> Lekë
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
					<a href="shop.php">Dyqani</a>
				</li>

				<li>
					<?php if(!empty($p_cat_id)) {?>
					   <a href="shop.php?p_cat=<?php echo "$p_cat_id"; ?>"> <?php echo "$p_cat_title"; ?></a>
					<?php } ?>
               </li>

               <?php if(!empty($pro_title)) {?>
                  <li> <?php echo "$pro_title";?></li>
               <?php } ?>

			</ul><!-- breadcrumb ends-->

		</div><!-- col-md-12 ends-->


		  <div class="col-md-12"><!-- col-md-12 starts-->

		  	<div class="row" id="productMain"><!-- row starts-->

		  		<div class="col-sm-7 col-xs-12"><!-- col-sm-6 starts-->

		  			<div id="mainImage"><!-- mainImage starts-->

              <div class="col-md-4 hidden-sm hidden-xs" id="thumbs"><!-- col-md-4 starts-->
                <ul class="list-unstyled">
                  <li>
                    <a href="#" class="thumb">

                      <img src="admin_area/product_images/<?php echo "$pro_img1";?>" class="img-responsive">

                    </a>
                  </li>
                  <li>
                    <?php if(!empty($pro_img2)){ ?>


                      <a href="#" class="thumb">

                        <img src="admin_area/product_images/<?php echo "$pro_img2";?>" class="img-responsive">

                      </a>

                  <?php } ?>
                  </li>
                  <li>
                    <?php if(!empty($pro_img3)){ ?>

                        <a href="#" class="thumb">

                          <img src="admin_area/product_images/<?php echo "$pro_img3";?>" class="img-responsive">

                        </a>

                    <?php } ?>
                  </li>
                </ul>

              </div><!-- col-md-4 ends-->


		  				<div id="myCarousel" class="carousel slide col-md-8" data-ride="carousel">

		  					<ol class="carousel-indicators"><!-- mcarousel-indicators starts-->

		  						<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                  <?php if(!empty($pro_img2)){ ?>
		  						<li data-target="#myCarousel" data-slide-to="1"></li>
                  <?php } ?>

                  <?php if(!empty($pro_img3)){ ?>
		  						<li data-target="#myCarousel" data-slide-to="2"></li>
                  <?php } ?>
		  					</ol><!-- mcarousel-indicators ends-->

		  					<div class="carousel-inner"><!-- carousel-inner starts-->

		  						<div class="item active">
		  							<center>
		  								<img src="admin_area/product_images/<?php echo "$pro_img1";?>" class="img-responsive">
		  							</center>

		  						</div>
                  <?php if(!empty($pro_img2)){ ?>
		  						<div class="item">
		  							<center>
		  								<img src="admin_area/product_images/<?php echo "$pro_img2";?>" class="img-responsive">
		  							</center>

		  						</div>
                  <?php } ?>
                  <?php if(!empty($pro_img3)){ ?>
		  						<div class="item">
		  							<center>
		  								<img src="admin_area/product_images/<?php echo "$pro_img3";?>" class="img-responsive">
		  							</center>

		  						</div>
                  <?php } ?>
		  				  </div><!-- carousel-inner ends-->

		  				  <a href="#myCarousel" class="left carousel-control" data-slide="prev"><!-- left carousel-control starts-->

		  				  	<span class="glyphicon glyphicon-chevron-left"></span>
		  				  	<span class="sr-only"> Previous </span>

		  				  </a><!-- left carousel-control ends-->


		  				  <a href="#myCarousel" class="right carousel-control" data-slide="next"><!-- right carousel-control starts-->

		  				  	<span class="glyphicon glyphicon-chevron-right"></span>
		  				  	<span class="sr-only"> Next </span>

		  				  </a><!-- right carousel-control ends-->


		  				</div>

				  	</div><!-- mainImage ends-->

				  	<?php echo "$product_label"; ?>

		  		</div><!-- col-sm-6 ends-->

          <div class="col-sm-5 col-xs-12"><!-- col-sm-6 starts-->

            <div class="box"><!-- box starts-->

            	<h1 class="prod-title text-left"> <?php echo "$pro_title";?></h1>
              <p class="brandname text-left"> <img src="admin_area/other_images/<?php echo $manufacturer_image;?>" width="210" height="80"> </p>
              <p class="text-left code-lab"><strong>Kodi: </strong> <?php echo "$pro_code"; ?></p>
              <p class="stock-caption text-success text-left"><!-- stock-caption text-success text-center start-->
                <?php
                if (($enable_stock == "yes" or $enable_stock == "no") and $stock_status == "outofstock") { ?>
                  Nuk ka në stok
                <?php }elseif($enable_stock == "yes" and ($stock_status == "instock" or $stock_status == "onbackorder")){ ?>
                  <?php if($stock_quantity >= 4 and ($allow_backorders == "yes" or $allow_backorders == "no")){ ?>
                  <?php echo "I Disponueshëm"; ?>
                 <?php } elseif($stock_quantity < 4 and ($allow_backorders == "yes" or $allow_backorders == "no")){ ?>
                     <?php echo $stock_quantity; ?> Produkte në stok (Por mund te porositet!)
                  <?php } ?>
                <?php } ?>
              </p><!-- stock-caption text-success text-center end-->

            	<?php
              if (isset($_POST['add_cart'])) {

                 $ip_add = getRealUserIp();

                 $p_id = $pro_id;

                 $product_qty = $_POST['product_qty'];

                 $check_product = "select * from cart where ip_add='$ip_add' AND p_id='$p_id'";

                 $run_check = mysqli_query($con,$check_product);

                 if (mysqli_num_rows($run_check)>0) {

                     echo "<script>alert ('Ky produkt është shtuar tashmë në shportë!')</script>";
                     echo "<script>window.open('$pro_url','_self')</script>";
                 }
                 else{

                  $get_price = "select * from products where product_id='$p_id' ";

                  $run_price = mysqli_query($con,$get_price);

                  $row_price = mysqli_fetch_array($run_price);

                  $pro_price = $row_price['product_price'];

                  $pro_psp_price = $row_price['product_psp_price'];

                  $pro_label = $row_price['product_label'];

                  if ($pro_label == "Oferte" or $pro_label == "I Ri") {

                    $product_price = $pro_psp_price;

                  } else {

                    $product_price = $pro_price;
                  }

                  $query = "insert into cart (p_id,ip_add,qty,p_price,product_weight) values ('$p_id','$ip_add','$product_qty', '$product_price','$pro_weight')";

                  $run_query = mysqli_query($con,$query);

                  echo "<script>window.open('$pro_url','_self')</script>";
                 }

              }
               ?>

            	<form action="" method="post" class="form-horizontal"><!-- form-horizontal starts-->

            		<?php
            			if ($status == "product") {

            		 ?>

                 <div class="form-group"><!--Product form-group starts-->

                      <label class="control-label quantity-lab text-left"> Sasia</label>
                          <div class="def-number-input number-input safari_only">
            							  <label onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="minus"></label>
            							  <input class="quantity" min="1" name="product_qty" value="1" type="number">
            							  <label onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></label>
            							</div>

                     </div><!--Product form-group end-->

                <?php } else{ ?>

    	          <div class="form-group"><!-- Bundle form-group starts-->
                    <label class="control-label quantity-lab text-left"> Sasia</label>
                     	 <div class="def-number-input number-input safari_only">
          							  <label onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="minus"></label>
          							  <input class="quantity" min="1" name="product_qty" value="1" type="number">
          							  <label onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></label>
    		                </div>
                </div><!--Bundle form-group end-->

                <?php } ?>

                 <?php

                 if ($status == "product") {

                 	if ($pro_label == "Oferte" or $pro_label == "I Ri") {

                 		echo "<p class='price'>
                          <del> $pro_price Lekë</del> |
                          $pro_psp_price Lekë
                 		</p> ";
                 	} else {
                 		echo "<p class='price'>
                          $pro_price Lekë

                 		</p> ";
                 	}


                 	} else {

                     if ($pro_label == "Oferte" or $pro_label == "I Ri") {

                 		echo "<p class='price'>
                          <del> $pro_price Lekë</del> |
                          $pro_psp_price Lekë
                 		</p> ";
                 	} else {
                 		echo "<p class='price'>
                          $pro_price Lekë

                 		</p> ";

                 	}
                 }

                  ?>

                 <p class="text-left buttons"><!-- text-center buttons starts-->

                 	 <button class="btn btn-primary" type="submit" name="add_cart">

                 	 	<i class="fa fa-shopping-cart"></i> Shto në Shportë

                 	 </button>
                   <button class="btn btn-primary" type="submit" name="add_wishlist">

                 	 	<i class="fa fa-heart"></i> Shto në Listën e Dëshirave

                 	 </button>

                   <?php
                   if (isset($_POST['add_wishlist'])) {
                     if (!isset($_SESSION['customer_email'])) {
                       echo "<script>alert('Ju duhet të logoheni për të shtuar Produkte në Listën e Dëshirave!')</script>";
                       echo "<script>window.open('checkout.php','_self')</script>";
                     } else {
                       $customer_session = $_SESSION['customer_email'];
                       $get_customer = "select * from customers where customer_email='$customer_session'";
                       $run_customer = mysqli_query($con, $get_customer);
                       $row_customer = mysqli_fetch_array($run_customer);
                       $customer_id = $row_customer['customer_id'];
                       $select_wishlist = "select * from wishlist where customer_id='$customer_id' AND
                       product_id='$pro_id'";
                       $run_wishlist = mysqli_query($con, $select_wishlist);
                       $check_wishlist = mysqli_num_rows($run_wishlist);
                       if ($check_wishlist == 1) {
                         echo "<script>alert('Ky produkt është shtuar tashmë në Listën e Dëshirave!')</script>";
                         echo "<script>window.open('$pro_url','_self')</script>";
                       }else {
                         $insert_wishlist = "insert into wishlist (customer_id,product_id) values ('$customer_id','$pro_id')";
                         $run_wishlist = mysqli_query($con,$insert_wishlist);
                         if ($run_wishlist) {
                           echo "<script>alert('Produkti u shtua në Listën e Dëshirave!')</script>";
                           echo "<script>window.open('$pro_url','_self')</script>";
                         }
                       }
                     }
                   }
                    ?>

                 </p><!-- text-center buttons ends-->

            	</form><!-- form-horizontal ends-->

            </div><!-- box ends-->

        </div><!-- col-sm-6 ends-->


		  	</div><!-- row ends-->




			<div class="row">

			<div class="col-md-12">


		  	 <div class="box description-box col-md-12 col-xs-12" id="details"><!-- box starts-->
				    <?php include("productincludes/product_tabs.php"); ?>

           </div><!-- box ends-->
           </div>
           </div>

           <?php
				if ($status == "product") {

			 ?>

                  <div class="box interesting col-md-12"><!-- box starts-->

	                   <div class="headlines"><!-- headlines starts-->

	                  		<h3 class="text-left"> Mund tju interesojnë edhe këto Produkte</h3>

	                  	</div><!-- headlines ends-->

                  	</div><!-- box ends-->

                  <div id="row same-height-row"><!-- row same-height-row starts-->

<?php

  $get_products = "select * from products order by rand() LIMIT 0,4";

  $run_products = mysqli_query($con,$get_products);

  while ($row_products = mysqli_fetch_array($run_products)) {

  	$pro_id = $row_products['product_id'];
    $pro_title = $row_products['product_title'];
    $pro_price = $row_products['product_price'];
    $pro_img1 = $row_products['product_img1'];
    $pro_label = $row_products['product_label'];

    $manufacturer_id = $row_products['manufacturer_id'];

    $pro_psp_price = $row_products['product_psp_price'];

    $pro_url = $row_products['product_url'];


// Get manufacturer title
    $get_manufacturer = "select * from manufacturers where manufacturer_id='$manufacturer_id' ";

    $run_manufacturer = mysqli_query($db,$get_manufacturer);

    $row_manufacturer = mysqli_fetch_array($run_manufacturer);

    $manufacturer_name = $row_manufacturer['manufacturer_title'];


    if ($pro_label == "Oferte" or $pro_label == "I Ri") {

      $product_price = "<del> $pro_price Lekë </del>";

      $product_psp_price = "| $pro_psp_price Lekë";
    }
    else{

      $product_psp_price = "";

      $product_price ="$pro_price Lekë";
    }

    $select_product_stock = "select * from products_stock where product_id='$pro_id'";
    $run_product_stock = mysqli_query($db, $select_product_stock);
    $row_product_stock = mysqli_fetch_array($run_product_stock);
    $stock_status = $row_product_stock["stock_status"];

    if ($stock_status == "outofstock") {
      $outofstock_label = "<div class='out-of-stock-label'>Nuk ka në stok </div>";
    }else {
      $outofstock_label="";
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
          <div class='col-md-3 col-sm-6 center-responsive'>
           <div class='product'>
              <a class='crop' href='$pro_url'>
                 <img src='admin_area/product_images/$pro_img1' class='img-responsive'>
                 $outofstock_label
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

                 <?php } else {?>

                 	<div class="box interesting col-md-12"><!-- box starts-->
                 		<div class="headlines"><!-- headlines starts-->

	                  		<h3 class="text-center"> Pajisje Set</h3>

	                  	</div><!-- headlines ends-->
                 	</div><!-- box starts-->

	<?php
		$get_bundle_product_relation = "select * from bundle_product_relation where bundle_id='$pro_id' ";

		$run_bundle_product_relation = mysqli_query($con,$get_bundle_product_relation);

		while ($row_bundle_product_relation = mysqli_fetch_array($run_bundle_product_relation)) {
			$bundle_product_relation_product_id = $row_bundle_product_relation['product_id'];

			$get_products = "select * from products where product_id='$bundle_product_relation_product_id' ";
			$run_products = mysqli_query($con,$get_products);

while ($row_products = mysqli_fetch_array
	($run_products)) {
	$pro_id = $row_products['product_id'];
    $pro_title = $row_products['product_title'];
    $pro_price = $row_products['product_price'];
    $pro_img1 = $row_products['product_img1'];
    $pro_label = $row_products['product_label'];

    $manufacturer_id = $row_products['manufacturer_id'];

    $pro_psp_price = $row_products['product_psp_price'];

    $pro_url = $row_products['product_url'];

//Get manufacturer title
    $get_manufacturer = "select * from manufacturers where manufacturer_id='$manufacturer_id' ";

    $run_manufacturer = mysqli_query($db,$get_manufacturer);

    $row_manufacturer = mysqli_fetch_array($run_manufacturer);

    $manufacturer_name = $row_manufacturer['manufacturer_title'];

    if ($pro_label == "Oferte" or $pro_label == "I Ri") {

      $product_price = "<del> $pro_price Lekë </del>";

      $product_psp_price = "| $pro_psp_price Lekë";
    }
    else{

      $product_psp_price = "";

      $product_price ="$pro_price Lekë";
    }

    $select_product_stock = "select * from products_stock where product_id='$pro_id'";
    $run_product_stock = mysqli_query($db, $select_product_stock);
    $row_product_stock = mysqli_fetch_array($run_product_stock);
    $stock_status = $row_product_stock["stock_status"];

    if ($stock_status == "outofstock") {
      $outofstock_label = "<div class='out-of-stock-label'>Nuk ka në stok </div>";
    }else {
      $outofstock_label="";
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
          <div class='col-md-3 col-sm-6 center-responsive'>
           <div class='product'>
              <a class='crop' href='$pro_url'>
                 <img src='admin_area/product_images/$pro_img1' class='img-responsive'>
                 $outofstock_label
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
                 		}
                 	 ?>

                 <?php } ?>

		  	</div><!-- col-md-12 ends-->

   		</div><!-- container ends-->

	</div><!-- content ends-->

</div><!--container ends-->

<?php
 include("includes/footer.php")
?>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>


</html>

<?php } ?>

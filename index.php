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
			include("includes/navbar-menu.php");
			 ?>

		</div><!-- container ends-->
	</div><!-- navbar navbar-default ends-->
	<div class="container-fluid" id="slider"><!-- container starts-->
		<div class="carosel"><!-- carosel starts-->
			<div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel"><!-- carousel slide starts-->

				<ol class="carousel-indicators"><!-- carousel-indicators starts-->

					<li data-target="#myCarousel" data-slide-to="0" class="active"></li>

					<li data-target="#myCarousel" data-slide-to="1"></li>

					<li data-target="#myCarousel" data-slide-to="2"></li>

					<li data-target="#myCarousel" data-slide-to="3"></li>
				</ol><!-- carousel-indicators endss-->
				<div class="carousel-inner"><!-- carousel-inner Starts-->
					<?php
					$get_slides = "select * from slider LIMIT 0,1";
					$run_slides = mysqli_query($con,$get_slides);
					while ($row_slides=mysqli_fetch_array($run_slides)) {
						$slide_name = $row_slides['slide_name'];
						$slide_image = $row_slides['slide_image'];
						$slide_url = $row_slides['slide_url'];
						echo "
						<div class='item active'>
						<a href='$slide_url' target='blank'><img src='admin_area/slides_images/$slide_image'></a>
						</div>
						";
					}
					?>
					<?php
					$get_slides = "select * from slider LIMIT 1,3";
					$run_slides = mysqli_query($con,$get_slides);
					while ($row_slides = mysqli_fetch_array($run_slides)) {
						$slide_name = $row_slides['slide_name'];
						$slide_image = $row_slides['slide_image'];
						$slide_url = $row_slides['slide_url'];
						echo "
						<div class='item'>
						<a href='$slide_url' target='blank'><img src='admin_area/slides_images/$slide_image'></a>
						</div>
						";
					}
					?>
				</div><!-- carousel-inner ends-->
				<a class="left carousel-control" href="#myCarousel" data-slide="prev"><!--left carousel-control starts-->

					<span class="glyphicon glyphicon-menu-left"></span>
					<span class="sr-only">Previous</span>
				</a><!-- left carousel-control ends-->
				<a class="right carousel-control" href="#myCarousel" data-slide="next"><!--right carousel-control starts-->

					<span class="glyphicon glyphicon-menu-right"></span>
					<span class="sr-only">Next</span>
				</a><!--right carousel-control ends-->
			</div><!-- carousel slide ends-->

		</div><!-- carosel ends-->

	</div><!-- container ends-->

	<!-- Product Slider Start-->

	<div class="container"><!-- container starts-->
		<div class="block-title-tabs clearfix">
			<span class="title"> Produktet Kryesore </span>
		</div>
	<div class="row">
	<div class="carousel product-carousel"><!-- carosel starts-->
		<div id="my2Carousel" class="carousel slide second-slide" data-ride="carousel" data-interval="5000"><!-- carousel slide starts-->

		<div class="carousel-inner"><!-- carousel-inner Starts-->
	<?php

    $get_products = "select * from products order by rand() LIMIT 0,1";

    $run_products = mysqli_query($con,$get_products);

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
          } ?>



       <?php

  $get_products = "select * from products order by rand() LIMIT 1,4";

  $run_products = mysqli_query($con,$get_products);

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
        <div class='item'>
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

                  		 ?>
				</div><!-- carousel-inner ends-->
				<a class="left carousel-control" href="#my2Carousel" data-slide="prev"><!--left carousel-control starts-->

					<span class="glyphicon glyphicon-chevron-left"></span>
					<span class="sr-only">Previous</span>
				</a><!-- left carousel-control ends-->
				<a class="right carousel-control" href="#my2Carousel" data-slide="next"><!--right carousel-control starts-->

					<span class="glyphicon glyphicon-chevron-right"></span>
					<span class="sr-only">Next</span>
				</a><!--right carousel-control ends-->
			</div><!-- carousel slide ends-->

		</div><!-- carosel ends-->
	  </div>
	</div><!-- container ends-->

	<!-- Product Slider end-->

	<div id="advantages"><!-- advantages starts-->
		<div class="container wow animated fadeInUp slow"><!-- container starts-->
			<div class="same-height-row"><!-- same-height-row starts-->

				<?php

					$get_boxes = "select * from boxes_section ";

					$run_boxes = mysqli_query($con,$get_boxes);

					while ($run_boxes_section = mysqli_fetch_array($run_boxes)) {

						$box_id = $run_boxes_section['box_id'];

						$box_title = $run_boxes_section['box_title'];

						$box_desc = $run_boxes_section['box_desc'];


				 ?>
				<div class="col-sm-4"><!-- col-sm-4 starts-->
					<div class="box same-height"><!-- box same-height starts-->
						<div class="icon">
							<i class="fa fa-heart"></i>

						</div>
						<h3><a href="#"><?php echo "$box_title"; ?></a></h3>
						<p>
							<?php echo "$box_desc"; ?>
						</p>

					</div><!-- box same-height ends-->

				</div><!-- col-sm-4 ends-->

				<?php } ?>
			</div><!-- same-height-row ends-->

		</div><!-- container ends-->

	</div><!-- advantages ends-->
	<div id="hot"><!--hot starts-->
		<div class="box"><!--box starts-->
			<div class="container"><!--container starts-->
				<div class="col-md-12"><!--col-md-12 starts-->
					<h2 class="wow animated shake slow">Produkte të Reja</h2>

				</div><!--col-md-12 ends-->

			</div><!--container ends-->

		</div><!--box ends-->

	</div><!--hot ends-->
	<div id="content" class="container"><!--container starts-->
		<div class="row"><!--row starts-->
			<?php
			getPro();
			?>
		</div><!--row ends-->
	</div><!--container ends-->

<div class="container brand-start"><!-- Brand Carousel start-->
	<div class="block-title-tabs-2 clearfix">
			<span class="title"> Markat Tona </span>
		</div>
	<div class="col-md-12 brand-carousel">
		<div id="my3Carousel" class="carousel slide third-slide" data-type="multi" data-ride="carousel" data-interval="4000">
		  <div class="carousel-inner">

		  	<?php
					$get_manufacturer = "select * from manufacturers limit 0,1";
					$run_manufacturer = mysqli_query($con,$get_manufacturer);
					while ($row_manufacturer = mysqli_fetch_array($run_manufacturer)) {
						$manufacturer_image = $row_manufacturer['manufacturer_image'];
						echo "

						<div class='item active'>
					      <div class='col-md-2 col-sm-6 col-xs-12'><a href='#'><img src='admin_area/other_images/$manufacturer_image' class='img-responsive'></a></div>
					    </div>
						";
					}
					?>

					<?php
					$get_manufacturer = "select * from manufacturers limit 1,5";
					$run_manufacturer = mysqli_query($con,$get_manufacturer);
					while ($row_manufacturer = mysqli_fetch_array($run_manufacturer)) {
						$manufacturer_image = $row_manufacturer['manufacturer_image'];
						echo "

						<div class='item'>
					      <div class='col-md-2 col-sm-6 col-xs-12'><a href='#'><img src='admin_area/other_images/$manufacturer_image' class='img-responsive'></a></div>
					    </div>
						";
					}
					?>

		  </div>
	  <a class="left carousel-control" href="#my3Carousel" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
	  <a class="right carousel-control" href="#my3Carousel" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
	  </div>
	 </div>
</div><!-- Brand Carousel end-->

	<?php
	include("includes/footer.php")
	?>
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script>
		$(document).ready(function(){
			$('.third-slide .item').each(function(){
			  var next = $(this).next();
			  if (!next.length) {
			    next = $(this).siblings(':first');
			  }
			  next.children(':first-child').clone().appendTo($(this));

			  for (var i=0;i<4;i++) {
			    next=next.next();
			    if (!next.length) {
			        next = $(this).siblings(':first');
			  	}

		    next.children(':first-child').clone().appendTo($(this));
		  }
		});
		});
    </script>
    <script>
		$(document).ready(function(){
			$('.second-slide .item').each(function(){
			  var next = $(this).next();
			  if (!next.length) {
			    next = $(this).siblings(':first');
			  }
			  next.children(':first-child').clone().appendTo($(this));

			  for (var i=0;i<2;i++) {
			    next=next.next();
			    if (!next.length) {
			        next = $(this).siblings(':first');
			  	}

		    next.children(':first-child').clone().appendTo($(this));
		  }
		});
		});
    </script>
</body>
</html>

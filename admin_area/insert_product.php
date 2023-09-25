
<?php

if (!isset($_SESSION['admin_email'])) {

  echo "<script>window.open('login.php','_self') </script>";
}

else {

  if (!isset($_SESSION["random_id"])) {
    $random_id = mt_rand(1000, 10000);
    $_SESSION["random_id"] = $random_id;
  }else {
    $random_id = $_SESSION["random_id"];
  }

?>

<!DOCTYPE html>

<html>

<head>

	<title> Shto Produkte </title>


  <script src="https://cdn.tiny.cloud/1/s41vpdg5vtlq2pveudurinw0hi27qqtzwnsh4fdmiszn2vt6/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script>tinymce.init({selector:'#product_description, #product_features'});</script>



</head>

<body>

  <div class="row"><!-- row starts -->
  	<div class="col-lg-12"><!-- col-lg-12 starts -->
  		<ol class="breadcrumb"><!-- breadcrumb starts -->
  			<li class="active">
  				<i class="fa fa-dashboard"></i> Dashboard / Shto Produkte
  			</li>
  		</ol><!-- breadcrumb ends -->
  	</div><!-- col-lg-12 ends -->
   </div><!-- row ends -->

  <div class="row"><!-- 2 row starts -->
      <div class="col-lg-12"><!-- col-lg-12 starts -->
         <div class="panel panel-default"><!--panel panel-default  starts -->
         	<div class="panel-heading"><!-- panel-heading  starts -->
         		<h3 class="panel-title">
         			<i class="fa fa-money fa-fw"></i> Shto Produkte
         		</h3>
         	</div><!-- panel-heading ends -->

         	<div class="panel-body"><!-- panel-body starts -->
         		<form method="post" enctype="multipart/form-data"><!-- form starts -->
              <div class="row"><!--row start -->
                <div class="col-md-9 col-sm-12"><!--col-md-9 start -->

                  <div class="form-group"><!-- form-group starts -->
             				<label class="control-label"> Emërtimi Produktit </label>
             					<input type="text" name="product_title" class="form-control" required>
             			</div><!-- form-group ends -->

                  <div class="form-group"><!-- form-group starts -->
             				<label class="control-label"> Përshkrimi Seo i Produktit </label>
             					<textarea name="product_seo_description" class="form-control" maxlength="230"
                      placeholder="Most search engines use a maximum of 230 chars for the description."></textarea>
             			</div><!-- form-group ends -->

                  <div class="form-group"><!-- form-group starts -->
                    <label class="control-label"> Produkt URL </label>
                      <input type="text" name="product_url" class="form-control" required>
                      <br>
                      <p style="font-size: 15px; font-weight: bold;">
                        Shembull Produkt Url : Samsung-RB37J5820SA
                      </p>
                  </div><!-- form-group ends -->

                  <div class="form-group"><!-- form-group starts -->
                    <label class="control-label"> Kodi Produktit </label>
                      <input type="text" name="product_code" class="form-control" required>
                  </div><!-- form-group ends -->

                  <div class="form-group"><!-- form-group starts -->
                    <label class="control-label"> Te dhenat e Produktit </label>
                      <ul class="nav nav-tabs"><!--nav nav-tabs start -->
                        <li class="active">
                          <a data-toggle="tab" href="#description"> Pershkrimi i Produktit</a>
                        </li>

                        <li>
                          <a data-toggle="tab" href="#features"> Karakteristikat</a>
                        </li>

                        <li>
                          <a data-toggle="tab" href="#video"> Video</a>
                        </li>
                      </ul><!--nav nav-tabs end -->

                      <div class="tab-content"><!--tab-content start -->
                        <div id="description" class="tab-pane fade in active"><!--tab-pane start -->
                          <br>
                          <textarea name="product_desc" class="form-control" rows="15" id="product_description"></textarea>
                        </div><!--tab-pane end -->

                        <div id="features" class="tab-pane fade in"><!--tab-pane start -->
                          <br>
                          <textarea name="product_features" class="form-control" rows="15" id="product_features"></textarea>
                        </div><!--tab-pane end -->

                        <div id="video" class="tab-pane fade in"><!--tab-pane start -->
                          <br>
                          <textarea name="product_video" class="form-control" rows="15" id="product_video"></textarea>
                        </div><!--tab-pane end -->

                      </div><!--tab-content end -->

                  </div><!-- form-group ends -->

                  <div class="form-group"><!-- form-group starts -->
             				<label class="control-label"> Pesha Produktit <small>(kg)</small> </label>
             					<input type="text" name="product_weight" class="form-control">
             				</div><!-- form-group ends -->

                  <div class="form-group"><!-- form-group starts -->
             				<label class="control-label"> Çmimi Produktit </label>
             					<input type="text" name="product_price" class="form-control" required>
             				</div><!-- form-group ends -->

                  <div class="form-group"><!-- form-group starts -->
                    <label class="control-label"> Çmimi i Zbritur </label>
                      <input type="text" name="psp_price" class="form-control">
                  </div><!-- form-group ends -->

                </div><!--col-md-9 end -->

                <div class="col-md-3 col-sm-12"><!--col-md-3 start -->

                  <div class="form-group"><!-- form-group starts -->
                     <label class="control-label"> Zgjidhni Marken </label>
                       <select class="form-control" name="manufacturer"><!-- select manufacturer starts -->
                         <option>Zgjidhni Marken</option>
                         <?php

                         $get_manufacturer = "select * from manufacturers ";

                         $run_manufacturer = mysqli_query($con,$get_manufacturer);

                         while ($row_manufacturer = mysqli_fetch_array($run_manufacturer)) {

                           $manufacturer_id = $row_manufacturer['manufacturer_id'];

                           $manufacturer_title = $row_manufacturer['manufacturer_title'];

                           echo "<option value='$manufacturer_id'>$manufacturer_title</option>";
                           }
                          ?>
                       </select><!-- select manufacturer starts -->
                   </div><!-- form-group ends -->

              			<div class="form-group"><!-- form-group starts -->
              				<label class="control-label"> Kategoria Produktit </label>
              					<select name="product_cat" class="form-control">
              						<option> Zgjidhni një Kategori Produkti </option>
              						<?php

                          $get_p_cats = "select * from product_categories";
                          $run_p_cats = mysqli_query($con,$get_p_cats);

                          while ($row_p_cats = mysqli_fetch_array($run_p_cats)) {
                          	$p_cat_id = $row_p_cats['p_cat_id'];
                          	$p_cat_title = $row_p_cats['p_cat_title'];

                           echo "<option value='$p_cat_id'> $p_cat_title </option>";
                          }

              						?>
              					</select>
              			</div><!-- form-group ends -->

              			<div class="form-group"><!-- form-group starts -->
              				<label class="control-label"> Kategori </label>
              					<select name="cat" class="form-control">
                         <option> Zgjidhni Kategorine </option>

                         <?php
                           $get_cat = "select * from categories";
                           $run_cat = mysqli_query($con,$get_cat);

                           while ($row_cat=mysqli_fetch_array($run_cat)) {
                              $cat_id = $row_cat['cat_id'];
                              $cat_title = $row_cat['cat_title'];

                              echo "<option value='$cat_id'> $cat_title </option>";
                           }
                         ?>
                       </select>
              			</div><!-- form-group ends -->

              			<div class="form-group"><!-- form-group starts -->
              				<label class="control-label"> Foto Produktit 1 </label>
              					<input type="file" name="product_img1" class="form-control" required>
              			</div><!-- form-group ends -->

              			<div class="form-group"><!-- form-group starts -->
              				<label class="control-label"> Foto Produktit 2 </label>
              					<input type="file" name="product_img2" class="form-control">
              			</div><!-- form-group ends -->

              			<div class="form-group"><!-- form-group starts -->
              				<label class="control-label"> Foto Produktit 3 </label>
              					<input type="file" name="product_img3" class="form-control">
              			</div><!-- form-group ends -->

              			<div class="form-group"><!-- form-group starts -->
              				<label class="control-label"> Keywords te Produktit </label>
              					<input type="text" name="product_keywords" class="form-control">
              			</div><!-- form-group ends -->

                   <div class="form-group"><!-- form-group starts -->
                     <label class="control-label"> Etiketa e Produktit </label>
                       <input type="text" name="product_label" class="form-control">
                   </div><!-- form-group ends -->

                </div><!--col-md-3 end -->

              </div><!--row end -->

              <div class="form-group" id="product-stock-management"><!-- form-group product-stock-management start-->
                <label> Product Inventory Stock Management</label>
                <div class="panel panel-default"><!-- panel panel-default start-->
                  <div class="panel-heading"><!-- panel-heading start-->
                    <strong> Inventory - Stock Options</strong>
                  </div><!-- panel-heading end-->
                  <div class="panel-body"><!-- panel-body start-->
                    <div class="row"><!-- row start-->
                      <div class="col-sm-6" id="stock-status"><!-- "col-sm-6 start-->
                        <div class="form-group"><!-- form-group start-->
                          <label> Stock Status</label>
                          <select class="form-control" name="stock_status" required>
                            <option value="instock">In Stock</option>
                            <option value="outofstock">Out of Stock</option>
                            <option value="onbackorder">On Backorder</option>
                          </select>
                        </div><!-- form-group end-->
                      </div><!-- "col-sm-6 end-->
                      <div class="col-sm-6"><!-- "col-sm-6 start-->
                        <div class="form-group"><!-- form-group start-->
                          <label> Enable stock management at product level</label>
                          <div class="radio">
                            <label>
                              <input type="radio" name="enable_stock" value="yes" required> Yes
                            </label>
                            <label>
                              <input type="radio" name="enable_stock" value="no" checked required> No
                            </label>
                          </div>
                        </div><!-- form-group end-->
                      </div><!-- "col-sm-6 end-->
                    </div><!-- row end-->

                    <div class="row" id="stock-management-row"><!-- row stock-management-row start-->
                      <div class="col-sm-6"><!-- "col-sm-6 start-->
                        <div class="form-group"><!-- form-group start-->
                          <label> Stock Quantity</label>
                          <input type="number" name="stock_quantity" value="0" class="form-control" required>
                        </div><!-- form-group end-->
                      </div><!-- "col-sm-6 end-->
                      <div class="col-sm-6"><!-- "col-sm-6 start-->
                        <div class="form-group"><!-- form-group start-->
                          <label> Allow Backorders</label>
                          <select class="form-control" name="allow_backorders" required>
                            <option value="no"> Do not Allow</option>
                            <option value="notify"> Allow but notify customer</option>
                            <option value="yes"> Allow</option>
                          </select>
                        </div><!-- form-group end-->
                      </div><!-- "col-sm-6 end-->
                    </div><!-- row stock-management-row end-->

                  </div><!-- panel-body end-->
                </div><!-- panel panel-default end-->
              </div><!-- form-group product-stock-management end-->

              <div class="form-group"><!-- form-group starts -->
                <label class="control-label"></label>
                  <input type="submit" name="submit" value="Shto Produkt" class="btn btn-primary form-control">
              </div><!-- form-group ends -->

         		</form><!-- form-horizontal ends -->

         	</div><!-- panel-body ends -->

         </div><!--panel panel-default ends -->

      </div><!-- col-lg-12 ends -->

  </div><!-- 2 row ends -->

<script>
  $(document).ready(function() {
    //Product stock management code start
    $("#stock-management-row").hide();
    $("input[name='enable_stock']").click(function(){
      var radio_value = $(this).val();
      if (radio_value == "yes") {
        $("#stock-management-row").show();
        $("#stock-status").hide();
      } else if(radio_value == "no"){
        $("#stock-management-row").hide();
        $("#stock-status").show();
      }
    });

    //Product stock management code end
  });
</script>

</body>
</html>

<?php
 if (isset($_POST['submit'])) {

   $product_title = mysqli_real_escape_string($con, $_POST['product_title']);
   $product_code = mysqli_real_escape_string($con, $_POST['product_code']);
   $product_cat = mysqli_real_escape_string($con, $_POST['product_cat']);
   $cat = mysqli_real_escape_string($con, $_POST['cat']);
   $manufacturer_id = mysqli_real_escape_string($con, $_POST['manufacturer']);
   $product_price = mysqli_real_escape_string($con, $_POST['product_price']);
   $product_desc = mysqli_real_escape_string($con, $_POST['product_desc']);
   $product_keywords = mysqli_real_escape_string($con, $_POST['product_keywords']);

   $psp_price = trim(mysqli_real_escape_string($con,$_POST['psp_price']));

   $product_label = trim(mysqli_real_escape_string($con,$_POST['product_label']));

   $product_url = mysqli_real_escape_string($con, $_POST['product_url']);

   $product_features = mysqli_real_escape_string($con, $_POST['product_features']);

   $product_video = mysqli_real_escape_string($con, $_POST['product_video']);

   $product_seo_description = mysqli_real_escape_string($con, $_POST['product_seo_description']);

   $product_weight = mysqli_real_escape_string($con, $_POST['product_weight']);

   $stock_status = mysqli_real_escape_string($con, $_POST['stock_status']);

   $enable_stock = mysqli_real_escape_string($con, $_POST['enable_stock']);

   $stock_quantity = mysqli_real_escape_string($con, $_POST['stock_quantity']);

   $allow_backorders = mysqli_real_escape_string($con, $_POST['allow_backorders']);

   $status = "product";

   $product_img1 = $_FILES['product_img1']['name'];
   $product_img2 = $_FILES['product_img2']['name'];
   $product_img3 = $_FILES['product_img3']['name'];

   $temp_name1 = $_FILES['product_img1']['tmp_name'];
   $temp_name2 = $_FILES['product_img2']['tmp_name'];
   $temp_name3 = $_FILES['product_img3']['tmp_name'];

   $allowed = array('jpeg','jpg','gif','png');
   $product_img1_extension = pathinfo($product_img1, PATHINFO_EXTENSION);
   $product_img2_extension = pathinfo($product_img2, PATHINFO_EXTENSION);
   $product_img3_extension = pathinfo($product_img3, PATHINFO_EXTENSION);

   if (!in_array($product_img1_extension, $allowed)) {
     echo "<script>alert('Formati i imazhit 1 nuk është i pranueshëm!');</script>";
     $product_img1="";
   } else {
    move_uploaded_file($temp_name1, "product_images/$product_img1");
   }

   if (!empty($product_img2)) {
     if (!in_array($product_img2_extension, $allowed)) {
       echo "<script>alert('Formati i imazhit 2 nuk është i pranueshëm!');</script>";
       $product_img2="";
     } else {
      move_uploaded_file($temp_name2, "product_images/$product_img2");
     }
   }

     if (!empty($product_img3)) {
       if (!in_array($product_img3_extension, $allowed)) {
         echo "<script>alert('Formati i imazhit 3 nuk është i pranueshëm!');</script>";
         $product_img3="";
       } else {
        move_uploaded_file($temp_name3, "product_images/$product_img3");
       }
   }




   $insert_product = "insert into products
   (p_cat_id,cat_id,manufacturer_id,date,product_title,product_seo_desc,product_url,product_code,
   product_img1,product_img2,product_img3,product_price,product_psp_price,product_desc,
   product_features,product_video,product_keywords,product_label,product_weight,status)
   values ('$product_cat', '$cat','$manufacturer_id', NOW(),'$product_title','$product_seo_description',
   '$product_url', '$product_code','$product_img1','$product_img2','$product_img3','$product_price','$psp_price',
    '$product_desc','$product_features', '$product_video' , '$product_keywords','$product_label',
    '$product_weight','$status')";

   $run_product = mysqli_query($con,$insert_product);

   $product_id = mysqli_insert_id($con);

   if ($run_product){
     if ($enable_stock == "yes" and $stock_quantity > 0) {
       $stock_status = "instock";
     }elseif ($enable_stock == "yes" and $allow_backorders == "no") {
      $stock_status = "outofstock";
    }elseif ($enable_stock == "yes" and ($allow_backorders == "yes" and
    $allow_backorders == "notify") and $stock_quantity < 1) {
      $stock_status = "onbackorder";
    }

    $insert_product_stock = "insert into products_stock (product_id, stock_status,enable_stock,
    stock_quantity, allow_backorders) values('$product_id','$stock_status', '$enable_stock',
    '$stock_quantity','$allow_backorders')";

    $run_product_stock = mysqli_query($con, $insert_product_stock);

     echo "<script> alert('Produkti u shtua me sukses')</script>";
     echo "<script>window.open('index.php?view_products','_self')</script>";
   }
 }
?>

<?php } ?>

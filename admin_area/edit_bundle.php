
<?php

if (!isset($_SESSION['admin_email'])) {

  echo "<script>window.open('login.php','_self') </script>";
}

else {

?>

<?php

	if (isset($_GET['edit_bundle'])) {

		$edit_id = $_GET['edit_bundle'];

		$get_p = "select * from products where product_id='$edit_id' ";

		$run_edit = mysqli_query($con,$get_p);

		$row_edit = mysqli_fetch_array($run_edit);

		$p_id = $row_edit['product_id'];

    $random_id = $p_id;

		$p_title = $row_edit['product_title'];

    $p_code = $row_edit['product_code'];

		$p_cat = $row_edit['p_cat_id'];

		$cat = $row_edit['cat_id'];

    $m_id = $row_edit['manufacturer_id'];

		$p_image1 = $row_edit['product_img1'];

		$p_image2 = $row_edit['product_img2'];

		$p_image3 = $row_edit['product_img3'];

		$new_p_image1 = $row_edit['product_img1'];

		$new_p_image2 = $row_edit['product_img2'];

		$new_p_image3 = $row_edit['product_img3'];

		$p_price = $row_edit['product_price'];

		$p_desc = $row_edit['product_desc'];

		$p_keywords = $row_edit['product_keywords'];

    $psp_price = $row_edit['product_psp_price'];

    $p_label = $row_edit['product_label'];

    $p_url = $row_edit['product_url'];

    $p_features = $row_edit['product_features'];

    $p_video = $row_edit['product_video'];

    $p_seo_desc = $row_edit['product_seo_desc'];

    $p_weight = $row_edit['product_weight'];
	}

  $get_manufacturer = "select * from manufacturers where manufacturer_id='$m_id' ";
  $run_manufacturer = mysqli_query($con,$get_manufacturer);

  $row_manfacturer = mysqli_fetch_array($run_manufacturer);

  $manufacturer_id = $row_manfacturer['manufacturer_id'];

  $manufacturer_title = $row_manfacturer['manufacturer_title'];


	$get_p_cat = "select * from product_categories where p_cat_id='$p_cat' ";

	$run_p_cat = mysqli_query($con,$get_p_cat);

	$row_p_cat = mysqli_fetch_array($run_p_cat);

	$p_cat_title = $row_p_cat['p_cat_title'];

	$get_cat = "select * from categories where cat_id='$cat' ";

	$run_cat = mysqli_query($con,$get_cat);

	$row_cat = mysqli_fetch_array($run_cat);

	$cat_title = $row_cat['cat_title'];

  $select_product_stock = "select * from products_stock where product_id='$p_id'";

  $run_product_stock = mysqli_query($con, $select_product_stock);

  $count_product_stock = mysqli_num_rows($run_product_stock);

  if ($count_product_stock == 0) {
    $enable_stock = "no";
    $stock_status = "";
    $stock_quantity = 0;
    $allow_backorders = "";
  } else {
    $row_product_stock = mysqli_fetch_array($run_product_stock);
    $enable_stock = $row_product_stock["enable_stock"];
    $stock_status = $row_product_stock["stock_status"];
    $stock_quantity = $row_product_stock["stock_quantity"];
    $allow_backorders = $row_product_stock["allow_backorders"];
  }

 ?>

<!DOCTYPE html>

<html>

<head>

	<title> Edit Bundle </title>


  <script src="https://cdn.tiny.cloud/1/s41vpdg5vtlq2pveudurinw0hi27qqtzwnsh4fdmiszn2vt6/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script>tinymce.init({selector:'#product_description, #product_features'});</script>

</head>

<body>

  <div class="row"><!-- row starts -->
  	<div class="col-lg-12"><!-- col-lg-12 starts -->
  		<ol class="breadcrumb"><!-- breadcrumb starts -->
  			<li class="active">
  				<i class="fa fa-dashboard"></i> Dashboard / Edit Bundle
  			</li>
  		</ol><!-- breadcrumb ends -->
  	</div><!-- col-lg-12 ends -->
   </div><!-- row ends -->

  <div class="row"><!-- 2 row starts -->
      <div class="col-lg-12"><!-- col-lg-12 starts -->
         <div class="panel panel-default"><!--panel panel-default  starts -->
         	<div class="panel-heading"><!-- panel-heading  starts -->
         		<h3 class="panel-title">
         			<i class="fa fa-money fa-fw"></i> Edit Bundle
         		</h3>
         	</div><!-- panel-heading ends -->

         	<div class="panel-body"><!-- panel-body starts -->
         		<form method="post" enctype="multipart/form-data"><!-- form-horizontal starts -->
              <div class="row"><!-- row starts -->

                <div class="col-md-9 col-sm-12"><!-- col-md-9 starts -->

                  <div class="form-group"><!-- form-group starts -->
             				<label class="control-label"> Bundle Title </label>
             					<input type="text" name="product_title" class="form-control" value="<?php echo $p_title; ?> ">
             			</div><!-- form-group ends -->

                  <div class="form-group"><!-- form-group starts -->
             				<label class="control-label"> Bundle Seo Description </label>
             					<textarea name="product_seo_description" class="form-control" maxlength="230"
                      placeholder="Most search engines use a maximum of 230 chars for the description."><?php echo $p_seo_desc; ?></textarea>
             			</div><!-- form-group ends -->

                  <div class="form-group"><!-- form-group starts -->
                    <label class="control-label"> Bundle URL </label>
                      <input type="text" name="product_url" class="form-control" required value="<?php echo $p_url; ?>">
                      <br>
                      <p style="font-size: 15px; font-weight: bold;">
                        Example Bundle Url : Samsung-RB37J5820SA
                      </p>
                  </div><!-- form-group ends -->

                  <div class="form-group"><!-- form-group starts -->
                    <label class="control-label"> Bundle Code </label>
                      <input type="text" name="product_code" class="form-control" value="<?php echo $p_code; ?> ">
                  </div><!-- form-group ends -->

                  <div class="form-group"><!-- form-group starts -->
                   <label class="control-label"> Bundle Tabs </label>
                     <ul class="nav nav-tabs"><!--nav nav-tabs start -->
                       <li class="active">
                         <a data-toggle="tab" href="#description"> Description</a>
                       </li>

                       <li>
                         <a data-toggle="tab" href="#features"> Features </a>
                       </li>

                       <li>
                         <a data-toggle="tab" href="#video"> Video</a>
                       </li>
                     </ul><!--nav nav-tabs end -->

                     <div class="tab-content"><!--tab-content start -->
                       <div id="description" class="tab-pane fade in active"><!--tab-pane start -->
                         <br>
                         <textarea name="product_desc" class="form-control" rows="15" id="product_description">
                           <?php echo $p_desc; ?>
                         </textarea>
                       </div><!--tab-pane end -->

                       <div id="features" class="tab-pane fade in"><!--tab-pane start -->
                         <br>
                         <textarea name="product_features" class="form-control" rows="15" id="product_features">
                           <?php echo $p_features; ?>
                         </textarea>
                       </div><!--tab-pane end -->

                       <div id="video" class="tab-pane fade in"><!--tab-pane start -->
                         <br>
                         <textarea name="product_video" class="form-control" rows="15" id="product_video">
                           <?php echo $p_video; ?>
                         </textarea>
                       </div><!--tab-pane end -->

                     </div><!--tab-content end -->
                 </div><!-- form-group ends -->

                 <div class="form-group"><!-- form-group starts -->
                   <label class="control-label"> Bundle Weight <small>(kg)</small> </label>
                     <input type="text" name="product_weight" class="form-control" value="<?php echo $p_weight; ?> ">
                   </div><!-- form-group ends -->

                 <div class="form-group"><!-- form-group starts -->
            				<label class="control-label"> Bundle Price </label>
            					<input type="text" name="product_price" class="form-control" value="<?php echo $p_price; ?> ">
            			</div><!-- form-group ends -->

                 <div class="form-group"><!-- form-group starts -->
                   <label class="control-label"> Bundle Sale Price </label>
                     <input type="text" name="psp_price" class="form-control" value="<?php echo $psp_price; ?> ">
                 </div><!-- form-group ends -->

                </div><!-- col-md-9 end -->

                <div class="col-md-3 col-sm-12">

                  <div class="form-group"><!-- form-group starts -->
                    <label class="control-label"> Select Manufacturer </label>
                     <select name="manufacturer" class="form-control">
                       <option value="<?php echo $manufacturer_id;?>"><?php echo "$manufacturer_title"; ?></option>

                       <?php

                          $get_manufacturer = "select * from manufacturers ";

                          $run_manufacturer = mysqli_query($con,$get_manufacturer);

                          while ($row_manfacturer = mysqli_fetch_array($run_manufacturer)) {

                            $manufacturer_id = $row_manfacturer['manufacturer_id'];

                            $manufacturer_title = $row_manfacturer['manufacturer_title'];

                            echo "<option value='$manufacturer_id'>

                            $manufacturer_title
                            </option>
                            ";
                          }

                        ?>
                     </select>
                  </div><!-- form-group ends -->

                  <div class="form-group"><!-- form-group starts -->
                    <label class="control-label"> Product Category </label>
                      <select name="product_cat" class="form-control">
                        <option value="<?php echo $p_cat; ?> "> <?php echo "$p_cat_title"; ?> </option>
                        <?php

                         $get_p_cats = "select * from product_categories";
                         $run_p_cats = mysqli_query($con,$get_p_cats);

                         while ($row_p_cats=mysqli_fetch_array($run_p_cats)) {
                          $p_cat_id = $row_p_cats['p_cat_id'];
                          $p_cat_title = $row_p_cats['p_cat_title'];

                          echo "<option value='$p_cat_id'> $p_cat_title </option>";
                         }

                        ?>
                      </select>
                  </div><!-- form-group ends -->

                  <div class="form-group"><!-- form-group starts -->
                    <label class="control-label"> Category </label>
                      <select name="cat" class="form-control">
                        <option value="<?php echo $cat; ?> "> <?php echo "$cat_title"; ?></option>

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
                    <label class="control-label"> Bundle Image 1 </label>
                      <input type="file" name="product_img1" class="form-control"> <br>
                      <img src="product_images/<?php echo $p_image1; ?>" width="70" height="70">
                  </div><!-- form-group ends -->

                  <div class="form-group"><!-- form-group starts -->
                    <label class="control-label"> Bundle Image 2 </label>
                      <input type="file" name="product_img2" class="form-control"><br>
                      <img src="product_images/<?php echo $p_image2; ?>" width="70" height="70">
                  </div><!-- form-group ends -->

                  <div class="form-group"><!-- form-group starts -->
                    <label class="control-label"> Bundle Image 3 </label>
                      <input type="file" name="product_img3" class="form-control"><br>
                      <img src="product_images/<?php echo $p_image3; ?>" width="70" height="70">
                  </div><!-- form-group ends -->



                  <div class="form-group"><!-- form-group starts -->
                    <label class="control-label"> Bundle Keywords </label>
                      <input type="text" name="product_keywords" class="form-control" value="<?php echo $p_keywords; ?>">
                  </div><!-- form-group ends -->



                  <div class="form-group"><!-- form-group starts -->
                    <label class="control-label"> Bundle Label </label>
                      <input type="text" name="product_label" class="form-control" value="<?php echo $p_label; ?> ">
                  </div><!-- form-group ends -->

                </div>

              </div><!-- row end -->

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
                            <option value="instock" <?php if($stock_status == "instock"){echo "selected";} ?>>In Stock</option>
                            <option value="outofstock" <?php if($stock_status == "outofstock"){echo "selected";} ?>>Out of Stock</option>
                            <option value="onbackorder" <?php if($stock_status == "onbackorder"){echo "selected";} ?>>On Backorder</option>
                          </select>
                        </div><!-- form-group end-->
                      </div><!-- "col-sm-6 end-->
                      <div class="col-sm-6"><!-- "col-sm-6 start-->
                        <div class="form-group"><!-- form-group start-->
                          <label> Enable stock management at product level</label>
                          <div class="radio">
                            <label>
                              <input type="radio" name="enable_stock" value="yes"
                               <?php if($enable_stock == "yes"){echo "checked";} ?> required> Yes
                            </label>
                            <label>
                              <input type="radio" name="enable_stock" value="no"
                               <?php if($enable_stock == "no"){echo "checked";} ?> required> No
                            </label>
                          </div>
                        </div><!-- form-group end-->
                      </div><!-- "col-sm-6 end-->
                    </div><!-- row end-->
                    <div class="row" id="stock-management-row"><!-- row stock-management-row start-->
                      <div class="col-sm-6"><!-- "col-sm-6 start-->
                        <div class="form-group"><!-- form-group start-->
                          <label> Stock Quantity</label>
                          <input type="number" name="stock_quantity" value="<?php echo "$stock_quantity"; ?>" class="form-control" required>
                        </div><!-- form-group end-->
                      </div><!-- "col-sm-6 end-->
                      <div class="col-sm-6"><!-- "col-sm-6 start-->
                        <div class="form-group"><!-- form-group start-->
                          <label> Allow Backorders</label>
                          <select class="form-control" name="allow_backorders" required>
                            <option value="no" <?php if($allow_backorders == "no"){echo "selected";} ?>> Do not Allow</option>
                            <option value="notify" <?php if($allow_backorders == "notify"){echo "selected";} ?>> Allow but notify customer</option>
                            <option value="yes" <?php if($allow_backorders == "yes"){echo "selected";} ?>> Allow</option>
                          </select>
                        </div><!-- form-group end-->
                      </div><!-- "col-sm-6 end-->
                    </div><!-- row stock-management-row end-->
                  </div><!-- panel-body end-->
                </div><!-- panel panel-default end-->
              </div><!-- form-group product-stock-management end-->

              <div class="form-group"><!-- form-group starts -->
                <label class="control-label"></label>
                  <input type="submit" name="update" value="Update Bundle" class="btn btn-primary form-control">
              </div><!-- form-group ends -->

         		</form><!-- form-horizontal ends -->

         	</div><!-- panel-body ends -->

         </div><!--panel panel-default ends -->

      </div><!-- col-lg-12 ends -->

  </div><!-- 2 row ends -->

  <script>
    $(document).ready(function() {
      //Product stock management code start
      <?php if($_SERVER["QUERY_STRING"]== "edit_product=$random_id" or $_SERVER["QUERY_STRING"]== "edit_bundle=$random_id" ){ ?>
        <?php if($enable_stock == "yes"){ ?>
          $("#stock-management-row").show();
          $("#stock-status").hide();
        <?php }elseif($enable_stock == "no"){ ?>
          $("#stock-management-row").hide();
          $("#stock-status").show();
        <?php } ?>
      <?php } ?>

      <?php if($_SERVER["QUERY_STRING"]!= "edit_product=$random_id" and $_SERVER["QUERY_STRING"]!= "edit_bundle=$random_id"){ ?>
      $("#stock-management-row").hide();
      <?php } ?>
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
 if (isset($_POST['update'])) {

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

   //Product stock

   $stock_status = mysqli_real_escape_string($con, $_POST['stock_status']);

   $enable_stock = mysqli_real_escape_string($con, $_POST['enable_stock']);

   $stock_quantity = mysqli_real_escape_string($con, $_POST['stock_quantity']);

   $allow_backorders = mysqli_real_escape_string($con, $_POST['allow_backorders']);

   $status = "bundle";

   $product_img1 = $_FILES['product_img1']['name'];
   $product_img2 = $_FILES['product_img2']['name'];
   $product_img3 = $_FILES['product_img3']['name'];

   $temp_name1 = $_FILES['product_img1']['tmp_name'];
   $temp_name2 = $_FILES['product_img2']['tmp_name'];
   $temp_name3 = $_FILES['product_img3']['tmp_name'];

   if (empty($product_img1)) {
   	$product_img1 = $new_p_image1;
   }

   if (empty($product_img2)) {
   	$product_img2 = $new_p_image2;
   }

   if (empty($product_img3)) {
   	$product_img3 = $new_p_image3;
   }


   move_uploaded_file($temp_name1, "product_images/$product_img1");
   move_uploaded_file($temp_name2, "product_images/$product_img2");
   move_uploaded_file($temp_name3, "product_images/$product_img3");

   $update_product = "update products set p_cat_id='$product_cat', cat_id='$cat',manufacturer_id='$manufacturer_id',
   date=NOW(), product_title='$product_title',product_seo_desc='$product_seo_description', product_url='$product_url', product_code='$product_code',
   product_img1='$product_img1', product_img2='$product_img2', product_img3='$product_img3',
   product_price='$product_price', product_psp_price='$psp_price', product_desc='$product_desc',
   product_features='$product_features', product_video='$product_video', product_keywords='$product_keywords',
   product_label='$product_label',product_weight='$product_weight', status='$status' where product_id='$p_id' ";

   $run_product = mysqli_query($con,$update_product);

   if ($run_product) {
     //Product stock code start
     if ($count_product_stock == 0) {
       $insert_product_stock = "insert into products_stock (product_id, stock_status,enable_stock,
       stock_quantity, allow_backorders) values('$p_id','$stock_status', '$enable_stock',
       '$stock_quantity','$allow_backorders')";

       $run_product_stock = mysqli_query($con, $insert_product_stock);
     }elseif ($count_product_stock == 1) {
       $update_product_stock = "update products_stock set enable_stock='$enable_stock',
       stock_status='$stock_status',stock_quantity='$stock_quantity',allow_backorders='$allow_backorders'
       where product_id='$p_id'";

       $run_product_stock = mysqli_query($con, $update_product_stock);
     }
// Product stock code end
   	echo "<script>alert('Bundle has been updated successfully') </script>";
   	echo "<script>window.open('index.php?view_bundles','_self') </script>";
   }
 }
?>

<?php } ?>

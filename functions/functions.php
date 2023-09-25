
<?php

$db = mysqli_connect("shtaro.com","shtaro_elektro","@Lyp8#OVO;dG","shtaro_ecom");



//// IP address code starts///

function getRealUserIp(){
   switch (true) {
     case (!empty($_SERVER['HTTP_X_REAL_IP'])) : return $_SERVER['HTTP_X_REAL_IP'];

     case (!empty($_SERVER['HTTP_CLIENT_IP'])) : return $_SERVER['HTTP_CLIENT_IP'];

     case (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) : return $_SERVER['HTTP_X_FORWARDED_FOR'];

     default: return $_SERVER['REMOTE_ADDR'];

   }
}

/// IP address code ends ///
///
/// item function Starts////

  function items(){
    global $db;

    $count_items = 0;

    $ip_add = getRealUserIp();

    $get_items = "select * from cart where ip_add='$ip_add'";

    $run_items = mysqli_query($db,$get_items);

    while ($row_items = mysqli_fetch_array($run_items)) {

      $product_qty = $row_items['qty'];
      $count_items += $product_qty;
    }

    echo "$count_items";
  }

/// item function ends////


//// total price function starts ///

function total_price(){
   global $db;

   $ip_add = getRealUserIp();

   $total = 0;

   $select_cart = "select * from cart where ip_add='$ip_add'";

   $run_cart = mysqli_query($db,$select_cart);

   while ($record=mysqli_fetch_array($run_cart)){

      $pro_id = $record['p_id'];

      $pro_qty = $record['qty'];

          $sub_total = (int)$record['p_price']* (int)$pro_qty;

          $total += (int) $sub_total;

   }

   echo (int) $total;
}

//// total price function ends ///

/// getPro function start///
function getPro(){

	global $db;

	$get_products = "select * from products order by 1 DESC LIMIT 0,12";

	$run_products = mysqli_query($db,$get_products);

	while($row_products=mysqli_fetch_array($run_products)) {
		$pro_id = $row_products['product_id'];
		$pro_title = $row_products['product_title'];
		$pro_price = $row_products['product_price'];
		$pro_img1 = $row_products['product_img1'];
    $pro_label = $row_products['product_label'];

    $manufacturer_id = $row_products['manufacturer_id'];

    $pro_psp_price = $row_products['product_psp_price'];

    $pro_url = $row_products['product_url'];

// Get Manufacturer Title
    $get_manufacturer = "select * from manufacturers where manufacturer_id='$manufacturer_id' ";

    $run_manufacturer = mysqli_query($db,$get_manufacturer);

    $row_manufacturer = mysqli_fetch_array($run_manufacturer);

    $manufacturer_name = $row_manufacturer['manufacturer_title'];

    if ($pro_label == "Oferte" or $pro_label == "I Ri") {

      $product_price = "<del>$pro_price Lekë </del>";

      $product_psp_price = "| $pro_psp_price Lekë ";

    }
    else{

      $product_psp_price = "";

      $product_price ="$pro_price Lekë ";
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
          <div class='col-lg-3 col-md-6 col-xs-12'>
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

/// getPro function start///

/// getProducts Function Start ///

  function getProducts(){

    /// getProducts function Code Starts ///

global $db;

$aWhere = array();

/// Manufacturers Code Starts ///

if(isset($_REQUEST['man'])&&is_array($_REQUEST['man'])){

foreach($_REQUEST['man'] as $sKey=>$sVal){

if((int)$sVal!=0){

$aWhere[] = 'manufacturer_id='.(int)$sVal;

}

}

}

/// Manufacturers Code Ends ///

/// Products Categories Code Starts ///

if(isset($_REQUEST['p_cat'])&&is_array($_REQUEST['p_cat'])){

foreach($_REQUEST['p_cat'] as $sKey=>$sVal){

if((int)$sVal!=0){

$aWhere[] = 'p_cat_id='.(int)$sVal;

}

}

}

/// Products Categories Code Ends ///

/// Categories Code Starts ///

if(isset($_REQUEST['cat'])&&is_array($_REQUEST['cat'])){

foreach($_REQUEST['cat'] as $sKey=>$sVal){

if((int)$sVal!=0){

$aWhere[] = 'cat_id='.(int)$sVal;

}

}

}

/// Categories Code Ends ///

$per_page=6;

if(isset($_GET['page'])){

$page = $_GET['page'];

}else {

$page=1;

}

$start_from = ($page-1) * $per_page ;

$sLimit = " order by 1 DESC LIMIT $start_from,$per_page";

$sWhere = (count($aWhere)>0?' WHERE '.implode(' or ',$aWhere):'').$sLimit;

$get_products = "select * from products  ".$sWhere;

$run_products = mysqli_query($db,$get_products);

while($row_products=mysqli_fetch_array($run_products)){

    $pro_id = $row_products['product_id'];
    $pro_title = $row_products['product_title'];
    $pro_price = $row_products['product_price'];
    $pro_img1 = $row_products['product_img1'];
    $pro_label = $row_products['product_label'];

    $manufacturer_id = $row_products['manufacturer_id'];

    $pro_psp_price = $row_products['product_psp_price'];

    $pro_url = $row_products['product_url'];

// Get Manufacturer Title
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
          <div class='col-md-4 col-sm-6 col-xs-12 center-responsive'>
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
/// getProducts function Code Ends ///
  }
/// getProducts Function end ///


/// getPaginator Function Start ///

  function getPaginator(){

    /// getPaginator Function Code Starts ///

$per_page = 6;

global $db;

$aWhere = array();

$aPath = '';

/// Manufacturers Code Starts ///

if(isset($_REQUEST['man'])&&is_array($_REQUEST['man'])){

foreach($_REQUEST['man'] as $sKey=>$sVal){

if((int)$sVal!=0){

$aWhere[] = 'manufacturer_id='.(int)$sVal;

$aPath .= 'man[]='.(int)$sVal.'&';

}

}

}

/// Manufacturers Code Ends ///

/// Products Categories Code Starts ///

if(isset($_REQUEST['p_cat'])&&is_array($_REQUEST['p_cat'])){

foreach($_REQUEST['p_cat'] as $sKey=>$sVal){

if((int)$sVal!=0){

$aWhere[] = 'p_cat_id='.(int)$sVal;

$aPath .= 'p_cat[]='.(int)$sVal.'&';

}

}

}

/// Products Categories Code Ends ///

/// Categories Code Starts ///

if(isset($_REQUEST['cat'])&&is_array($_REQUEST['cat'])){

foreach($_REQUEST['cat'] as $sKey=>$sVal){

if((int)$sVal!=0){

$aWhere[] = 'cat_id='.(int)$sVal;

$aPath .= 'cat[]='.(int)$sVal.'&';

}

}

}

/// Categories Code Ends ///

$sWhere = (count($aWhere)>0?' WHERE '.implode(' or ',$aWhere):'');

$query = "select * from products ".$sWhere;

$result = mysqli_query($db,$query);

$total_records = mysqli_num_rows($result);

$total_pages = ceil($total_records / $per_page);

echo "<li><a href='shop.php?page=1";

if(!empty($aPath)){ echo "&".$aPath; }

echo "' >".'Faqja e Parë'."</a></li>";

for ($i=1; $i<=$total_pages; $i++){

echo "<li><a href='shop.php?page=".$i.(!empty($aPath)?'&'.$aPath:'')."' >".$i."</a></li>";

};

echo "<li><a href='shop.php?page=$total_pages";

if(!empty($aPath)){ echo "&".$aPath; }

echo "' >".'Faqja e Fundit'."</a></li>";

/// getPaginator Function Code Ends ///
  }
/// getPaginator Function end ///
?>

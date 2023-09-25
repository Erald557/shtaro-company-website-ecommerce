<?php

session_start();

include("includes/db.php");

include("functions/functions.php");
?>

<?php

   $total = 0;

   $total_weight = 0;

   $ip_add = getRealUserIp();

   $select_cart = "select * from cart where ip_add='$ip_add'";

   $run_cart = mysqli_query($con, $select_cart);

   $count = mysqli_num_rows($run_cart);

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

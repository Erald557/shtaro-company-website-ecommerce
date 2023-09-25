<?php

if (!isset($_SESSION['admin_email'])) {

	echo "<script>window.open('login.php','_self') </script>";
}

else {


?>


<?php

	if (isset($_GET['delete_product'])) {

		$delete_id = $_GET['delete_product'];

		$delete_pro = "delete from products where product_id='$delete_id' ";

		$run_delete = mysqli_query($con,$delete_pro);

		if ($run_delete) {

      $delete_product_stock = "delete from products_stock where product_id='$delete_id'";
      $run_product_stock = mysqli_query($con, $delete_product_stock);

			echo "<script>alert('One product has been deleted') </script>";

			echo "<script>window.open('index.php?view_products','_self') </script>";
		}
	}

 ?>

<?php } ?>

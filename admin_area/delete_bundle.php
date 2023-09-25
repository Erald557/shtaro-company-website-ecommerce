<?php

if (!isset($_SESSION['admin_email'])) {

	echo "<script>window.open('login.php','_self') </script>";
}

else {


?>


<?php

	if (isset($_GET['delete_bundle'])) {

		$delete_id = $_GET['delete_bundle'];

		$delete_pro = "delete from products where product_id='$delete_id' ";

		$run_delete = mysqli_query($con,$delete_pro);

		$delete_rel = "delete from bundle_product_relation where bundle_id='$delete_id' ";

		$run_rel = mysqli_query($con,$delete_rel);

		if ($run_rel) {

      $delete_product_stock = "delete from products_stock where product_id='$delete_id'";
      $run_product_stock = mysqli_query($con, $delete_product_stock);

			echo "<script>alert('One Bundle has been deleted') </script>";

			echo "<script>window.open('index.php?view_bundles','_self') </script>";
		}
	}

 ?>

<?php } ?>

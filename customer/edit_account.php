<?php
@session_start();

if (!isset($_SESSION["customer_email"])) {
  echo "<script>window.open('../checkout.php','_self');</script>";
}
 ?>
<?php

	$customer_session = $_SESSION['customer_email'];

	$get_customer = "select * from customers where customer_email='$customer_session' ";

	$run_customer = mysqli_query($con,$get_customer);

	$row_customer = mysqli_fetch_array($run_customer);

	$customer_id = $row_customer['customer_id'];

	$customer_name = $row_customer['customer_name'];

	$customer_email = $row_customer['customer_email'];

	$customer_country = $row_customer['customer_country'];

	$customer_city = $row_customer['customer_city'];

	$customer_contact = $row_customer['customer_contact'];

	$customer_address = $row_customer['customer_address'];

	$customer_image = $row_customer['customer_image'];

	$new_customer_image = $row_customer['customer_image'];
?>

<h1 align="center"> Modifiko Llogarinë </h1>

<form action="" method="post" enctype="multipart/form-data"><!--form starts-->

	<div class="form-group"><!--form-group starts-->
		<label> Emri: </label>
		<input type="text" name="c_name" class="form-control" required value="<?php echo $customer_name; ?>" >
	</div><!--form-group ends-->

	<div class="form-group"><!--form-group starts-->
		<label> Emaili: </label>
		<input type="email" name="c_email" class="form-control" required value="<?php echo $customer_email; ?>">
	</div><!--form-group ends-->

	<div class="form-group"><!--form-group starts-->
		<label> Shteti: </label>
		<input type="text" name="c_country" class="form-control"value="<?php echo $customer_country; ?>">
	</div><!--form-group ends-->

	<div class="form-group"><!--form-group starts-->
		<label> Qyteti </label>
		<input type="text" name="c_city" class="form-control" required value="<?php echo $customer_city; ?>">
	</div><!--form-group ends-->

	<div class="form-group"><!--form-group starts-->
		<label> Kontakti </label>
		<input type="text" name="c_contact" class="form-control" required value="<?php echo $customer_contact; ?>">
	</div><!--form-group ends-->

	<div class="form-group"><!--form-group starts-->
		<label> Adresa </label>
		<input type="text" name="c_address" class="form-control" required value="<?php echo $customer_address; ?>">
	</div><!--form-group ends-->

	<div class="form-group"><!--form-group starts-->
		<label> Foto </label>
		<input type="file" name="c_image" class="form-control"><br>
		<img src="customer_images/<?php echo $customer_image; ?>" height="100" width="100">
	</div><!--form-group ends-->

	<div class="text-center"><!--text-center starts-->
		<button name="update" class="btn btn-primary">
			<i class="fa fa-user"></i> Përditëso Tani

		</button>
	</div><!--text-center ends-->

</form><!--form ends-->

<?php

if (isset($_POST['update'])) {

	$update_id = $customer_id;

	$c_name = mysqli_real_escape_string($con, $_POST['c_name']);

	$c_email = mysqli_real_escape_string($con, $_POST['c_email']);

	$c_country = mysqli_real_escape_string($con, $_POST['c_country']);

	$c_city = mysqli_real_escape_string($con, $_POST['c_city']);

	$c_contact = mysqli_real_escape_string($con, $_POST['c_contact']);

	$c_address = mysqli_real_escape_string($con, $_POST['c_address']);

	$c_image = $_FILES['c_image']['name'];

	$c_image_tmp = $_FILES['c_image']['tmp_name'];

  if(!filter_var($c_email, FILTER_VALIDATE_EMAIL)){
    echo "<script> alert('Emaili nuk është i vlefshëm!');</script>";
     exit();
  }

  if (empty($c_image)) {
   $c_image = $customer_image;
  } else {
    $allowed = array('jpeg','jpg','gif','png');

    $file_extension = pathinfo($c_image, PATHINFO_EXTENSION);

    if (!in_array($file_extension,$allowed)) {
      echo "<script>alert('Formati i imazhit nuk është i pranueshëm!');</script>";
       exit();
    }else{
      move_uploaded_file($c_image_tmp, "customer_images/$c_image");
    }
  }


	if (empty($c_image)) {
		$c_image = $new_customer_image;
	}

	$update_customer ="update customers set customer_name='$c_name', customer_email='$c_email', customer_country='$c_country', customer_city='$c_city', customer_contact='$c_contact', customer_address='$c_address', customer_image='$c_image' where customer_id='$update_id' ";

	$run_customer  = mysqli_query($con,$update_customer);

	if ($run_customer) {

		echo "<script>alert('Llogaria juaj u përditësua, ju lutem logohuni sërish! ') </script>";
		echo "<script>window.open('logout.php','_self') </script>";
	}
}

?>

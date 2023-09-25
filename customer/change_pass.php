<?php
@session_start();

if (!isset($_SESSION["customer_email"])) {
  echo "<script>window.open('../checkout.php','_self');</script>";
}
 ?>

<h1 align="center"> Ndrysho Passwordin </h1>

<form action="" method="post"><!--form starts-->
	<div class="form-group"><!--form-group starts-->
		<label> Vendosni Passwordin Aktual </label>
		<input type="password" name="old_pass" class="form-control" required>
	</div><!--form-group ends-->

	<div class="form-group"><!--form-group starts-->
		<label> Vendosni Passwordin e Ri </label>
		<input type="password" name="new_pass" class="form-control" required>
	</div><!--form-group ends-->

	<div class="form-group"><!--form-group starts-->
		<label> Rivendosni Passwordin e Ri </label>
		<input type="password" name="new_pass_again" class="form-control" required>
	</div><!--form-group ends-->

	<div class="text-center"><!--text-center starts-->
		<button type="submit" name="submit" class="btn btn-primary">
			<i class="fa fa-user"></i> Ndrysho Passwordin
		</button>
	</div><!--text-center ends-->

</form><!--form starts-->

<?php

if (isset($_POST['submit'])) {

	$c_email = $_SESSION['customer_email'];

	$old_pass = $_POST['old_pass'];

	$new_pass = $_POST['new_pass'];

	$new_pass_again = $_POST['new_pass_again'];

	$new_hash_password = password_hash($new_hash_password, PASSWORD_DEFAULT);

	$sel_old_pass = "select * from customers where customer_email='$c_email' ";

	$run_old_pass = mysqli_query($con,$sel_old_pass);

	$row_old_pass = mysqli_fetch_array($run_old_pass);

	$hash_password = $row_old_pass['customer_pass'];

	$check_old_pass = password_verify($old_pass, $hash_password);

	if ($check_old_pass==0) {

		echo "<script>alert('Passwordi aktual nuk është i saktë!') </script>";
		exit();
	}

	if ($new_pass!=$new_pass_again) {

		echo "<script>alert('Passwordi i ri nuk përputhet!') </script>";
		exit();
	}

	 $update_pass = "update customers set customer_pass='$new_hash_password' where customer_email='$c_email' ";
	 $run_pass = mysqli_query($con,$update_pass);

	 if ($run_pass) {

	 	echo "<script>alert('Passwordi u ndryshua me sukses!') </script>";

	 	echo "<script>window.open('my_account.php?my_orders','_self')</script>";
	 }
}
?>

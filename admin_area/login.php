<?php

session_start();

include("includes/db.php");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Login</title>

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>

	<div class="container"><!-- container start -->

		<form class="form-login" action="" method="post" accept-charset="utf-8"> <!-- form-login start -->

			<h2 class="form-login-heading"> Admin Login</h2>

			<input type="text" class="form-control" name="admin_email" placeholder="Email" value="" required>
			<input type="password" class="form-control" name="admin_pass" placeholder="Password" value="" required>

			<button class="btn btn-lg btn-primary btn-block" type="submit" name="admin_login">
				Login
			</button>
      <h5 class="forgot-password">
        <a href="forgot_password.php">
          Forgot Password
        </a>
      </h5>
		</form><!-- form-login end -->
	</div><!-- container close -->
</body>
</html>

<?php

if (isset($_POST['admin_login'])) {

	$admin_email = mysqli_real_escape_string($con,$_POST['admin_email']);

	$admin_pass = mysqli_real_escape_string($con,$_POST['admin_pass']);

	$get_admin = "select * from admins where admin_email='$admin_email'";

	$run_admin = mysqli_query($con,$get_admin);

	$row_admin = mysqli_fetch_array($run_admin);

	$hash_password = $row_admin['admin_pass'];

	$decrypt_password = password_verify($admin_pass, $hash_password);

	if ($decrypt_password != 0) {

		$_SESSION['admin_email']=$admin_email;

		echo "<script>window.open('index.php?dashboard','_self') </script>";
	} else {

		echo "<script>alert('Email or Password is Wrong') </script>";
	}
}
?>

<?php

session_start();

include("includes/db.php");

if (!isset($_GET['change_password'])) {
  echo "<script>window.open('login.php','_self');</script>";
}else{
  $hash_password = mysqli_real_escape_string($con, $_GET['change_password']);
  $select_admin = "select * from admins where admin_pass='$hash_password'";
  $run_admin = mysqli_query($con, $select_admin);
  $count_admin = mysqli_num_rows($run_admin);
  if ($count_admin == 0) {
  echo "<script>window.open('login.php','_self');</script>";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Reset/Change Password</title>

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
  <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css">
</head>
<body>

	<div class="container"><!-- container start -->

		<form class="form-login" action="" method="post" accept-charset="utf-8"> <!-- form-login start -->
      <div class="alert alert-info">
        <strong> Hint </strong> The password should be at least 8 characters long.Use upper
        and lower case letters, numbers and symbols!
      </div>

			<h2 class="form-login-heading"> Reset/Change Password</h2>

			<input type="password" class="form-control" name="admin_pass" placeholder="New Password"  minlength="8" required>
      <input type="password" class="form-control" name="confirm_admin_pass" placeholder="Confirm New Password"  minlength="8" required>

			<button class="btn btn-lg btn-primary btn-block" type="submit" name="reset_password">
				Reset Password
			</button>

		</form><!-- form-login end -->
	</div><!-- container close -->
</body>
</html>

<?php

if (isset($_POST['reset_password'])) {
  $hash_password = mysqli_real_escape_string($con, $_GET['change_password']);
  $admin_pass = mysqli_real_escape_string($con, $_POST['admin_pass']);
  $confirm_admin_pass = mysqli_real_escape_string($con, $_POST['confirm_admin_pass']);
  if ($admin_pass != $confirm_admin_pass) {
      echo "<script>alert('Your New Password does not match. Please try again!');</script>";
  } else {
    $encrypted_password = password_hash($confirm_admin_pass, PASSWORD_DEFAULT);
    $update_admin_password = "update admins set admin_pass='$encrypted_password'
    where admin_pass='$hash_password'";
    $run_update_admin_password = mysqli_query($con, $update_admin_password);
    if ($run_update_admin_password) {
      echo "<script>alert('Your Admin password has successfully changed!');
        window.open('login.php','_self');
      </script>";
    }
  }

}
?>

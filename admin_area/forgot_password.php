<?php

session_start();

include("includes/db.php");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Forgot Password</title>

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
  <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css">
</head>
<body>

	<div class="container"><!-- container start -->

		<form class="form-login" action="" method="post" accept-charset="utf-8"> <!-- form-login start -->
      <div class="alert alert-info">
        <strong> Info </strong> Please enter your email address!
      </div>

			<h2 class="form-login-heading"> Forgot Password</h2>

			<input type="text" class="form-control" name="admin_email" placeholder="Email" value="" required>

			<button class="btn btn-lg btn-primary btn-block" type="submit" name="forgot_password">
				Submit
			</button>
      <h5 class="forgot-password">
        <a href="login.php">
          <i class="fa fa-arrow-left"></i> Back To Login Page
        </a>
      </h5>
		</form><!-- form-login end -->
	</div><!-- container close -->
</body>
</html>

<?php

if (isset($_POST['forgot_password'])) {
  $admin_email = mysqli_real_escape_string($con, $_POST['admin_email']);
  $select_admin = "select * from admins where admin_email='$admin_email'";
  $run_admin = mysqli_query($con, $select_admin);
  $count_admin = mysqli_num_rows($run_admin);
  if ($count_admin == 0) {
    echo "<script> alert('We do not have your email address in the Admins Record!');</script>";
  }else {
    $row_admin = mysqli_fetch_array($run_admin);
    $admin_name = $row_admin["admin_name"];
    $hashed_admin_pass = $row_admin["admin_pass"];

    $message = "
      <center>
      <img src='http://shtaro.com/images/Logo_shtaro.png'/>
      </center>
      <h2 align='center'> Përshëndetje $admin_name, </h2>
      <h3 align='center'>
        Për të resetuar/ndryshuar paswordin tuaj <span><strong><em>
        <a href='http://shtaro.com/admin_area/change_password.php?change_password=$hashed_admin_pass'>klikoni këtu</a></em></strong></span>.
      </h3>
      <h3 align='center'>
        Klikoni<a href='http://shtaro.com/admin_area/login.php'> këtu </a> për të hyrë në llogarinë tuaj!
      </h3>
    ";
    $from = "info@shtaro.com";
    $subject = "Reseto/Ndrysho Paswordin Admin";
    $headers = "From: $from\r\n";
    $headers .= "Content-type: text/html\r\n";
    mail($admin_email,$subject,$message,$headers);
    echo "<script>alert('Ju është dërguar një email për të krijuar një password të ri!') </script>";
		echo "<script>window.open('login.php','_self') </script>";
  }


}
?>

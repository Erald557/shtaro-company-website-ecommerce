
<?php

if (!isset($_SESSION['admin_email'])) {

  echo "<script>window.open('login.php','_self') </script>";
}

else {

?>


<?php


  if (isset($_GET['user_profile'])) {

    $edit_id = $_GET['user_profile'];

    $get_admin = "select * from admins where admin_id='$edit_id' ";

    $run_admin = mysqli_query($con,$get_admin);

    $row_admin = mysqli_fetch_array($run_admin);

    $admin_id = $row_admin['admin_id'];

    $admin_name = $row_admin['admin_name'];

    $admin_email = $row_admin['admin_email'];

    $admin_pass = $row_admin['admin_pass'];

    $admin_image = $row_admin['admin_image'];

    $new_admin_image = $row_admin['admin_image'];

    $admin_country = $row_admin['admin_country'];

    $admin_job = $row_admin['admin_job'];

    $admin_contact = $row_admin['admin_contact'];

    $admin_about = $row_admin['admin_about'];

  }

 ?>

<!DOCTYPE html>

<html>

<head>

	<title> Edit User </title>


  <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>

</head>

<body>

  <div class="row"><!-- row starts -->
  	<div class="col-lg-12"><!-- col-lg-12 starts -->
  		<ol class="breadcrumb"><!-- breadcrumb starts -->
  			<li class="active">
  				<i class="fa fa-dashboard"></i> Dashboard / Edit profile
  			</li>
  		</ol><!-- breadcrumb ends -->
  	</div><!-- col-lg-12 ends -->
   </div><!-- row ends -->

  <div class="row"><!-- 2 row starts -->
      <div class="col-lg-12"><!-- col-lg-12 starts -->
         <div class="panel panel-default"><!--panel panel-default  starts -->
         	<div class="panel-heading"><!-- panel-heading  starts -->
         		<h3 class="panel-title">
         			<i class="fa fa-money fa-fw"></i> Edit Profile
         		</h3>
         	</div><!-- panel-heading ends -->

         	<div class="panel-body"><!-- panel-body starts -->
         		<form class="form-horizontal" method="post" enctype="multipart/form-data"><!-- form-horizontal starts -->
         			<div class="form-group"><!-- form-group starts -->
         				<label class="col-md-3 control-label"> User Name: </label>
         				<div class="col-md-6">
         					<input type="text" name="admin_name" class="form-control" required value="<?php echo $admin_name;?>">
         				</div>
         			</div><!-- form-group ends -->

              <div class="form-group"><!-- form-group starts -->
                <label class="col-md-3 control-label"> User Email: </label>
                <div class="col-md-6">
                  <input type="text" name="admin_email" class="form-control" required value="<?php echo $admin_email;?>">
                </div>
              </div><!-- form-group ends -->

              <div class="form-group"><!-- form-group starts -->
                <label class="col-md-3 control-label"> User Country: </label>
                <div class="col-md-6">
                  <input type="text" name="admin_country" class="form-control" required value="<?php echo $admin_country;?>">
                </div>
              </div><!-- form-group ends -->

              <div class="form-group"><!-- form-group starts -->
                <label class="col-md-3 control-label"> User Job: </label>
                <div class="col-md-6">
                  <input type="text" name="admin_job" class="form-control" required value="<?php echo $admin_job;?>">
                </div>
              </div><!-- form-group ends -->

              <div class="form-group"><!-- form-group starts -->
                <label class="col-md-3 control-label"> User Contact: </label>
                <div class="col-md-6">
                  <input type="text" name="admin_contact" class="form-control" required value="<?php echo $admin_contact;?>">
                </div>
              </div><!-- form-group ends -->

              <div class="form-group"><!-- form-group starts -->
                <label class="col-md-3 control-label"> User About: </label>
                <div class="col-md-6">
                 <textarea name="admin_about" class="form-control" rows="3"><?php echo $admin_name;?></textarea>
                </div>
              </div><!-- form-group ends -->

              <div class="form-group"><!-- form-group starts -->
                <label class="col-md-3 control-label"> User Image: </label>
                <div class="col-md-6">
                  <input type="file" name="admin_image" class="form-control">
                  <br> <img src="admin_images/<?php echo $admin_image;?>" width="70" height="70">
                </div>
              </div><!-- form-group ends -->

         		<hr>
            <h3 class="text-center" >Change Account Password <br /><span class="text-muted h6"> If you dont want to change the Password
            leave this field empty!</span> </h3>
              <div class="form-group"><!-- form-group starts -->
                <label class="col-md-3 control-label"> Change Password: </label>
                <div class="col-md-6">
                  <input type="password" name="admin_pass" class="form-control">
                </div>

              </div><!-- form-group ends -->

              <div class="form-group"><!-- form-group starts -->
                <label class="col-md-3 control-label"> Confirm Change Password: </label>
                <div class="col-md-6">
                  <input type="password" name="confirm_admin_pass" class="form-control">
                </div>

              </div><!-- form-group ends -->

              <div class="form-group"><!-- form-group starts -->
                <label class="col-md-3 control-label"></label>
                <div class="col-md-6">
                  <input type="submit" name="update" value="Update Profile" class="btn btn-primary form-control">
                </div>

              </div><!-- form-group ends -->

         		</form><!-- form-horizontal ends -->

         	</div><!-- panel-body ends -->

         </div><!--panel panel-default ends -->

      </div><!-- col-lg-12 ends -->

  </div><!-- 2 row ends -->

</body>
</html>

<?php
 if (isset($_POST['update'])) {

   $admin_name = $_POST['admin_name'];

   $admin_email = $_POST['admin_email'];

   $admin_country = $_POST['admin_country'];

   $admin_job = $_POST['admin_job'];

   $admin_contact = $_POST['admin_contact'];

   $admin_about = $_POST['admin_about'];

   $admin_image = $_FILES['admin_image']['name'];

   $temp_admin_image = $_FILES['admin_image']['tmp_name'];

   move_uploaded_file($temp_admin_image, "admin_images/$admin_image");

   if (empty($admin_image)) {
      $admin_image = $new_admin_image;
   }

   $admin_pass = $_POST['admin_pass'];

   $confirm_admin_pass = $_POST['confirm_admin_pass'];

   if (!empty($admin_pass) or !empty($confirm_admin_pass)) {
     if ($admin_pass !== $confirm_admin_pass) {
       echo "<script>alert('Passwordi juaj nuk përputhet, te lutem provo sërish!')</script>";
     }else {
       $encrypted_password = password_hash($admin_pass, PASSWORD_DEFAULT);
       $update_admin_pass = "update admins set admin_pass='$encrypted_password' where admin_id='$admin_id'";
       $run_update_admin_pass = mysqli_query($con, $update_admin_pass);

     }
   }

   $update_admin = "update admins set admin_name='$admin_name', admin_email='$admin_email',
   admin_country='$admin_country', admin_job='$admin_job', admin_contact='$admin_contact', admin_about='$admin_about', admin_image='$admin_image' where admin_id='$admin_id' ";

   $run_admin = mysqli_query($con,$update_admin);

   if ($run_admin){
     echo "<script> alert('User Has Been Updated and Login Again')</script>";
     echo "<script>window.open('login.php','_self')</script>";

     session_destroy();
   }
 }
?>

<?php } ?>


<?php

session_start();

include("includes/db.php");

include("functions/functions.php");

if (isset($_SESSION['customer_email'])) {
  echo "<script>
    window.open('index.php','_self');
  </script>";
}
?>

<!DOCTYPE html>
<html>

<head>

<?php
	include("includes/head.php")
	?>
	<script src="https://www.google.com/recaptcha/api.js?render=6Lc-xMgUAAAAALFDMhczUXGv5H-UkhzGoLCf6Ts1"></script>

</head>



<body>


	<div id="top"> <!-- starts top-->


		<div class="container"><!-- starts container-->

			<div class="col-md-6 offer"><!-- starts col-md-6 oferr-->

				<a href="#" class="btn-sm">
					<?php

					if (!isset($_SESSION['customer_email'])) {

						echo "<em>Mirëserdhe!</em> <span>|</span>";
					}
					else {
						echo "<em>Mirëserdhe</em>  "  .  $_SESSION['customer_email'] . " <span>|</span> ";
					}
					?>
				</a>
				<a href="#">
					Shporta Totali: <?php total_price()?> Lekë
				</a>


			</div><!-- ends col-md-6 oferr-->

			<div class="col-md-6"><!-- starts col-md-6 -->

				<ul class="menu"> <!-- starts menu -->
					<li>
						<a href="customer_register.php">
							Regjistrohu
						</a>
					</li>
					<li>
						<?php

               if (!isset($_SESSION['customer_email'])) {
               	echo "<a href='checkout.php'> Llogaria Ime</a>";
               }
               else{
               	echo "<a href='customer/my_account.php?my_orders'> Llogaria Ime </a>";
               }
						?>
					</li>
					<li>
						<a href="cart.php">
							Shko tek Shporta
						</a>
					</li>
					<li>
						<?php

             if (!isset($_SESSION['customer_email'])) {

             	 echo "<a href='checkout.php'> Login </a>";
             }
             else{

             	echo "<a href='logout.php'> Logout </a>";
             }
						?>
					</li>

				</ul><!-- ends menu -->

			</div><!-- ends col-md-6 -->

	    </div><!-- ends container-->

	</div><!-- ends top-->


<div class="navbar navbar-default" id="navbar"><!-- navbar navbar-default starts-->

	<div class="container"><!-- container starts-->
		<?php
		include("includes/navbar-menu.php")
		 ?>
	</div><!-- container ends-->

</div><!-- navbar navbar-default ends-->


<div id="content" class="container"><!-- content starts-->

	   <div class="container"><!-- container starts-->

			<div class="col-md-12"><!-- col-md-12 starts-->

				<ul class="breadcrumb"><!-- breadcrumb starts-->

					<li>
						<a href="index.php">Kryefaqja</a>
					</li>

					<li>
						Regjistrohu
					</li>

				</ul><!-- breadcrumb ends-->

			</div><!-- col-md-12 ends-->


		  	<div class="col-md-6 col-md-offset-3 col-sm-12"><!-- col-md-12 starts-->

		  		<div class="box"><!-- box starts-->

		  			<div class="box-header"><!-- box-header starts-->

		  				<center><!-- center starts-->

		  					<p class="lead"> Krijoni një llogari të re </p>


		  				</center><!-- center ends-->

		  			</div><!-- box-header ends-->

		  				<form action="customer_register.php" method="post" enctype="multipart/form-data"><!-- form starts-->

		  					<div class="form-group"><!-- form-group starts-->

                    <label> Emri </label>

                    <input type="text" class="form-control" name="c_name" required minlength="3" maxlength="8">

		  					</div><!-- form-group ends-->

		  						<div class="form-group"><!-- form-group starts-->

		  							<label> Emaili  </label>

		  							<input type="email" id="emailid" class="form-control" name="c_email" required>

		  						</div><!-- form-group ends-->

		  							<div class="form-group"><!-- form-group starts-->

		  								<label> Passwordi </label>
											<div class="input-group"><!-- input-group starts-->
												<span class="input-group-addon"><!-- input-group-addon starts-->
													<i class="fa fa-check tick1"></i>
													<i class="fa fa-times cross1"></i>
												</span><!-- input-group-addon end-->
											<input type="password" id="pass" class="form-control" name="c_pass" required minlength="6" maxlength="15">
										</div><!-- input-group end-->
		  							</div><!-- form-group ends-->

										<span class="input-group-addon"><!-- input-group-addon starts-->
										 	<div id="meter_wrapper"><!-- meter_wrapper starts-->
										 		<span id="pass_type"></span>
												<div id="meter">

												</div>
										 	</div><!-- meter_wrapper end-->
										</span><!-- input-group-addon end-->

										<div class="form-group"><!-- form-group starts-->

		  								<label>Konfirmo Passwordin </label>
											<div class="input-group"><!-- input-group starts-->
												<span class="input-group-addon"><!-- input-group-addon starts-->
													<i class="fa fa-check tick2"></i>
													<i class="fa fa-times cross2"></i>
												</span><!-- input-group-addon end-->
											<input type="password" id="con_pass" class="form-control confirm" required minlength="6" maxlength="15">
										</div><!-- input-group end-->
		  							</div><!-- form-group ends-->


		  							<div class="form-group"><!-- form-group starts-->

		  								<label> Shteti </label>

		  								<input type="text" class="form-control" name="c_country" minlength="4" maxlength="10">

		  							</div><!-- form-group ends-->

		  							<div class="form-group"><!-- form-group starts-->

		  								<label> Qyteti </label>

		  								<input type="text" class="form-control" name="c_city" required minlength="4" maxlength="8">

		  							</div><!-- form-group ends-->



		  							<div class="form-group"><!-- form-group starts-->

		  								<label> Telefoni </label>

		  								<input type="tel" class="form-control" name="c_contact" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required>

		  							</div><!-- form-group ends-->

		  							<div class="form-group"><!-- form-group starts-->

		  								<label> Adresa </label>

		  								<input type="text" class="form-control" name="c_address" required minlength="4" maxlength="25">

		  							</div><!-- form-group ends-->


		  							<div class="form-group"><!-- form-group starts-->

		  								<label> Foto </label>

		  								<input type="file" class="form-control" name="c_image">

		  							</div><!-- form-group ends-->



		  								  <div class="text-center"><!-- text-center starts-->
													<input type="hidden" name="recaptcha_response" id="recaptchaResponse">
		  								  	<button type="submit" name="register" class="btn btn-primary">

		  								  		<i class="fa fa-user"> Regjistrohu </i>

		  								  	</button>

		  								  </div><!-- text-center ends-->

		  				</form><!-- form ends-->

		  		</div><!-- box ends-->

		  	</div><!-- col-md-12 ends-->

        </div><!-- container ends-->

    </div><!-- content ends-->

</div><!--container ends-->

<?php
 include("includes/footer.php")
?>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
grecaptcha.ready(function() {
    grecaptcha.execute('6Lc-xMgUAAAAALFDMhczUXGv5H-UkhzGoLCf6Ts1', {action: 'register'}).then(function(token) {
			var recaptchaResponse = document.getElementById('recaptchaResponse');
			recaptchaResponse.value = token;
    });
});
</script>

<script>
	$(document).ready(function(){
		$('.tick1').hide();
		$('.cross1').hide();
		$('.tick2').hide();
		$('.cross2').hide();

		$('.confirm').focusout(function(){
			if ($('#pass').val() == $('#con_pass').val()) {
				$('.tick1').show();
				$('.cross1').hide();
				$('.tick2').show();
				$('.cross2').hide();
			} else {
				$('.tick1').hide();
				$('.cross1').show();
				$('.tick2').hide();
				$('.cross2').show();
			}
		});
	});
</script>
<script>
$(document).ready(function(){

$("#pass").keyup(function(){

check_pass();

});

});

function check_pass() {
var val=document.getElementById("pass").value;
var meter=document.getElementById("meter");
var no=0;
if(val!="")
{
// If the password length is less than or equal to 6
if(val.length<=6)no=1;

// If the password length is greater than 6 and contain any lowercase alphabet or any number or any special character
if(val.length>6 && (val.match(/[a-z]/) || val.match(/\d+/) || val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)))no=2;

// If the password length is greater than 6 and contain alphabet,number,special character respectively
if(val.length>6 && ((val.match(/[a-z]/) && val.match(/\d+/)) || (val.match(/\d+/) && val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)) || (val.match(/[a-z]/) && val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/))))no=3;

// If the password length is greater than 6 and must contain alphabets,numbers and special characters
if(val.length>6 && val.match(/[a-z]/) && val.match(/\d+/) && val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/))no=4;

if(no==1)
{
 $("#meter").animate({width:'50px'},300);
 meter.style.backgroundColor="red";
 document.getElementById("pass_type").innerHTML="Shumë i Dobët";
}

if(no==2)
{
 $("#meter").animate({width:'100px'},300);
 meter.style.backgroundColor="#F5BCA9";
 document.getElementById("pass_type").innerHTML="Dobët";
}

if(no==3)
{
 $("#meter").animate({width:'150px'},300);
 meter.style.backgroundColor="#FF8000";
 document.getElementById("pass_type").innerHTML="Mirë";
}

if(no==4)
{
 $("#meter").animate({width:'200px'},300);
 meter.style.backgroundColor="#00FF40";
 document.getElementById("pass_type").innerHTML="Shumë Mirë";
}
}

else
{
meter.style.backgroundColor="";
document.getElementById("pass_type").innerHTML="";
}
}


</script>

</body>


</html>

<?php

if (isset($_POST['register'])) {

	$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
	$recaptcha_secret = '6Lc-xMgUAAAAAA1WSn8l-0oaTncpizb0bsbYE6C_';
	$recaptcha_response = $_POST['recaptcha_response'];
	$remoteip = $_SERVER['REMOTE_ADDR'];
	$recaptcha = file_get_contents(
		$recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response . $remoteip
	);
	$recaptcha = json_decode($recaptcha, TRUE);

	if ($recaptcha['success'] = 1) {

	$c_name = mysqli_real_escape_string($con, $_POST['c_name']);

	$c_email = mysqli_real_escape_string($con, $_POST['c_email']);

	$c_pass = mysqli_real_escape_string($con, $_POST['c_pass']);

	$encrypted_password = password_hash($c_pass, PASSWORD_DEFAULT);

	$c_country = mysqli_real_escape_string($con, $_POST['c_country']);

	$c_city = mysqli_real_escape_string($con, $_POST['c_city']);

	$c_contact = mysqli_real_escape_string($con, $_POST['c_contact']);

	$c_address = mysqli_real_escape_string($con, $_POST['c_address']);

	$c_image = $_FILES['c_image'] ['name'];

	$c_image_tmp = $_FILES['c_image'] ['tmp_name'];

	$c_ip = getRealUserIp();

  if(!filter_var($c_email, FILTER_VALIDATE_EMAIL)){
    echo "<script> alert('Emaili nuk është i vlefshëm!');</script>";
     exit();
  }

$allowed = array('jpeg','jpg','gif','png');

$file_extension = pathinfo($c_image, PATHINFO_EXTENSION);

if (!in_array($file_extension,$allowed)) {
  echo "<script>alert('Formati i imazhit nuk është i pranueshëm!');</script>";
   exit();
}else{
  move_uploaded_file($c_image_tmp, "customer/customer_images/$c_image");
}


	$get_email  = "select * from customers where customer_email='$c_email' ";

	$run_email = mysqli_query($con,$get_email);

	$check_email = mysqli_num_rows($run_email);

	if ($check_email == 1) {
		 echo "<script>alert('Ky email është regjistruar tashmë, provo një tjetër!') </script>";
		 exit();
	}

	$customer_confirm_code = mt_rand();

	$subject = "Mesazhi i konfirmimit të emailit.";

	$from = "info@shtaro.com";

	$message = "
	<h3>
		Përshëndetje <em>$c_name</em> <br /> Ky është Emaili i konfirmimit nga shtaro.com
	</h3>
	<a href='http://shtaro.com/customer/my_account.php?$customer_confirm_code'>
		Kliko këtu për të konfirmuar emailin!
	</a>
	";

	$headers = "From: $from \r\n";

	$headers .= "Content-type: text/html\r\n";

	mail($c_email, $subject, $message, $headers);

	$insert_customer = "insert into customers (customer_name,customer_email,customer_pass,customer_country,customer_city,customer_contact,customer_address,customer_image,customer_ip,customer_confirm_code)

    values ('$c_name','$c_email','$encrypted_password','$c_country','$c_city','$c_contact','$c_address','$c_image','$c_ip','$customer_confirm_code')";

    $run_customer = mysqli_query($con,$insert_customer);

		$last_insert_customer_id = mysqli_insert_id($con);

		$insert_customers_addresses = "insert into customers_addresses (customer_id) values
    ('$last_insert_customer_id')";

		$run_customers_addresses = mysqli_query($con, $insert_customers_addresses);

    $sel_cart = "select * from cart where ip_add='$c_ip'";

    $run_cart = mysqli_query($con,$sel_cart);

    $check_cart = mysqli_num_rows($run_cart);

    if ($check_cart>0) {

    	$_SESSION['customer_email']=$c_email;

    	echo "<script>alert ('Ju u Regjistruat me Sukses!')</script>";
    	echo "<script>window.open ('checkout.php','_self')</script>";

    } else{

    	$_SESSION['customer_email']=$c_email;

    	echo "<script>alert ('Ju u Regjistruat me Sukses!')</script>";
    	echo "<script>window.open ('index.php','_self')</script>";
    }

	}  else {
		 echo "<script>alert('Ju lutem plotësoni fushat e kërkuara!') </script>";
	}
}

?>

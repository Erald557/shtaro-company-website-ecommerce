
<?php

session_start();

include("includes/db.php");

include("functions/functions.php");

?>

<!DOCTYPE html>
<html>

<head>
<?php
	include("includes/head.php")
	?>

 <!-- recaptcha script-->
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


<div id="content"><!-- content starts-->

	   <div class="container"><!-- container starts-->

			<div class="col-md-12"><!-- col-md-12 starts-->

				<ul class="breadcrumb"><!-- breadcrumb starts-->

					<li>
						<a href="index.php">Kryefaqja</a>
					</li>

					<li>
						Na Kontaktoni
					</li>

				</ul><!-- breadcrumb ends-->

			</div><!-- col-md-12 ends-->


			<div class="col-md-12"><div class="google-map-1">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d33894.09562548009!2d19.4703859!3d41.334811!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x134fda388400e787%3A0x58d53e530dc84417!2sElektroitalia%20-%20Shtaro%20Shpk%20-%20Elektroshtepiake%20%2CDurres%2C%20Qender!5e0!3m2!1sit!2s!4v1574345945488!5m2!1sit!2s" width="100%" height="400" frameborder="0" style="border:0;" allowfullscreen=""></iframe></div>
			</div>


         <div class="col-md-12 cont-wrap box">
			<div class="col-lg-5 col-md-5">
				<div class="contact_details">
					<h3 class="page-subheading">Kontakte</h3>
					<p class="short-description"></p>
					<div class="contact_info">
					<div class="info_main clearfix border_right">
					<div class="fa fa-map-marker icons"><span class="hidden">hidden</span></div>
					<div class="flex">
					<p class="tit-name">Adresa</p>
					<p class="tit-contain">Lgj 11, Bulevardi Dyrrah, Durrës</p>
					<p class="tit-contain">(DR) - Shqipëri</p>
					</div>
					</div>
					<div class="info_main clearfix border_right">
					<div class="fa fa-phone icons"><span class="hidden">hidden</span></div>
					<div class="flex">
					<p class="tit-name">Telefon</p>
					<p class="tit-contain">+355 (0)52 237389 | +355 (0)67 2446297</p>
					</div>
					</div>
					<div class="info_main clearfix">
					<div class="fa fa-envelope icons"><span class="hidden">hidden</span></div>
					<div class="flex">
					<p class="tit-name">Email</p>
					<p class="tit-contain"><a href="mailto:info@shtaro.com">info@shtaro.com</a></p>
					</div>
					</div>
					<div class="info_main clearfix">
					<div class="fa fa-clock-o icons"><span class="hidden">hidden</span></div>
					<div class="flex">
					<p class="tit-name">Orari</p>
					<p class="tit-contain">Hënë-Shtunë 08:00 - 20:00<br> E Dielë: 08:00 - 16:00</p>
					</div>
					</div>
					</div>
					</div>
					</div>


		  	<div class="col-lg-7 col-md-7"><!-- col-md-12 starts-->

		  		<div class="subox box"><!-- box starts-->

		  			<div class="box-header"><!-- box-header starts-->

		  				<center><!-- center starts-->
								<?php
									$get_contact_us = "select * from contact_us";
									$run_contact_us = mysqli_query($con,$get_contact_us);
									$row_contact_us = mysqli_fetch_array($run_contact_us);
									$contact_heading = $row_contact_us['contact_heading'];
									$contact_desc = $row_contact_us['contact_desc'];
									$contact_email = $row_contact_us['contact_email'];

								 ?>

		  					<h2> <?php	echo "$contact_heading"; ?> </h2>

		  					<p class="text-muted">
									<?php echo "$contact_desc"; ?>
		  					</p>

		  				</center><!-- center ends-->

		  			</div><!-- box-header ends-->

		  				<form action="contact.php" method="post" accept-charset="utf-8"><!-- form starts-->

	  					<div class="form-group"><!-- form-group starts-->

                  <label> Emër </label>

                  <input type="text" class="form-control" name="name" required>

	  					</div><!-- form-group ends-->

	  						<div class="form-group"><!-- form-group starts-->

	  							<label> Email </label>

	  							<input type="text" class="form-control" name="email" required>

	  						</div><!-- form-group ends-->

	  							<div class="form-group"><!-- form-group starts-->

	  								<label> Subjekti </label>

	  								<input type="text" class="form-control" name="subject" required>

	  							</div><!-- form-group ends-->

	  								<div class="form-group"><!-- form-group starts-->

	  									<label> Mesazhi </label>

	  									<textarea class="form-control" name="message"></textarea>

	  								</div><!-- form-group ends-->

										<div class="form-group"><!-- form-group starts-->

	  									<label> Specifikoni Pyetjen </label>

	  									<select class="form-control" name="enquiry_type"><!-- select starts-->
												<option>
													Specifikoni Pyetjen
												</option>
												<?php
													$get_enquiry_types = "select * from enquiry_types";
													$run_enquiry_types = mysqli_query($con,$get_enquiry_types);
													while ($row_enquiry_types = mysqli_fetch_array($run_enquiry_types)) {
														$enquiry_title = $row_enquiry_types['enquiry_title'];
														echo "<option>
														$enquiry_title
														</option>";
													}
												 ?>
	  									</select><!-- select end-->

	  								</div><!-- form-group ends-->

	  								  <div class="text-center"><!-- text-center starts-->
												<input type="hidden" name="recaptcha_response" id="recaptchaResponse">
	  								  	<button type="submit" name="submit" class="btn btn-primary">

	  								  		<i class="fa fa-paper-plane"> Dërgo Mesazhin </i>

	  								  	</button>

	  								  </div><!-- text-center ends-->


		  				</form><!-- form ends-->

		  				<?php

                          if (isset($_POST['submit'])) {

														$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
														$recaptcha_secret = '6Lc-xMgUAAAAAA1WSn8l-0oaTncpizb0bsbYE6C_';
														$recaptcha_response = $_POST['recaptcha_response'];
														$remoteip = $_SERVER['REMOTE_ADDR'];
														$recaptcha = file_get_contents(
															$recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response . $remoteip
														);
														$recaptcha = json_decode($recaptcha, TRUE);

														if ($recaptcha['success'] = 1) {


                         //Admin receives email through this code

                           $sender_name = $_POST['name'];

                           $sender_email = $_POST['email'];

                           $sender_subject = $_POST['subject'];

                           $sender_message = $_POST['message'];

													 $enquiry_type = $_POST['enquiry_type'];

													 $new_message = "
													 <h2>Ky mesazh u dërgua nga <em>$sender_name</em></h2>
													 <p>
													 	<strong>Emaili : </strong> $sender_email
													 </p>
													 <p>
													 	<strong>Subjekti : </strong> $sender_subject
													 </p>
													 <p>
													 	<strong>Pyetja : </strong> $enquiry_type
													 </p>
													 <p>
													 	<strong>Mesazhi : </strong> $sender_message
													 </p>
													 ";
													 $headers = "From $sender_email \r\n";

													 $headers .= "MIME-Version: 1.0\r\n";

													 $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                           mail($contact_email, $sender_subject, $new_message, $headers);

                           //send email to sender through this code

                           $email = $_POST['email'];

                           $subject = "Mirëseerdhet Në Sitin Tonë!";

                           $msg = "Faleminderit që na dërguat një email, do tju kontaktojmë së shpejti.";

                           $from = "info@shtaro.com";

													 $headers = "From: $from \r\n";
													 $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                           mail($email,$subject,$msg,$headers);

                           echo "<h2 class='text-center'>Mesazhi juaj u dërgua me sukses!</h2>";
                          }

                           else {

                           	 echo "<script>alert('Të lutem Provo Sërish') </script>";
                           }

                        }

		  				?>

		  		</div><!-- box ends-->

		  	</div><!-- col-md-12 ends-->

		  </div>

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
    grecaptcha.execute('6Lc-xMgUAAAAALFDMhczUXGv5H-UkhzGoLCf6Ts1', {action: 'contact'}).then(function(token) {
			var recaptchaResponse = document.getElementById('recaptchaResponse');
			recaptchaResponse.value = token;
    });
});
</script>
</body>


</html>

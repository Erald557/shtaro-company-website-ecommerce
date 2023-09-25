

<div id="footer"><!--footer starts-->

	<div class="container"><!--container starts-->

		<div class="row"><!--row starts-->

			<div class="col-md-3 col-sm-4 col-xs-12"><!--col-md-3 col-sm-4 col-xs-12 starts-->

				<h4>Faqet</h4>

				<ul><!--ul starts-->

					<li><a href="cart.php">Shporta Blerjeve</a></li>
					<li><a href="contact.php">Na Kontaktoni</a></li>
					<li><a href="shop.php">Dyqani</a></li>
					<li><?php

                         if (!isset($_SESSION['customer_email'])) {
                          echo "<a href='checkout.php'> Llogaria Ime</a>";
                         }
                         else{
                          echo "<a href='customer/my_account.php?my_orders'> Llogaria Ime </a>";
                         }
            ?></li>

				</ul><!--ul endss-->

				<hr>

				<h4>Seksioni Përdoruesit</h4>

				<ul><!--ul starts-->

					<li><?php

                         if (!isset($_SESSION['customer_email'])) {
                          echo "<a href='checkout.php'> Login</a>";
                         }
                         else{
                          echo "<a href='customer/my_account.php?my_orders'> Llogaria Ime </a>";
                         }
            ?></li>
					<li><a href="customer_register.php">Regjistrohu</a></li>

          <li><a href="terms.php">Termat dhe Kushtet</a></li>

					<hr class="hidden-md hidden-lg hidden-sm">

				</ul><!--ul ends-->


			</div><!--col-md-3 col-sm-4 col-xs-12 ends-->

			<div class="col-md-3 col-sm-4 col-xs-12"><!--col-md-3 col-sm-4 col-xs-12 starts-->

				<h4> Kategoritë </h4>

				<ul><!--ul starts-->

                 <?php
                   $get_p_cats = "select * from product_categories limit 0,10";
                   $run_p_cats = mysqli_query($con,$get_p_cats);

                   while ($row_p_cats = mysqli_fetch_array($run_p_cats)) {
                   	$p_cat_id = $row_p_cats['p_cat_id'];
                   	$p_cat_title = $row_p_cats['p_cat_title'];

                   	echo "<li> <a href='shop.php?p_cat=$p_cat_id'> $p_cat_title</a></li>";
                   }
                 ?>

				</ul><!--ul ends-->

			</div><!--col-md-3 col-sm-4 col-xs-12 ends-->

             <div class="col-md-3 col-sm-4 col-xs-12"><!--col-md-3 col-sm-4 col-xs-12 starts-->

             	<h4> Ku të na gjeni </h4>

             	<p><!--p starts-->
             		<strong> Elektroitalia Shtaro-Shpk</strong>
             		<br> Bulevardi Dyrrah
             		<br> Durrës
             		<br> Tel:+355 (0)52 237389
                <br> Cel:+355 (0)67 2446297
             		<br> info@shtaro.com
             	</p><!--p ends-->

             	 <a href="contact.php">Na Kontakto</a>

             	 <hr class="hidden-md hidden-lg">

             </div><!--col-md-3 col-sm-4 col-xs-12 ends-->

              <div class="col-md-3 col-sm-4 col-xs-12"><!--col-md-3 col-sm-4 col-xs-12 starts-->

              	<h4> Më të fundit</h4>

              	<p class="text-muted">
              	 Regjistrohuni për tu informuar mbi të rejat e fundit!

              	</p>

              	<form action="" method="post"><!--form starts-->

              		<div class="input-group"><!--input-group starts-->

              			<input type="text" class="form-control" name="email"  placeholder="Vendosni E-mail Tuaj">

              			<span class="input-group-btn"><!--input-group-btn starts-->

              				<input type="submit" value="Regjistrohuni" class="btn btn-default">

              			</span><!--input-group-btn ends-->


              		</div><!--input-group ends-->

              	</form><!--form ends-->

              	 <hr>

              	 <h4> Na ndiqni</h4>

              	 <p class="social"><!--social starts-->

              	 	<a href="https://www.facebook.com/elektroitaliashtaroshpk/" target="_blank"><i class="fa fa-facebook"></i></a>
              	 	<a href="https://www.instagram.com/elektroitalia_electronics" target="_blank"><i class="fa fa-instagram"></i></a>
              	 	<a href="mailto:info@shtaro.com"><i class="fa fa-envelope"></i></a>


              	 </p><!--social ends-->


              </div><!--col-md-3 col-sm-4 col-xs-12 ends-->

		</div><!--row ends-->

	</div><!--container ends-->

</div><!--footer endss-->


<div id="copyright"><!--copyright starts-->

	<div class="container"><!--container starts-->

		<div class="col-md-6"><!--col-md-6 starts-->

			<p class="pull-left"> &copy; 2020 Elektroitalia Shtaro Shpk</p>

		</div><!--col-md-6 ends-->

		  <div class="col-md-6"><!--col-md-6 starts-->

			<p class="pull-right">

				Template by <a href="#">zippedev</a>
			</p>

		  </div><!--col-md-6 ends-->

	</div><!--container ends-->

</div><!--copyright ends-->

<!-- Load Facebook SDK for JavaScript -->
      <div id="fb-root"></div>
      <script>
        window.fbAsyncInit = function() {
          FB.init({
            xfbml            : true,
            version          : 'v5.0'
          });
        };

        (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/sq_AL/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>

      <!-- Your customer chat code -->
      <div class="fb-customerchat"
        attribution=setup_tool
        page_id="100329318117117"
        theme_color="#ff7e29"
        logged_in_greeting="Përshëndetje! Si mund tju ndihmojmë?"
        logged_out_greeting="Përshëndetje! Si mund tju ndihmojmë?">
      </div>

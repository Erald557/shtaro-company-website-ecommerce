<?php

if (!isset($_SESSION['admin_email'])) {

	echo "<script>window.open('login.php','_self') </script>";
}

else {


?>

<nav class="navbar navbar-inverse navbar-fixed-top"><!--navbar navbar-inverse navbar-fixed-top start-->
	<div class="navbar-header"><!--navbar-header start-->
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"><!--navbar-ex1-collapse start-->

			<span class="sr-only">Toggle Navigation</span>

			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>

		</button><!--navbar-ex1-collapse end-->

		<a href="index.php?dashboard" class="navbar-brand"> Admin Panel</a>

	</div><!--navbar-header end-->

	<ul class="nav navbar-right top-nav"><!--nav navbar-right top-nav start-->
		<li class="dropdown"><!--dropdown start-->
			<a href="#" class="dropdown-toggle" data-toggle="dropdown"><!--dropdown-toggle start-->
				<i class="fa fa-user"></i>
				<?php echo "$admin_name"; ?> <b class="caret"></b>
			</a><!--dropdown-toggle end-->

			<ul class="dropdown-menu"><!--dropdown-menu start-->
				<li><!--li start-->
					<a href="index.php?user_profile= <?php echo $admin_id; ?>">
						<i class="fa fa-fw fa-user"></i> Profile
					</a>
				</li><!--li end-->
				<li><!--li start-->
					<a href="index.php?view_products">
						<i class="fa fa-fw fa-envelope"></i> Products

						<span class="badge"><?php echo "$count_products"; ?></span>
					</a>
				</li><!--li end-->
				<li><!--li start-->
					<a href="index.php?view_customers">
						<i class="fa fa-fw fa-gear"></i> Customers

						<span class="badge"><?php echo "$count_customers"; ?></span>
					</a>
				</li><!--li end-->
				<li><!--li start-->
					<a href="index.php?view_p_cats">
						<i class="fa fa-fw fa-gear"></i> Product Categories

						<span class="badge"><?php echo "$count_p_categories"; ?></span>
					</a>
				</li><!--li end-->
				<li class="divider"></li>
				<li><!--li start-->
					<a href="logout.php">
						<i class="fa fa-fw fa-power-off"></i> Logout
					</a>
				</li><!--li end-->
			</ul><!--dropdown-menu end-->
		</li><!--dropdown end-->
	</ul><!--nav navbar-right top-nav end-->

	<div class="collapse navbar-collapse navbar-ex1-collapse"><!--collapse navbar-collapse navbar-ex1-collapse start-->
		<ul class="nav navbar-nav side-nav"><!--nav navbar-nav side-nave start-->
			<li><!--li start-->
				<a href="index.php?dashboard">
					<i class="fa fa-fw fa-dashboard"></i> Dashboard
				</a>
			</li><!--li end-->
			<li><!--li start-->
				<a href="#products" data-toggle="collapse">
					<i class="fa fa-fw fa-table"></i> Products
					<i class="fa fa-fw fa-caret-down"></i>
				</a>

				<ul id="products" class="collapse">
					<li>
						<a href="index.php?insert_product"> Insert Products</a>
					</li>
					<li>
						<a href="index.php?view_products"> View Products</a>
					</li>
				</ul>
			</li><!--li end-->

			<li><!--Bundle li start-->
				<a href="#bundles" data-toggle="collapse">
					<i class="fa fa-fw fa-edit"></i> Bundles
					<i class="fa fa-fw fa-caret-down"></i>
				</a>

				<ul id="bundles" class="collapse">
					<li>
						<a href="index.php?insert_bundle"> Insert Bundle</a>
					</li>
					<li>
						<a href="index.php?view_bundles"> View Bundles</a>
					</li>
				</ul>
			</li><!-- Bundle li end-->

			<li><!--Relations Bundle li start-->
				<a href="#relations" data-toggle="collapse">
					<i class="fa fa-fw fa-retweet"></i> Assign Products To Bundle Relations
					<i class="fa fa-fw fa-caret-down"></i>
				</a>

				<ul id="relations" class="collapse">
					<li>
						<a href="index.php?insert_rel"> Insert Relation</a>
					</li>
					<li>
						<a href="index.php?view_rel"> View Relations</a>
					</li>
				</ul>
			</li><!--Relations Bundle li end-->

			<li><!--shipping li start-->
				<a href="#shipping" data-toggle="collapse">
					<i class="fa fa-fw fa-truck"></i> Ecommerce Shipping
					<i class="fa fa-fw fa-caret-down"></i>
				</a>

				<ul id="shipping" class="collapse">
					<li>
						<a href="index.php?insert_shipping_zone"> Insert Shipping Zone</a>
					</li>
					<li>
						<a href="index.php?view_shipping_zones"> View Shipping Zones</a>
					</li>
					<li>
						<a href="index.php?insert_shipping_type"> Insert Shipping Type</a>
					</li>
					<li>
						<a href="index.php?view_shipping_types"> View Shipping Types</a>
					</li>
				</ul>
			</li><!--shipping li end-->

      <li><!--countries li start-->
				<a href="#countries" data-toggle="collapse">
					<i class="fa fa-globe"></i> Countries
					<i class="fa fa-fw fa-caret-down"></i>
				</a>

				<ul id="countries" class="collapse">
					<li>
						<a href="index.php?insert_country"> Insert Country</a>
					</li>
          <li>
						<a href="index.php?view_countries"> View Countries</a>
					</li>
				</ul>
			</li><!--countries li end-->

			<li><!--li start-->
				<a href="#manufacturers" data-toggle="collapse">
					<i class="fa fa-fw fa-briefcase"></i> Manufacturers
					<i class="fa fa-fw fa-caret-down"></i>
				</a>

				<ul id="manufacturers" class="collapse">
					<li>
						<a href="index.php?insert_manufacturer"> Insert Manufacturer</a>
					</li>
					<li>
						<a href="index.php?view_manufacturers"> View Manufacturers</a>
					</li>
				</ul>
			</li><!--li end-->

			<li><!--li start-->
				<a href="#p_cat" data-toggle="collapse">
					<i class="fa fa-fw fa-pencil"></i> Products Categories
					<i class="fa fa-fw fa-caret-down"></i>
				</a>

				<ul id="p_cat" class="collapse">
					<li>
						<a href="index.php?insert_p_cat"> Insert Product Category</a>
					</li>
					<li>
						<a href="index.php?view_p_cats"> View Products Categories</a>
					</li>
				</ul>
			</li><!--li end-->

			<li><!--li start-->
				<a href="#cat" data-toggle="collapse">
					<i class="fa fa-fw fa-arrows-v"></i> Categories
					<i class="fa fa-fw fa-caret-down"></i>
				</a>

				<ul id="cat" class="collapse">
					<li>
						<a href="index.php?insert_cat"> Insert Category</a>
					</li>
					<li>
						<a href="index.php?view_cats"> View Categories</a>
					</li>
				</ul>
			</li><!--li end-->

			<li><!--li Box start-->
				<a href="#boxes" data-toggle="collapse">
					<i class="fa fa-fw fa-arrows"></i> Boxes Section
					<i class="fa fa-fw fa-caret-down"></i>
				</a>

				<ul id="boxes" class="collapse">
					<li>
						<a href="index.php?insert_box"> Insert Box</a>
					</li>
					<li>
						<a href="index.php?view_boxes"> View Boxes</a>
					</li>
				</ul>
			</li><!--li Box end-->

			<li><!--li services start-->
				<a href="#services" data-toggle="collapse">
					<i class="fa fa-fw fa-briefcase"></i> Services
					<i class="fa fa-fw fa-caret-down"></i>
				</a>

				<ul id="services" class="collapse">
					<li>
						<a href="index.php?insert_service"> Insert Service</a>
					</li>
					<li>
						<a href="index.php?view_services"> View Services</a>
					</li>
				</ul>
			</li><!--li services end-->

			<li><!--li Contact start-->
				<a href="#contact_us" data-toggle="collapse">
					<i class="fa fa-fw fa-pencil"></i> Contact Us Section
					<i class="fa fa-fw fa-caret-down"></i>
				</a>
				<ul id="contact_us" class="collapse">
					<li>
						<a href="index.php?edit_contact_us"> Edit Contact Us</a>
					</li>
					<li>
						<a href="index.php?insert_enquiry"> Insert Enquiry Type</a>
					</li>
					<li>
						<a href="index.php?view_enquiry"> View Enquiry Types</a>
					</li>
				</ul>
			</li><!--li Contact end-->

			<li><!--li about us start-->
				<a href="index.php?edit_about_us">
					<i class="fa fa-fw fa-edit"></i> Edit About Us Page
				</a>
			</li><!--li about us end-->

			<li><!--coupon section li start-->
				<a href="#" data-toggle="collapse" data-target="#coupons">
					<i class="fa fa-fw fa-arrows-v"></i> Coupons
					<i class="fa fa-fw fa-caret-down"></i>
				</a>
				<ul id="coupons" class="collapse">
					<li>
						<a href="index.php?insert_coupon"> Insert Coupon</a>
					</li>
					<li>
						<a href="index.php?view_coupons"> View Coupons</a>
					</li>
				</ul>
			</li><!--coupon section li end-->

			<li><!--li start-->
				<a href="#slides" data-toggle="collapse">
					<i class="fa fa-fw fa-gear"></i> Banners
					<i class="fa fa-fw fa-caret-down"></i>
				</a>

				<ul id="slides" class="collapse">
					<li>
						<a href="index.php?insert_slide"> Insert Slide</a>
					</li>
					<li>
						<a href="index.php?view_slides"> View Slides</a>
					</li>
				</ul>
			</li><!--li end-->

			<li><!--li start-->
				<a href="#terms" data-toggle="collapse">
					<i class="fa fa-fw fa-table"></i> Terms
					<i class="fa fa-fw fa-caret-down"></i>
				</a>

				<ul id="terms" class="collapse">
					<li>
						<a href="index.php?insert_term"> Insert Terms</a>
					</li>
					<li>
						<a href="index.php?view_terms"> View Terms</a>
					</li>
				</ul>
			</li><!--li end-->

			<li><!--li start-->
				<a href="index.php?edit_css">
					<i class="fa fa-fw fa-list"></i> Edit Css File
				</a>
			</li><!--li end-->

			<li>
				<a href="index.php?view_customers">
					<i class="fa fa-fw fa-edit"></i> View Customers
				</a>
			</li>
			<li>
				<a href="index.php?view_orders">
					<i class="fa fa-fw fa-list"></i> View Orders
				</a>
			</li>
			<li>
				<a href="index.php?view_payments">
					<i class="fa fa-fw fa-pencil"></i> View Payments
				</a>
			</li>

			<li><!--li start-->
				<a href="#users" data-toggle="collapse">
					<i class="fa fa-fw fa-gear"></i> Users
					<i class="fa fa-fw fa-caret-down"></i>
				</a>

				<ul id="users" class="collapse">
					<li>
						<a href="index.php?insert_user"> Insert User</a>
					</li>
					<li>
						<a href="index.php?view_users"> View Users</a>
					</li>
					<li>
						<a href="index.php?user_profile= <?php echo $admin_id; ?> "> Edit Profile</a>
					</li>
				</ul>
			</li><!--li end-->

			<li><!--li start-->
				<a href="logout.php">
					<i class="fa fa-fw fa-power-off"> </i> Logout
				</a>
			</li><!--li end-->
		</ul><!--nav navbar-nav side-nave end-->
	</div><!--collapse navbar-collapse navbar-ex1-collapse end-->
</nav><!--navbar navbar-inverse navbar-fixed-top end-->

<?php } ?>

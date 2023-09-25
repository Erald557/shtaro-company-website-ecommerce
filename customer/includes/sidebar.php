
<div class="panel panel-default sidebar-menu"><!--panel panel-default sidebar-menu starts-->

	<div class="panel-heading"><!--panel-heading starts-->

	<?php

      $customer_session = $_SESSION['customer_email'];

      $get_customer = "select * from customers where customer_email='$customer_session'";

      $run_customer = mysqli_query($con,$get_customer);

      $row_customer = mysqli_fetch_array($run_customer);

      $customer_image = $row_customer['customer_image'];

      $customer_name = $row_customer['customer_name'];

      if (!isset($_SESSION['customer_email'])) {


      }
      else{

          echo "

            <center>
              <img src='customer_images/$customer_image' class='img-responsive'>
            </center>
            <br>

            <h3 align='center' class='panel-title'> Emri : $customer_name </h3>
          ";
      }
     ?>

	</div><!--panel-heading ends-->

     <div class="panel-body"><!--panel-body starts-->

     	<ul class="nav nav-pills nav-stacked"><!--nav nav-pills nav-stacked starts-->

     		<li class="<?php if(isset($_GET['my_orders'])) {echo "active";} ?>">
     			<a href="my_account.php?my_orders"><i class="fa fa-list"></i> Porositë e Mia </a>
     		</li>

        <li class="<?php if(isset($_GET['my_addresses'])) {echo "active";} ?>">
     			<a href="my_account.php?my_addresses"><i class="fa fa-list"></i> Adresat e Mia </a>
     		</li>

     		<li class="<?php if(isset($_GET['pay_offline'])) {echo "active";} ?>">
     			<a href="my_account.php?pay_offline"> <i class="fa fa-bolt"></i> Paguaj Offline </a>
     		</li>

     		<li class="<?php if(isset($_GET['edit_account'])) {echo "active";} ?>">
     			<a href="my_account.php?edit_account"> <i class="fa fa-pencil"></i> Modifiko Llogarinë </a>
     		</li>

     		<li class="<?php if(isset($_GET['change_pass'])) {echo "active";} ?>">
     			<a href="my_account.php?change_pass"> <i class="fa fa-user"></i> Ndrysho Passwordin </a>
     		</li>

				<li class="<?php if(isset($_GET['my_wishlist'])) {echo "active";} ?>">
     			<a href="my_account.php?my_wishlist"> <i class="fa fa-heart"></i> Lista e Dëshirave </a>
     		</li>

     		<li class="<?php if(isset($_GET['delete_account'])) {echo "active";} ?>">
     			<a href="my_account.php?delete_account"> <i class="fa fa-trash-o"></i> Fshi Llogarinë </a>
     		</li>

     		<li>
     			<a href="logout.php"> <i class="fa fa-sign-out"></i> Dil </a>
     		</li>
     	</ul><!--nav nav-pills nav-stacked ends-->

     </div><!--panel-body ends-->


</div><!--panel panel-default sidebar-menu ends-->

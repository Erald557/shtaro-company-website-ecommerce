<?php

if (!defined("customer_login")) {
  echo "<script>window.open('../checkout.php','_self');</script>";
}
 ?>
<div class="box login-form"><!-- box starts-->

    <div class="box-header"><!-- box-header starts-->

        <center>
            <p class="lead">Duhet të logoheni për të vazhduar! </p>
        </center>

    </div><!-- box-header ends-->

    <form action="checkout.php" method="post"><!-- form starts-->

        <div class="form-group"><!-- form-group starts-->
            <label> Email </label>

            <input type="text" class="form-control" name="c_email" required>

        </div><!-- form-group ends-->

        <div class="form-group"><!-- form-group starts-->
            <label>Password</label>
            <input type="password" class="form-control" name="c_pass" required>
            <h6 align="center">
              <a href="forgot_pass.php">Kam harruar Paswordin</a>
            </h6>
        </div><!-- form-group starts-->

        <div class="text-center"><!-- text-center starts-->
            <button name="login" value="Login" class="btn btn-primary">
                <i class="fa fa-sign-in"></i> Logohu
            </button>
        </div><!-- text-center ends-->

    </form><!-- form ends-->
     <center><!-- center starts-->

            <h3> Nuk keni Llogari?<br> Atëhere <a href="customer_register.php">Regjistrohuni Ketu </a></h3>

     </center><!-- center ends-->
</div><!-- box ends-->

<?php

 if (isset($_POST['login'])) {

    $customer_email = mysqli_real_escape_string($con, $_POST['c_email']);

    $customer_pass = mysqli_real_escape_string($con, $_POST['c_pass']);

    $select_customer = "select * from customers where customer_email='$customer_email'";

    $run_customer = mysqli_query($con,$select_customer);

    $check_customer = mysqli_num_rows($run_customer);

    $row_customer = mysqli_fetch_array($run_customer);

    $hash_password = $row_customer['customer_pass'];

    $decrypt_password = password_verify($customer_pass, $hash_password);

    if ($decrypt_password == 0) {
      echo "<script>alert('Passwordi ose Emaili nuk është i saktë!')</script>";
      exit();
    }

    $get_ip = getRealUserIp();

    $select_cart = "select * from cart where ip_add='$get_ip'";

    $run_cart = mysqli_query($con,$select_cart);

    $check_cart = mysqli_num_rows($run_cart);


    if ($check_customer==1 AND $check_cart==0) {

        $_SESSION['customer_email']=$customer_email;

        echo "<script>window.open('customer/my_account.php?my_orders','_self') </script>";
    }
    else {

        $_SESSION['customer_email']=$customer_email;

        echo "<script>window.open('checkout.php','_self') </script>";
    }
 }

?>

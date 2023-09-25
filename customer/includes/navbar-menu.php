<div class="navbar-header"><!-- navbar-header starts-->
  <a class="navbar-brand home" href="index.php"><!-- navbar-brand home starts-->

    <img src="images/Logo_shtaro.png" alt="elektroitalia logo">

  </a><!-- navbar-brand home ends-->
  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation">
    <span class="sr-only">Toggle Navigation</span>
    <i class="fa fa-align-justify"></i>
  </button>
  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#search">
    <span class="sr-only">Toggle Search</span>
    <i class="fa fa-search"></i>
  </button>
</div><!-- navbar-header ends-->
<div class="navbar-collapse collapse" id="navigation"><!-- navbar-collapse collapse starts-->

  <div class="padding-nav"><!-- padding-nav starts-->

    <ul class="nav navbar-nav navbar-left"><!-- nav navbar-nav navbar-left starts-->
      <li class="active">
        <a href="../index.php">Kryefaqja</a>

      </li>

      <li>
        <a href="../shop.php">Dyqani</a>
      </li>

      <li>
        <a href="../about_us.php">Rreth Nesh</a>
      </li>

      <li>
        <a href="../services.php">Shërbime</a>
      </li>

      <li>
        <a href="../contact.php">Na Kontaktoni</a>
      </li>

    </ul><!-- nav navbar-nav navbar-left ends-->
  </div><!-- padding-nav ends-->
  <a class="btn btn-primary navbar-btn right" href="cart.php"><!-- btn btn-primary navbar-btn right starts-->
    <i class="fa fa-shopping-cart"></i>

    <span> <?php items();?> Produkte në Shportë</span>
  </a><!-- btn btn-primary navbar-btn right ends-->

  <div class="navbar-collapse collapse right"><!-- navbar-collapse collapse right starts-->

    <button class="btn navbar-btn btn-primary" type="button" data-toggle="collapse" data-target="#search">
      <span class="sr-only">Toggle Search</span>
      <i class="fa fa-search"></i>
    </button>
  </div><!-- navbar-collapse collapse right ends-->
  <div class="collapse clearfix" id="search"><!--collapse clearfix starts-->
    <form class="navbar-form" method="get" action="results.php"><!--navbar-form starts-->
      <div class="input-group"><!--input-group starts-->
        <input class="form-control" type="text" placeholder="Search" name="user_query" required>
        <span class="input-group-btn"><!--input-group-btn starts-->
          <button type="submit" value="Search" name="search" class="btn btn-primary">
            <i class="fa fa-search"></i>
          </button>
        </span><!--input-group-btn ends-->
      </div><!--input-group ends-->


    </form><!--navbar-form ends-->

  </div><!--collapse clearfix ends-->

</div><!-- navbar-collapse collapse ends-->

<?php

if (!isset($_SESSION['admin_email'])) {

	echo "<script>window.open('login.php','_self') </script>";
}

else {


?>

<div class="row"><!-- row start-->
	<div class="col-lg-12"><!-- col-lg-12 start-->

		<ol class="breadcrumb"><!-- breadcrumb start-->
			<li class="active">
				<i class="fa fa-dashboard"></i>Dashboard / View Countries
			</li>
		</ol><!-- breadcrumb start-->
	</div><!-- col-lg-12 end-->

</div><!-- row end-->

<div class="row"><!--2 row start-->
   <div class="col-lg-12"><!-- col-lg-12 start-->

   	<div class="panel panel-default"><!-- panel panel-default start-->
   		<div class="panel-heading"><!-- panel-heading start-->

   			<h3 class="panel-title"><!-- panel-title start-->
   				<i class="fa fa-money fa-fw"></i> View Countries
   			</h3><!-- panel-title end-->
   		</div><!-- panel-heading end-->

   		<div class="panel-body"><!-- panel-body start-->
        <p class="lead"> Shipping Local Types</p>
        <div class="table-responsive"><!-- table-responsive start-->
   				<table class="table table-bordered table-hover table-striped local-types"><!-- table table-bordered table-hover table-striped start-->

   					<thead>
   						<tr>
   							<th>Country No:</th>
   							<th>Country Name:</th>
   							<th>Actions:</th>
   						</tr>
   					</thead>
   					<tbody>
   					<?php
            $per_page = 15;
            if (!empty($_GET['view_countries'])) {
              $page = $_GET['view_countries'];

            }else {
              $page = 1;
            }
            //Page will start from 0 and multiply by $per_page
            $start_from = ($page-1) * $per_page;

            //Selecting the data from table with limit
            $select_countries = "select * from countries order by 1 desc LIMIT $start_from,$per_page";
            $run_countries = mysqli_query($con,$select_countries);
            $i = 0;
            while ($row_countries = mysqli_fetch_array($run_countries)) {
            $country_id = $row_countries['country_id'];
            $country_name = $row_countries['country_name'];
            $i++;

             ?>
             <tr>
               <td> <?php echo $i; ?></td>
               <td> <?php echo $country_name; ?></td>
               <td>
                 <div class="dropdown"><!-- dropdown start-->
                  <button class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                    <span class="caret">
                  </button>
                      <ul class="dropdown-menu dropdown-menu-right"><!-- dropdown-menu dropdown-menu-right start-->
                        <li>
                          <a href="index.php?edit_country=<?php echo $country_id; ?>">
                            <i class="fa fa-pencil"></i> Edit
                          </a>
                        </li>
                        <li>
                          <a href="index.php?delete_country=<?php echo $country_id; ?>">
                            <i class="fa fa-trash-o"></i> Delete
                          </a>
                        </li>
                      </ul><!-- dropdown-menu dropdown-menu-right end-->
                    </span>
                 </div> <!-- dropdown end-->
             </td>
             </tr>

             <?php } ?>

   					</tbody>
   				</table> <!-- table table-bordered table-hover table-striped end-->

        </div><!-- table-responsive end-->

        <center><!-- center start-->
          <ul class="pagination">
          <?php
          //Select all from table
          $select_countries = "select * from countries order by 1 DESC";
          $run_countries = mysqli_query($con, $select_countries);
          //Count the total records
          $count_countries = mysqli_num_rows($run_countries);
          //Using ce3ll function to divide the total records per page
          $total_pages = ceil ($count_countries / $per_page);
          // Going to first page
          echo "
            <li class='page-item'>
              <a href='index.php?view_countries=1' class='page-link'>
                First Page
              </a>
            </li>";
            for ($i=max(1, $page -3); $i <=min($page + 3, $total_pages); $i++) {
              if ($i == $page) {
                $active = "active";
              }else {
                $active = "";
              }
              echo "
                <li class='page-item $active'>
                  <a href='index.php?view_countries=$i' class='page-link'>
                    $i
                  </a>
                </li>";
            }

            // Going to last page
            echo "
              <li class='page-item'>
                <a href='index.php?view_countries=$total_pages' class='page-link'>
                  Last Page
                </a>
              </li>";
           ?>
          </ul>

          </ul>
        </center><!-- center end-->

   		</div><!-- panel-body end-->

   	</div><!-- panel panel-default end-->

   </div><!-- col-lg-12 end-->

</div><!--2 row end-->


<?php } ?>

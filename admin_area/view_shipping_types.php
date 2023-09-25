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
				<i class="fa fa-dashboard"></i>Dashboard / View Shipping Types
			</li>
		</ol><!-- breadcrumb start-->
	</div><!-- col-lg-12 end-->

</div><!-- row end-->

<div class="row"><!--2 row start-->
   <div class="col-lg-12"><!-- col-lg-12 start-->

   	<div class="panel panel-default"><!-- panel panel-default start-->
   		<div class="panel-heading"><!-- panel-heading start-->

   			<h3 class="panel-title"><!-- panel-title start-->
   				<i class="fa fa-money fa-fw"></i> View Shipping Types
   			</h3><!-- panel-title end-->
   		</div><!-- panel-heading end-->

   		<div class="panel-body"><!-- panel-body start-->
        <p class="lead"> Shipping Local Types</p>
   				<table class="table table-bordered table-hover table-striped local-types"><!-- table table-bordered table-hover table-striped start-->

   					<thead>
   						<tr>
   							<th>Type Order:</th>
   							<th>Type Name:</th>
   							<th>Type Rates:</th>
                <th>Type Default:</th>
   							<th>Actions:</th>
   						</tr>
   					</thead>
   					<tbody>
   						<?php
               $select_shipping_types = "select * from shipping_types where type_local='yes'
               order by type_order";
               $run_shipping_types = mysqli_query($con, $select_shipping_types);
               while ($row_shipping_types = mysqli_fetch_array($run_shipping_types)) {
                 $type_id = $row_shipping_types['type_id'];
                 $type_name = $row_shipping_types['type_name'];
                 $type_default = $row_shipping_types['type_default'];
                 $type_order = $row_shipping_types['type_order'];

   						 ?>

   						 <tr id="<?php echo $type_id; ?>">
   							<td><?php echo "$type_order"; ?></td>
                <td><?php echo "$type_name"; ?></td>
   						  <td>
                   <select class="form-control">
                     <option class="hidden"> Edit Shipping Rates</option>
                     <?php
                     $get_zones = "select * from zones order by zone_order";
                     $run_zones = mysqli_query($con, $get_zones);
                     while ($row_zones = mysqli_fetch_array($run_zones)) {
                       $zone_id = $row_zones['zone_id'];
                       $zone_name = $row_zones['zone_name'];
                       echo "
                       <option data-url='index.php?edit_shipping_rates=$type_id & zone_id=$zone_id'>
                       $zone_name
                       </option>";
                     }
                      ?>
                   </select>
                 </td>

                 <td><?php echo ucfirst($type_default); ?></td>

                 <td>
                   <div class="dropdown"><!-- Dropdown start-->
                     <button class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                       <span class="caret"></span>
                     </button>
                     <ul class="dropdown-menu dropdown-menu-right">
                       <li>
                         <a href="index.php?edit_shipping_type=<?php echo $type_id; ?>">
                            <i class="fa fa-pencil"></i> Edit
                         </a>
                       </li>

                       <li>
                         <a href="index.php?delete_shipping_type=<?php echo $type_id; ?>">
                            <i class="fa fa-trash-o"></i> Delete
                         </a>
                       </li>
                     </ul>
                   </div><!-- Dropdown end-->
                 </td>
   						</tr>

   						 <?php } ?>

   					</tbody>
   				</table> <!-- table table-bordered table-hover table-striped end-->

   		</div><!-- panel-body end-->

   	</div><!-- panel panel-default end-->

   </div><!-- col-lg-12 end-->

</div><!--2 row end-->

<script>
$(document).ready(function() {
  $(document).on("mouseenter", ".local-types tr td:first-child", function(){
    $(this).css("cursor", "move");
    $(".local-types tbody").sortable({
      helper: fixWidthHelper,
      placeholder: "placeholder-highlight",
      containment: ".local-types tbody",
      update: function(){
        var types_ids = new Array();
        $(".local-types tbody tr").each(function(){
          type_id = $(this).attr("id");
          types_ids.push(type_id);
        });
        $.ajax({
          url: "update_type_order.php",
          method: "POST",
          data: {types_ids: types_ids, type_local:"yes"}
        });
      }
    }).disableSelection();
    function fixWidthHelper(e, ui) {
    ui.children().each(function() {
        $(this).width($(this).width());
    });
    return ui;
  }
});
  $("select").change(function(){
    var option = $(this).find("option:selected");
    var url = option.data("url");
    window.open(url);
  });
});
</script>

<?php } ?>

<div class="col-md-3 col-xs-12 left-angle">
    <!-- required for floating -->
    <!-- Nav tabs -->
    <ul class="nav nav-tabs tabs-left">
        <li class="active btn btn-primary"><a href="#description" data-toggle="tab">
  <?php if ($status == "product"){
    echo "Detaje të Produktit";
  } else {
    echo "Detaje të Setit";
  } ?>

        </a></li>
        <li class="btn btn-primary"><a href="#features" data-toggle="tab">Karakteristika</a></li>
        <li class="btn btn-primary"><a href="#video" data-toggle="tab">Video</a></li>
    </ul>
</div>
<div class="col-md-9 col-xs-12 right-angle">
    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane active" id="description"><?php echo $pro_desc; ?></div>
        <div class="tab-pane" id="features"><?php echo $pro_features; ?></div>
        <div class="tab-pane" id="video"><?php echo $pro_video; ?></div>
    </div>
 </div>

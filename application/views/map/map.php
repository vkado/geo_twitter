<div id="map-info">
    <?php echo $map['js']; ?>
    <?php echo $map['html']; ?>
</div>

<div>
    <div class="form-group form-group-lg">
        <div class="col-md-4">
            <input type="text" class="form-control" id="myPlaceTextBox" value="<?php echo $place; ?>" placeholder="<?php echo $this->lang->line('search'); ?>">
        </div>
    </div>

    <div class="col-md-4">
        <?php echo anchor('', $this->lang->line('search'), array('class' => 'btn btn-primary btn-lg btn-block')); ?>
    </div>
    <div class="col-md-4">
        <?php echo anchor('history', $this->lang->line('history'), array('class' => 'btn btn-primary btn-lg btn-block')); ?>
    </div>
</div>

<script type="text/javascript">
    var myLatlng = new google.maps.LatLng(<?php echo $lat; ?>,<?php echo $long; ?>);
    google.maps.event.addDomListener(window, "resize", function() { map.setCenter(myLatlng); }); // Keeps the Pin Central when resizing the browser on responsive sites
</script>

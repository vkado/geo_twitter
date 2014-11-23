<?php echo anchor('', '<< '.$this->lang->line('back_to_map'), array('class' => 'btn btn-primary btn-lg btn-block')); ?>
<?php
    foreach($history as $h){
        $dt =date('Y-m-d H:i:sP', strtotime($h['date_modified']));  // convert UNIX timestamp to PHP DateTime
    ?>
        <a href="javascript:void(0)" class="btn btn-default btn-lg btn-block" onclick="
            javascript:post('<?php echo site_url(); ?>',
            { lat: '<?php echo $h['lat']; ?>', long: '<?php echo $h['long']; ?>', place: '<?php echo $h['place']; ?>' });" >
            <?php echo $h['place']; ?>
            <time class="timeago" datetime="<?php echo $dt; ?>"></time>
        </a>
    <?php
    }
?>
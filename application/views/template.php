<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type='image/x-icon' href="<?php echo base_url();?>image/favicon.ico">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>

    <title><?php echo $title; ?></title>
    <base href="<?php echo base_url(); ?>" />
    <?php if (isset($description)) { ?>
        <meta name="description" content="<?php echo $description; ?>" />
    <?php } ?>
    <?php if (isset($keywords)) { ?>
        <meta name="keywords" content="<?php echo $keywords; ?>" />
    <?php } ?>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/styles.css" />

    <script type="text/javascript">
        var baseUrlPath = "<?php echo base_url();?><?php echo (index_page() == '')? '' : index_page()."/" ?>";
    </script>

</head>
<body>

<?php
$this->load->view($main);
?>

<footer>

</footer><!-- /footer -->

<script src="assets/js/script.min.js"></script>
</body>
</html>
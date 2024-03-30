<!DOCTYPE html>
<html>
<head>
    <meta charset="<?php echo datalist_db_encoding; ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo ucwords('BLOG ADMIN'); ?> | <?php echo (isset($x->TableTitle) ? $x->TableTitle : ''); ?></title>
    <link id="browser_favicon" rel="shortcut icon" href="<?php echo PREPEND_PATH; ?>resources/images/appgini-icon.png" alt="AppGini icon">

    <link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>resources/initializr/css/yeti.css" media="all">
    <link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>resources/select2/select2.css" media="all">
    <link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>resources/timepicker/bootstrap-timepicker.min.css" media="all">
    <link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>resources/datepicker/css/datepicker.css" media="all">
    <link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>dynamic.css.php" media="all">

    <style>
        /* Add any custom reset styles here */
    </style>

    <script src="<?php echo PREPEND_PATH; ?>resources/jquery/js/jquery-1.12.4.min.js"></script>
    <script>var $j = jQuery.noConflict();</script>
    <script src="<?php echo PREPEND_PATH; ?>resources/jquery/js/jquery.mark.min.js"></script>
    <script src="<?php echo PREPEND_PATH; ?>resources/initializr/js/vendor/bootstrap.min.js"></script>
    <script src="<?php echo PREPEND_PATH; ?>resources/lightbox/js/prototype.js"></script>
    <script src="<?php echo PREPEND_PATH; ?>resources/lightbox/js/scriptaculous.js?load=effects"></script>
    <script src="<?php echo PREPEND_PATH; ?>resources/select2/select2.min.js"></script>
    <script src="<?php echo PREPEND_PATH; ?>resources/timepicker/bootstrap-timepicker.min.js"></script>
    <script src="<?php echo PREPEND_PATH; ?>resources/jscookie/js.cookie.js"></script>
    <script src="<?php echo PREPEND_PATH; ?>resources/datepicker/js/datepicker.packed.js"></script>
    <script src="<?php echo PREPEND_PATH; ?>common.js.php"></script>
    <?php if(isset($x->TableName) && is_file(dirname(__FILE__) . "/hooks/{$x->TableName}-tv.js")){ ?>
        <script src="<?php echo PREPEND_PATH; ?>hooks/<?php echo $x->TableName; ?>-tv.js"></script>
    <?php } ?>

    <!-- Combined script tag for better performance -->
    <script async src="<?php echo PREPEND_PATH; ?>resources/initializr/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <script async src="<?php echo PREPEND_PATH; ?>resources/lightbox/js/lightbox.js"></script>
</head>
<body>
    <div class="container theme-yeti theme-compact">
        <?php if(function_exists('handle_maintenance')) echo handle_maintenance(true); ?>

        <?php if(!$_REQUEST['Embedded']){ ?>
            <?php if(function_exists('htmlUserBar')) echo htmlUserBar(); ?>
            <div style="height: 70px;" class="hidden-print"></div>
        <?php } ?>

        <?php if(class_exists('Notification')) echo Notification::placeholder(); ?>

        <!-- process notifications -->
        <?php $notification_margin = ($_REQUEST['Embedded'] ? '15px 0px' : '-15px 0 -45px'); ?>
        <div style="height: 60px; margin: <?php echo $notification_margin; ?>;">
            <?php if(function_exists('showNotifications')) echo showNotifications(); ?>
        </div>

        <?php if(!defined('APPGINI_SETUP') && is_file(dirname(__FILE__) . '/hooks/header-extras.php')){ include(dirname(__FILE__).'/hooks/header-extras.php'); } ?>
        <!-- Add header template below here .. -->
    </div>
</body>
</html>

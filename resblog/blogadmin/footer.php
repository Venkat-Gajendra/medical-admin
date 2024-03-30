<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Add any necessary CSS files here -->
</head>
<body>
    <div class="container">
        <!-- Add your content here -->

        <!-- Clearfix div moved inside the container for better layout -->
        <div class="clearfix"></div>

        <?php
        // Footer code moved to a separate function for better readability
        function displayFooter() {
            if (!isset($_REQUEST['Embedded'])) {
                echo '<div style="height: 70px;" class="hidden-print"></div>';
            }
        }

        // Call the function to display the footer
        displayFooter();
        ?>
    </div> <!-- /div class="container" -->

    <?php
    // Include any necessary footer extras
    if (!defined('APPGINI_SETUP') && is_file(dirname(__FILE__) . '/hooks/footer-extras.php')) {
        include(dirname(__FILE__).'/hooks/footer-extras.php');
    }
    ?>

    <!-- Add any necessary JavaScript files here -->
    <script src="<?php echo PREPEND_PATH; ?>resources/lightbox/js/lightbox.min.js"></script>
</body>
</html>

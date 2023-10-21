<?php
// Note: When creating woocommerce.php in your theme’s folder, you will not be able to override the woocommerce/archive-product.php 
// custom template as woocommerce.php has priority over archive-product.php. 
// This is intended to prevent display issues.



This 'woocommerce.php' file will load :
        1. Shop page,
        2. product search page,
        3. product category page,
        4. single product’s page.

<!-- this line of code will load all the woocommerce contents for those pages  -->
<?php woocommerce_content(); ?>

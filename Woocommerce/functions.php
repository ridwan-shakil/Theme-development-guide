<?php

// ==========================
// Give woocommerce support ***
// ==========================
function  organi_setup_theme()
{

    add_theme_support('woocommerce');   // we must give woo support
	or
    add_theme_support( 'woocommerce', array(
	'thumbnail_image_width' => 150,
	'single_image_width'    => 300,
	        'product_grid'          => array(
	            'default_rows'    => 3,
	            'min_rows'        => 2,
	            'max_rows'        => 8,
	            'default_columns' => 4,
	            'min_columns'     => 2,
	            'max_columns'     => 5,
	        ),
	) );
	
    add_theme_support( 'wc-product-gallery-zoom' );   // Image Zoom/Magnification

    add_theme_support( 'wc-product-gallery-slider' );  //Image Slider

    add_theme_support( 'wc-product-gallery-lightbox' );  // Lightbox

}
add_action('after_setup_theme', 'organi_setup_theme');



/**
 * Change my account menu item for logged-out users
 */
function bbloomer_dynamic_menu_item_label($items, $args) {
    if (!is_user_logged_in()) {
        $items = str_replace("My account", "Login", $items);
    }

    return $items;
}
add_filter('wp_nav_menu_items', 'bbloomer_dynamic_menu_item_label', 9999, 2);






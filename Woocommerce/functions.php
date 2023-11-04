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







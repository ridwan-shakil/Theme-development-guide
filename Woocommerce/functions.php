<?php
//At first we have to give woocommerce support to our theme 
   add_theme_support('woocommerce');


// ==========================
// Shop/archive page
// ==========================
/**
 * Change the number of products per row to 3
 */
if (!function_exists('loop_columns')) {
    function loop_columns() {
        return 3; // 3 products per row
	}
}
add_filter('loop_shop_columns', 'loop_columns', 999);

// ==========================
// product
// ==========================
/**
 * The function "woocommerce_custom_badge" is used to display a badge indicating the amount * saved on a product's sale price compared to its regular price in a WooCommerce store.
 * 
 * @return string the HTML output for a custom badge in WooCommerce.
 */
function woocommerce_custom_badge( $output_html, $post, $product ) {

    // Added compatibility with WC +3
    $regular_price = method_exists( $product, 'get_regular_price' ) ? $product->get_regular_price() : $product->regular_price;
    $sale_price = method_exists( $product, 'get_sale_price' ) ? $product->get_sale_price() : $product->sale_price;

    $saved_price = wc_price( $regular_price - $sale_price );
    $output_html = '<span class="onsale">' . esc_html__( 'Save', 'woocommerce' ) . ' ' . $saved_price . '</span>';

    return $output_html;
}
add_filter( 'woocommerce_sale_flash', 'woocommerce_custom_badge', 10, 3 );



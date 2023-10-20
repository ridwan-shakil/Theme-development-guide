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



/**
 * this function adds sales flash percentage discounts to products 
 */

function display_percentage_on_sale_badge( $html, $post, $product ) {

  if( $product->is_type('variable')){
      $percentages = array();

      // This will get all the variation prices and loop throughout them
      $prices = $product->get_variation_prices();

      foreach( $prices['price'] as $key => $price ){
          // Only on sale variations
          if( $prices['regular_price'][$key] !== $price ){
              // Calculate and set in the array the percentage for each variation on sale
              $percentages[] = round( 100 - ( floatval($prices['sale_price'][$key]) / floatval($prices['regular_price'][$key]) * 100 ) );
          }
      }
      // Displays maximum discount value
      $percentage = max($percentages) . '%';

  } elseif( $product->is_type('grouped') ){
      $percentages = array();

       // This will get all the variation prices and loop throughout them
      $children_ids = $product->get_children();

      foreach( $children_ids as $child_id ){
          $child_product = wc_get_product($child_id);

          $regular_price = (float) $child_product->get_regular_price();
          $sale_price    = (float) $child_product->get_sale_price();

          if ( $sale_price != 0 || ! empty($sale_price) ) {
              // Calculate and set in the array the percentage for each child on sale
              $percentages[] = round(100 - ($sale_price / $regular_price * 100));
          }
      }
     // Displays maximum discount value
      $percentage = max($percentages) . '%';

  } else {
      $regular_price = (float) $product->get_regular_price();
      $sale_price    = (float) $product->get_sale_price();

      if ( $sale_price != 0 || ! empty($sale_price) ) {
          $percentage    = round(100 - ($sale_price / $regular_price * 100)) . '%';
      } else {
          return $html;
      }
  }
  return '<span class="product__discount__percent">' . esc_html__( '-', 'woocommerce' ) . $percentage . '</span>'; // If needed then change or remove "up to -" text
}
add_filter( 'woocommerce_sale_flash', 'display_percentage_on_sale_badge', 20, 3 );



<?php
// IT IS SHOP PAGE
Make sure to add body_class(); in body tag in hader.php file;


// ==========================
// Shop page
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

/**
 * remove any product from the shop page 
 */
function organi_remove_some_product($wq) {
    $wq->set('post__not_in', array(35));
    return $wq;
}
add_filter( 'woocommerce_product_query','organi_remove_some_product' );

/**
* Remove any product category from the shop page 
*/
function organi_remove_some_category($wq) {
    $tax_query = (array) $wq->get('tax_query');
    $tax_query[] = array(
        'taxonomy' => 'product_cat',
        'field'=> 'slug',
        'terms'=> array('Tshirts'),
        'operator'=> 'NOT IN',
    );
    $wq->set('tax_query', $tax_query);
    return $wq;
}
add_filter( 'woocommerce_product_query','organi_remove_some_category' );


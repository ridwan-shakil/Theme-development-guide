<?php
//=====================
// show any products 
//=====================
there are many shortcodes available in woocommerce documentation: https://woocommerce.com/document/woocommerce-shortcodes/

	example:  ( add any query inside the shortcode to get your desired products, queries are available above link )	
          echo do_shortcode( '[products on_sale="true" ]' );


// =================================
Gets all product terms ( category )
// =================================



$cat_args = array(
	'orderby'    => 'name',
	'order'      => 'ase',
	'hide_empty' => true,
);

$product_categories = get_terms('product_cat', $cat_args);

if (!empty($product_categories)) {

	foreach ($product_categories as $key => $category) {

		echo '<a href="' . get_term_link($category) . '" >';
		echo $category->name.', ';
		echo '</a>';
	}
}





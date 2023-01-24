<?php
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

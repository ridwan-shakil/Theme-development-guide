<?php 
// ( cart, checkout, account ) pages use your themes page.php file,  template can be created
    //for those pages if you don't want to use the page.php file for any page
// ( Shop , single product , taxonomy pages = categories, tags )  pages use WordPress own templates 


// Documentation : https://woocommerce.com/document/woocommerce-theme-developer-handbook/

## 3 main ways of woocommerce development :
	1. Overriding woocommerce templates in your theme
	2. Using hooks = remove default action and add your action
	3. creating woocommerce.php file 

// 1. Overriding woocommerce templates in your theme :
	* Warning: Do not delete WooCommerce hooks when overriding a template. This would prevent plugins hooking in to add content.
	* Overriding the default template requires MAINTENANCE 
	
// 2. Using hooks = remove default action and add your action :
	* It is recommended way because it usually does not require maintenance 
 	

// 3. creating woocommerce.php file
	*  woocommerce.php has priority over archive-product.php
	*  you will not be able to override the archive-product.php template 

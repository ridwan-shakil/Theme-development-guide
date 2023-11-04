<?php
// =================
// chekout page 
// =================

// remmove checkout fields 
function sshop_remove_checkout_fields($fields) {

    unset($fields['billing']['billing_company']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['shipping']['shipping_company']);
    unset($fields['shipping']['shipping_address_2']);

    return $fields;
}
add_filter('woocommerce_checkout_fields', 'sshop_remove_checkout_fields');


// hide additional order note 
add_filter('woocommerce_enable_order_notes_field', function () {
    return false;
});

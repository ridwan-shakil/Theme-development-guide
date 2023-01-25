// ==============================================
// Add + - before add to cart button on single product page 
// ==============================================

add_action('woocommerce_after_add_to_cart_quantity', 'ts_quantity_plus_sign');

function ts_quantity_plus_sign()
{
    echo '<button type="button" class="plus" >+</button>';
}

add_action('woocommerce_before_add_to_cart_quantity', 'ts_quantity_minus_sign');

function ts_quantity_minus_sign()
{
    echo '<button type="button" class="minus" >-</button>';
}

add_action('wp_footer', 'ts_quantity_plus_minus');

function ts_quantity_plus_minus()
{
    // To run this on the single product page
    if (!is_product()) return;
?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {

            $('form.cart').on('click', 'button.plus, button.minus', function() {

                // Get current quantity values
                var qty = $(this).closest('form.cart').find('.qty');
                var val = parseFloat(qty.val());
                var max = parseFloat(qty.attr('max'));
                var min = parseFloat(qty.attr('min'));
                var step = parseFloat(qty.attr('step'));

                // Change the value if plus or minus
                if ($(this).is('.plus')) {
                    if (max && (max <= val)) {
                        qty.val(max);
                    } else {
                        qty.val(val + step);
                    }
                } else {
                    if (min && (min >= val)) {
                        qty.val(min);
                    } else if (val > 1) {
                        qty.val(val - step);
                    }
                }

            });

        });
    </script>
<?php
}

// ------------------ css of add to cart button part --------------------
/* hide input arrow key  */
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}


.single-product div.product form.cart .quantity {
    float: none;
    margin: 0;
    display: inline-block;
    }
form.cart {
    display: flex;
}

.minus,.plus,.quantity {
    border: none;
    /* background-color: #f5f5f5; */
    padding: 5px 5px;
    background: #f5f5f5;
}


button.plus, button.minus  {
    padding: 16px 15px;
    background: #f5f5f5 !important;
    color: #6f6f6f;
    border: 0px;
}

input.input-text {
    padding: 10px 5px;
    background: #f5f5f5 !important;
    color: #6f6f6f;
    border: 0px;
}

button.single_add_to_cart_button.button.alt.wp-element-button {
    padding: 16px 35px;
    margin-left: 6px;
    margin-bottom: 5px;
    background: green;
    display: inline-block;
    font-size: 14px;
    padding: 10px 28px 10px;
    color: #ffffff;
    text-transform: uppercase;
    font-weight: 700;
    background: #7fad39;
    letter-spacing: 2px;
}

// ========================================

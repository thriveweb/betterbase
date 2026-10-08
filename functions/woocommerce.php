<?php

/*-----------------------------------------------------------------------
    WooCommerce theme support
-----------------------------------------------------------------------*/

add_theme_support('woocommerce');

add_filter('woocommerce_enqueue_styles', '__return_empty_array');

remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

add_filter('loop_shop_columns', function () {
    return 3;
});

/* Disable Brands taxonomy (most BetterBase shops won't use it) */
add_action('init', function () {
    if (get_option('wc_feature_woocommerce_brands_enabled') !== 'no') {
        update_option('wc_feature_woocommerce_brands_enabled', 'no');
    }
});

/*-----------------------------------------------------------------------
    Admin: product editor tweaks
-----------------------------------------------------------------------*/

function betterbase_backend_product_page_css() { ?>
    <style type="text/css">
        body.post-type-product .woocommerce_options_panel .downloadable_files table,
        body.post-type-product .woocommerce_variations .downloadable_files table {
            width: 50%;
        }
    </style>
<?php }
add_action('admin_head', 'betterbase_backend_product_page_css');

/* Hide product short description from backend */
function betterbase_force_hide_product_short_description($hidden, $screen) {
    if ($screen->post_type === 'product') {
        if (!in_array('postexcerpt', $hidden, true)) {
            $hidden[] = 'postexcerpt';
        }
    }
    return $hidden;
}
add_filter('hidden_meta_boxes', 'betterbase_force_hide_product_short_description', 10, 2);

/*-----------------------------------------------------------------------
    AJAX: cart fragments for header
-----------------------------------------------------------------------*/

function betterbase_cart_count_fragment($fragments) {
    $count = (WC()->cart) ? WC()->cart->get_cart_contents_count() : 0;
    $fragments['span.cart-count'] = '<span class="cart-count">' . esc_html($count) . '</span>';
    return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'betterbase_cart_count_fragment');

/*-----------------------------------------------------------------------
    Shortcode wrappers (cart / checkout / account)
-----------------------------------------------------------------------*/

function betterbase_woocommerce_shortcode_wrapper($output, $tag, $attr) {
    $targets = array(
        'woocommerce_cart'       => 'is-cart',
        'woocommerce_checkout'   => 'is-checkout',
        'woocommerce_my_account' => 'is-account',
    );

    if (!isset($targets[$tag])) {
        return $output;
    }

    $classes = array('block-woocommerce', $targets[$tag]);

    if ($tag === 'woocommerce_my_account' && !is_user_logged_in()) {
        $classes[] = 'is-logged-out';
    }

    return
        '<div class="' . esc_attr(implode(' ', $classes)) . '">' .
            '<div class="block-setting-padding" style="--block-padding-top: 80px; --block-padding-bottom: 80px;">' .
                '<div class="container-lg">' .
                    //'<div class="wysiwyg-content">' .
                        $output .
                    //'</div>' .
                '</div>' .
            '</div>' .
        '</div>';
}
add_filter('do_shortcode_tag', 'betterbase_woocommerce_shortcode_wrapper', 10, 3);

/*-----------------------------------------------------------------------
    Archive loops
-----------------------------------------------------------------------*/

function betterbase_product_loop_start($html) {
    return str_replace('products columns-', 'products listing-products grid-col-', $html);
}
add_filter('woocommerce_product_loop_start', 'betterbase_product_loop_start');

/*-----------------------------------------------------------------------
    Quantity +/- controls
-----------------------------------------------------------------------*/

function betterbase_quantity_decrement() {
    echo '<span class="decrement">-</span>';
}
add_action('woocommerce_before_quantity_input_field', 'betterbase_quantity_decrement');

function betterbase_quantity_increment() {
    echo '<span class="increment">+</span>';
}
add_action('woocommerce_after_quantity_input_field', 'betterbase_quantity_increment');

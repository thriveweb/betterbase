<?php
/**
 * Single product
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package BetterBase
 * @version 1.6.4
 */

defined('ABSPATH') || exit;

get_header();

while (have_posts()):
    the_post();
    wc_get_template_part('content', 'single-product');
endwhile;

get_footer();

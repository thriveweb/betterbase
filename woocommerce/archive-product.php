<?php
/**
 * Product archives (shop + product taxonomies)
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package BetterBase
 * @version 8.6.0
 */

defined('ABSPATH') || exit;

get_header();

wc_set_loop_prop('columns', 3);
?>

<div class="betterbase-theme block-product-listing">
    <div class="block-setting-padding" style="--block-padding-top: 40px; --block-padding-bottom: 80px;">
        <?php if (woocommerce_product_loop()): ?>
            <div class="inner-block-head">
                <div class="container-lg">
                    <div class="woocommerce-shop-header">
                        <?php woocommerce_result_count(); ?>
                        <?php woocommerce_catalog_ordering(); ?>
                    </div>
                </div>
            </div>
            <div class="inner-block-main">
                <div class="container-lg">
                    <?php woocommerce_output_all_notices(); ?>

                    <?php woocommerce_product_loop_start(); ?>
                        <?php if (wc_get_loop_prop('total')): ?>
                            <?php while (have_posts()): the_post(); ?>
                                <?php $product_ID = get_the_ID();
                                include(get_template_directory().'/parts/entry-product.php'); ?>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    <?php woocommerce_product_loop_end(); ?>

                    <?php woocommerce_pagination(); ?>
                </div>
            </div>
        <?php else: ?>
            <div class="inner-block-main">
                <div class="container-lg">
                    <?php woocommerce_output_all_notices(); ?>
                    <?php do_action('woocommerce_no_products_found'); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
get_footer();

<?php
/**
 * Single product content — custom layout (no default Woo chrome)
 *
 * @package BetterBase
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

if (!$product instanceof WC_Product) {
    return;
}

$image_ids = $product->get_gallery_image_ids();
$featured_id = $product->get_image_id();

if ($featured_id) {
    array_unshift($image_ids, $featured_id);
}

$image_ids = array_values(array_unique(array_filter($image_ids)));
$has_thumbs = count($image_ids) > 1;

$description = $product->get_short_description();
if ($description === '') {
    $description = $product->get_description();
}
?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class('betterbase-theme block-single-product-detail', $product); ?>>
    <div class="block-setting-padding" style="--block-padding-top: 40px; --block-padding-bottom: 80px;">
        <div class="container-lg">
            <?php woocommerce_output_all_notices(); ?>

            <div class="inner-block-wrap flex-layout">
                <div class="product-gallery<?php echo $has_thumbs ? ' has-thumbs' : ''; ?>">
                    <div class="carousel-product-gallery swiper">
                        <div class="swiper-wrapper">
                            <?php if (!empty($image_ids)): ?>
                                <?php foreach ($image_ids as $image_id): ?>
                                    <div class="swiper-slide">
                                        <div class="image-square">
                                            <?php echo wp_get_attachment_image($image_id, 'large'); ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="swiper-slide">
                                    <div class="image-square">
                                        <?php echo wc_placeholder_img('large'); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php if ($has_thumbs): ?>
                        <div class="carousel-product-gallery-thumbs swiper">
                            <div class="swiper-wrapper">
                                <?php foreach ($image_ids as $image_id): ?>
                                    <div class="swiper-slide">
                                        <div class="image-square">
                                            <?php echo wp_get_attachment_image($image_id, 'thumbnail'); ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="product-summary">
                    <?php
                    $show_sale = $product->is_on_sale();
                    $show_stock = !$product->is_in_stock() || ($product->managing_stock() && $product->is_on_backorder(1));
                    ?>
                    <?php if ($show_sale || $show_stock): ?>
                        <div class="group-tags">
                            <?php if ($show_sale): ?>
                                <?php echo apply_filters('woocommerce_sale_flash', '<span class="onsale">' . esc_html__('Sale', 'woocommerce') . '</span>', get_post(), $product); ?>
                            <?php endif; ?>

                            <?php if (!$product->is_in_stock()): ?>
                                <span class="stock out-of-stock"><?php esc_html_e('Out of stock', 'woocommerce'); ?></span>
                            <?php elseif ($product->managing_stock() && $product->is_on_backorder(1)): ?>
                                <span class="stock available-on-backorder"><?php esc_html_e('Available on backorder', 'woocommerce'); ?></span>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <h1 class="product_title entry-title"><?php the_title(); ?></h1>

                    <div class="price">
                        <?php echo $product->get_price_html(); ?>
                    </div>

                    <?php if ($description !== ''): ?>
                        <div class="wysiwyg-content product-description">
                            <?php echo wp_kses_post($description); ?>
                        </div>
                    <?php endif; ?>

                    <?php woocommerce_template_single_add_to_cart(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

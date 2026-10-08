<?php
if (empty($product_ID)) {
    return;
}

$product = wc_get_product($product_ID);
if (!$product) {
    return;
}

$product_permalink = get_the_permalink($product_ID);
$product_title = get_the_title($product_ID);
$product_image = get_the_post_thumbnail_url($product_ID, 'large');
$product_categories = get_the_terms($product_ID, 'product_cat');
?>

<a class="entry-product" href="<?php echo esc_url($product_permalink); ?>" title="<?php echo esc_attr($product_title); ?>">
    <div class="inner-entry-image image-square">
        <?php if (!empty($product_image)): ?>
            <img src="<?php echo esc_url($product_image); ?>" alt="<?php echo esc_attr($product_title); ?>">
        <?php endif; ?>
    </div>
    <div class="inner-entry-content">
        <?php if (!empty($product_categories) && !is_wp_error($product_categories)): ?>
            <div class="group-tags">
                <span><?php echo esc_html($product_categories[0]->name); ?></span>
            </div>
        <?php endif; ?>
        <h4 class="h3"><?php echo esc_html($product_title); ?></h4>
        <div class="price">
            <?php echo $product->get_price_html(); ?>
        </div>
    </div>
</a>

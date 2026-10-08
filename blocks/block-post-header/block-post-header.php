<?php
if (betterbase_block_preview($block)) {
    return;
}
extract(betterbase_block_settings($block));

$post_ID = get_the_ID();
$post_title = get_the_title($post_ID);
$post_categories = get_the_category($post_ID);
$post_date = get_the_date('d F Y', $post_ID);
$post_image = get_the_post_thumbnail_url($post_ID, 'large');
?>
<div class="<?php echo esc_attr(implode(' ', array_filter($block_classes))); ?>" <?php echo ($block_anchor ? 'id="'.esc_attr($block_anchor).'"' : ''); ?> <?php echo ($block_css ? 'style="'.esc_attr($block_css).'"' : ''); ?>>
    <div class="<?php echo esc_attr(implode(' ', $setting_classes)); ?>" style="<?php echo esc_attr(implode('; ', $setting_styles)); ?>">
        <div class="container-<?php echo esc_attr($container); ?>">
            <div class="wysiwyg-content text-align-center <?php echo esc_attr(betterbase_get_text_color($background_color)); ?>">
                <?php if (!empty($post_categories)): ?>
                    <div class="group-tags">
                        <?php foreach ($post_categories as $term): ?>
                            <span><?php echo esc_html($term->name); ?></span>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <h1 class="h2"><?php echo esc_html($post_title ?: 'Add blog title here...'); ?></h1>
                <?php if (!empty($post_date)): ?>
                    <p><?php echo esc_html($post_date); ?></p>
                <?php endif; ?>
            </div>
            <?php if (!empty($post_image)): ?>
                <img class="image-landscape" src="<?php echo esc_url($post_image); ?>" alt="<?php echo esc_attr($post_title); ?>">
            <?php endif; ?>
        </div>
    </div>
</div>

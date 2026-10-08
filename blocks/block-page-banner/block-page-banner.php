<?php
if (betterbase_block_preview($block)) {
    return;
}
extract(betterbase_block_settings($block));

$page_ID = get_the_ID();
$title = get_field('title') ?: get_the_title($page_ID);
$image = get_field('image');
$image_url = !empty($image)
    ? ($image['sizes']['2048x2048'] ?? $image['sizes']['1536x1536'] ?? $image['sizes']['large'] ?? ($image['url'] ?? ''))
    : get_the_post_thumbnail_url($page_ID, '2048x2048');

if (!empty($title)): ?>
    <div class="<?php echo esc_attr(implode(' ', array_filter($block_classes))); ?>" <?php echo ($block_anchor ? 'id="'.esc_attr($block_anchor).'"' : ''); ?> <?php echo ($block_css ? 'style="'.esc_attr($block_css).'"' : ''); ?>>
        <div class="<?php echo esc_attr(implode(' ', $setting_classes)); ?>" style="<?php echo esc_attr(implode('; ', $setting_styles)); ?>">
            <div class="container-<?php echo esc_attr($container); ?>">
                <div class="wysiwyg-content text-align-center text-color-white">
                    <h1><?php echo esc_html($title); ?></h1>
                </div>
            </div>
            <?php if (!empty($image_url)): ?>
                <div class="background-image has-overlay" style="background-image: url('<?php echo esc_url($image_url); ?>');"></div>
            <?php endif; ?>
        </div>
    </div>
<?php else: betterbase_block_empty(); endif; ?>

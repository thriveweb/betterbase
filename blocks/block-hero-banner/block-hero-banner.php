<?php
if (betterbase_block_preview($block)) {
    return;
}
extract(betterbase_block_settings($block));

$title = get_field('title');
$excerpt = get_field('excerpt');
$add_button = get_field('add_button');
$button_alignment = get_field('button_alignment') ?: 'center';
$background_type = get_field('background_type');
$image = get_field('image');
$video = get_field('video');
$thumbnail = get_field('video_thumbnail');

$image_url = !empty($image)
    ? ($image['sizes']['2048x2048'] ?? $image['sizes']['1536x1536'] ?? $image['sizes']['large'] ?? ($image['url'] ?? ''))
    : '';

$thumbnail_url = !empty($thumbnail)
    ? ($thumbnail['sizes']['2048x2048'] ?? $thumbnail['sizes']['1536x1536'] ?? $thumbnail['sizes']['large'] ?? ($thumbnail['url'] ?? ''))
    : '';

if (!empty($title)): ?>
    <div class="<?php echo esc_attr(implode(' ', array_filter($block_classes))); ?>" <?php echo ($block_anchor ? 'id="'.esc_attr($block_anchor).'"' : ''); ?> <?php echo ($block_css ? 'style="'.esc_attr($block_css).'"' : ''); ?>>
        <div class="<?php echo esc_attr(implode(' ', $setting_classes)); ?>" style="<?php echo esc_attr(implode('; ', $setting_styles)); ?>">
            <div class="container-<?php echo esc_attr($container); ?>">
                <div class="wysiwyg-content text-align-center text-color-white">
                    <h1><?php echo esc_html($title); ?></h1>
                    <?php if (!empty($excerpt)): ?>
                        <h5><?php echo esc_html($excerpt); ?></h5>
                    <?php endif; ?>
                    <?php include get_template_directory() . '/parts/group-button.php'; ?>
                </div>
            </div>
            <?php if ($background_type === 'image' && !empty($image_url)): ?>
                <div class="background-image has-overlay" style="background-image: url('<?php echo esc_url($image_url); ?>');"></div>
            <?php elseif ($background_type === 'video' && !empty($video) && !empty($thumbnail_url)): ?>
                <div class="background-video has-overlay">
                    <video src="<?php echo esc_url($video['url']); ?>" poster="<?php echo esc_url($thumbnail_url); ?>" autoplay muted loop playsinline></video>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php else: betterbase_block_empty(); endif; ?>

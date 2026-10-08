<?php
if (betterbase_block_preview($block)) {
    return;
}
extract(betterbase_block_settings($block));

$content = get_field('content');
$add_button = get_field('add_button');
$button_alignment = get_field('button_alignment');

if (!empty($content)): ?>
    <div class="<?php echo esc_attr(implode(' ', array_filter($block_classes))); ?>" <?php echo ($block_anchor ? 'id="'.esc_attr($block_anchor).'"' : ''); ?> <?php echo ($block_css ? 'style="'.esc_attr($block_css).'"' : ''); ?>>
        <div class="<?php echo esc_attr(implode(' ', $setting_classes)); ?>" style="<?php echo esc_attr(implode('; ', $setting_styles)); ?>">
            <div class="container-<?php echo esc_attr($container); ?>">
                <div class="wysiwyg-content <?php echo esc_attr(betterbase_get_text_color($background_color)); ?>">
                    <?php echo wp_kses_post($content); ?>
                    <?php include(get_template_directory().'/parts/group-button.php'); ?>
                </div>
            </div>
        </div>
    </div>
<?php else: betterbase_block_empty(); endif; ?>

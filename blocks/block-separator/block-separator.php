<?php
if (betterbase_block_preview($block)) {
    return;
}
extract(betterbase_block_settings($block));

$setting_classes = ['block-setting-padding'];
$setting_styles = [
    '--block-padding-top: ' . intval($padding_top) . 'px',
    '--block-padding-bottom: ' . intval($padding_bottom) . 'px',
];
?>
<div class="<?php echo esc_attr(implode(' ', array_filter($block_classes))); ?>" <?php echo ($block_anchor ? 'id="'.esc_attr($block_anchor).'"' : ''); ?> <?php echo ($block_css ? 'style="'.esc_attr($block_css).'"' : ''); ?>>
    <div class="<?php echo esc_attr(implode(' ', $setting_classes)); ?>" style="<?php echo esc_attr(implode('; ', $setting_styles)); ?>">
        <div class="container-<?php echo esc_attr($container); ?>">
            <div class="separator" style="--block-background-color: var(--<?php echo esc_attr($background_color); ?>);"></div>
        </div>
    </div>
</div>

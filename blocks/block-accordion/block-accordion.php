<?php
if (betterbase_block_preview($block)) {
    return;
}
extract(betterbase_block_settings($block));

$title = get_field('title');
$add_accordion = get_field('add_accordion');
$enable_schema = get_field('enable_schema');

if (!empty($add_accordion)): ?>
    <div class="<?php echo esc_attr(implode(' ', array_filter($block_classes))); ?>" <?php echo ($block_anchor ? 'id="'.esc_attr($block_anchor).'"' : ''); ?> <?php echo ($block_css ? 'style="'.esc_attr($block_css).'"' : ''); ?>>
        <div class="<?php echo esc_attr(implode(' ', $setting_classes)); ?>" style="<?php echo esc_attr(implode('; ', $setting_styles)); ?>">
            <?php if (!empty($title)): ?>
                <div class="inner-block-head">
                    <div class="container-sm">
                        <div class="wysiwyg-content text-align-center <?php echo esc_attr(betterbase_get_text_color($background_color)); ?>">
                            <h3 class="h2"><?php echo esc_html($title); ?></h3>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="inner-block-main">
                <div class="container-<?php echo esc_attr($container); ?> <?php echo esc_attr(betterbase_get_text_color($background_color)); ?>">
                    <?php include(get_template_directory().'/parts/listing-accordion.php'); ?>
                </div>
            </div>
        </div>
    </div>
<?php else: betterbase_block_empty(); endif; ?>

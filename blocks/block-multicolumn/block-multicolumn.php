<?php
if (betterbase_block_preview($block)) {
    return;
}
extract(betterbase_block_settings($block));

$column_count = $block['multicolumn_count'] ?? 2;
$column_alignment = $block['multicolumn_alignment'] ?? 'align-start';
$add_column = get_field('add_column');

if (!empty($add_column)): ?>
    <div class="<?php echo esc_attr(implode(' ', array_filter($block_classes))); ?>" <?php echo ($block_anchor ? 'id="'.esc_attr($block_anchor).'"' : ''); ?> <?php echo ($block_css ? 'style="'.esc_attr($block_css).'"' : ''); ?>>
        <div class="<?php echo esc_attr(implode(' ', $setting_classes)); ?>" style="<?php echo esc_attr(implode('; ', $setting_styles)); ?>">
            <div class="container-<?php echo esc_attr($container); ?>">
                <div class="grid-col-<?php echo esc_attr($column_count); ?> flex-<?php echo esc_attr($column_alignment); ?>">
                    <?php $i = 0; foreach ($add_column as $col): $i++; ?>
                        <div class="col-<?php echo esc_attr($i); ?>">
                            <div class="wysiwyg-content <?php echo esc_attr(betterbase_get_text_color($background_color)); ?>">
                                <?php echo wp_kses_post($col['content'] ?: ''); ?>
                                <?php
                                $add_button = $col['add_button'] ?? null;
                                $button_alignment = $col['button_alignment'] ?? '';
                                include(get_template_directory().'/parts/group-button.php'); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
<?php else: betterbase_block_empty(); endif; ?>

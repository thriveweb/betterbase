<?php if (isset($block['data']['preview_image']) && $block['data']['preview_image']): ?>
    <img src="<?php echo get_template_directory_uri(); ?>/blocks/preview/<?php echo $block['data']['preview_image']; ?>" style="width: 100%; height: auto; display: block;">
<?php else:
    $block_name = 'block-multicolumn';
    $block_classes = ['betterbase-theme', $block_name, $block['className'] ?? null];
    $block_anchor = $block['anchor'] ?? '';
    $block_css = $block['css'] ?? '';
    $padding_top = $block['settings_padding_top'] ?? '80';
    $padding_bottom = $block['settings_padding_bottom'] ?? '80';
    $background_colour = $block['settings_background_colour'] ?? 'none';
    $container = $block['settings_container'] ?? 'md';
    $setting_classes = ['block-setting-padding', 'block-setting-background-color'];
    $setting_styles = ['--block-padding-top: '.$padding_top.'px', '--block-padding-bottom: '.$padding_bottom.'px', '--block-background-color: var(--'.$background_colour.')'];

    $column_count = $block['multicolumn_count'] ?? '2';
    $column_style = $block['multicolumn_style'] ?? 'equal-width';
    $column_alignment = $block['multicolumn_alignment'] ?? 'align-top';

    $add_column = get_field('block_add_column');

    if (!empty($add_column)): ?>
        <div class="<?php echo implode(' ', array_filter($block_classes)); ?>" <?php echo ($block_anchor ? 'id="'.esc_attr($block_anchor).'"' : ''); ?> <?php echo ($block_css ? 'style="'.esc_attr($block_css).'"' : ''); ?>>
            <div class="<?php echo implode(' ', $setting_classes); ?>" style="<?php echo implode('; ', $setting_styles); ?>">
                <div class="container-<?php echo $container; ?>">
                    <div class="grid-col-<?php echo $column_count; ?> has-<?php echo $column_style; ?> flex-<?php echo $column_alignment; ?>">
                        <?php $i = 0; foreach ($add_column as $col): $i++; ?>
                            <div class="col-<?php echo $i; ?>">
                                <div class="wysiwyg-content <?php echo get_text_colour($background_colour); ?>">
                                    <?php echo ($col['column_content'] ? $col['column_content'] : ''); ?>
                                    <?php $add_button = $col['button_group']['add_button']; $button_alignment = $col['button_group']['button_alignment']; 
                                    include(get_template_directory().'/parts/group-button.php'); ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php else: get_empty_block_message(); endif; ?>
<?php endif; ?>
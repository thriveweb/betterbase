<?php if (isset($block['data']['preview_image']) && $block['data']['preview_image']): ?>
    <img src="<?php echo get_template_directory_uri(); ?>/blocks/preview/<?php echo $block['data']['preview_image']; ?>" style="width: 100%; height: auto; display: block;">
<?php else:
    $block_name = 'block-split-content';
    $block_classes = ['betterbase-theme', $block_name, $block['className'] ?? null];
    $block_anchor = $block['anchor'] ?? '';
    $block_css = $block['css'] ?? '';
    $padding_top = $block['settings_padding_top'] ?? '80';
    $padding_bottom = $block['settings_padding_bottom'] ?? '80';
    $background_color = $block['settings_background_color'] ?? 'none';
    $container = $block['settings_container'] ?? 'md';
    $setting_classes = ['block-setting-padding', 'block-setting-background-color'];
    $setting_styles = ['--block-padding-top: '.$padding_top.'px', '--block-padding-bottom: '.$padding_bottom.'px', '--block-background-color: var(--'.$background_color.')'];

    $left_column = get_field('block_left_column');
    $left_type = $left_column['column_type'];
    $left_content = $left_column['content'];
    $left_image = $left_column['image'];
    $left_button_alignment = $left_column['button_group']['button_alignment'];
    $left_add_button = $left_column['button_group']['add_button'];

    $right_column = get_field('block_right_column');
    $right_type = $right_column['column_type'];
    $right_content = $right_column['content'];
    $right_image = $right_column['image'];
    $right_button_alignment = $right_column['button_group']['button_alignment'];
    $right_add_button = $right_column['button_group']['add_button'];

    if (!empty($left_column) && !empty($right_column)): ?>
       <div class="<?php echo implode(' ', array_filter($block_classes)); ?>" <?php echo ($block_anchor ? 'id="'.esc_attr($block_anchor).'"' : ''); ?> <?php echo ($block_css ? 'style="'.esc_attr($block_css).'"' : ''); ?>>
            <div class="<?php echo implode(' ', $setting_classes); ?>" style="<?php echo implode('; ', $setting_styles); ?>">
                <div class="container-<?php echo $container; ?>">
                    <div class="grid-col-2 flex-align-center">
                        <div class="col-1 col-<?php echo $left_type; ?>">
                            <?php if ($left_type === 'content' && !empty($left_content)): ?>
                                <div class="wysiwyg-content <?php echo get_text_colour($background_color); ?>">
                                    <?php echo $left_content; ?>
                                    <?php $add_button = $left_add_button; $button_alignment = $left_button_alignment;
                                    include(get_template_directory().'/parts/group-button.php'); ?>
                                </div>
                            <?php elseif ($left_type === 'image' && !empty($left_image)): ?>
                                <img src="<?php echo esc_url($left_image['sizes']['large']); ?>" alt="<?php echo esc_attr($left_image['alt']); ?>">
                            <?php endif; ?>
                        </div>
                        <div class="col-2 col-<?php echo $right_type; ?>">
                            <?php if ($right_type === 'content' && !empty($right_content)): ?>
                                <div class="wysiwyg-content <?php echo get_text_colour($background_color); ?>">
                                    <?php echo $right_content; ?>
                                    <?php $add_button = $right_add_button; $button_alignment = $right_button_alignment;
                                    include(get_template_directory().'/parts/group-button.php'); ?>
                                </div>
                            <?php elseif ($right_type === 'image' && !empty($right_image)): ?>
                                <img src="<?php echo esc_url($right_image['sizes']['large']); ?>" alt="<?php echo esc_attr($right_image['alt']); ?>">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else: get_empty_block_message(); endif; ?>
<?php endif; ?>
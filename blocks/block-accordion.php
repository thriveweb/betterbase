<?php if (isset($block['data']['preview_image']) && $block['data']['preview_image']): ?>
    <img src="<?php echo get_template_directory_uri(); ?>/blocks/preview/<?php echo $block['data']['preview_image']; ?>" style="width: 100%; height: auto; display: block;">
<?php else:
    $block_name = 'block-accordion';
    $block_classes = ['betterbase-theme', $block_name, $block['className'] ?? null];
    $block_anchor = $block['anchor'] ?? '';
    $block_css = $block['css'] ?? '';
    $padding_top = $block['settings_padding_top'] ?? '80';
    $padding_bottom = $block['settings_padding_bottom'] ?? '80';
    $background_colour = $block['settings_background_colour'] ?? 'none';
    $container = $block['settings_container'] ?? 'md';
    $setting_classes = ['block-setting-padding', 'block-setting-background-color'];
    $setting_styles = ['--block-padding-top: '.$padding_top.'px', '--block-padding-bottom: '.$padding_bottom.'px', '--block-background-color: var(--'.$background_colour.')'];

    $title = get_field('block_title');
    $add_accordion = get_field('block_add_accordion');

    if (!empty($add_accordion)): ?>
        <div class="<?php echo implode(' ', array_filter($block_classes)); ?>" <?php echo ($block_anchor ? 'id="'.esc_attr($block_anchor).'"' : ''); ?> <?php echo ($block_css ? 'style="'.esc_attr($block_css).'"' : ''); ?>>
            <div class="<?php echo implode(' ', $setting_classes); ?>" style="<?php echo implode('; ', $setting_styles); ?>">
                <?php if (!empty($title)): ?>
                    <div class="container-sm">
                        <div class="inner-block-head">
                            <div class="wysiwyg-content text-center <?php echo get_text_colour($background_colour); ?>">
                                <h3><?php echo $title; ?></h3>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="container-<?php echo $container; ?> <?php echo get_text_colour($background_colour); ?>">
                    <?php include(get_template_directory().'/parts/group-accordion.php'); ?>
                </div>
            </div>
        </div>
    <?php else: get_empty_block_message(); endif; ?>
<?php endif; ?>
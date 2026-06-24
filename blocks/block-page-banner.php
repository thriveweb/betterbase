<?php if (isset($block['data']['preview_image']) && $block['data']['preview_image']): ?>
    <img src="<?php echo get_template_directory_uri(); ?>/blocks/preview/<?php echo $block['data']['preview_image']; ?>" style="width: 100%; height: auto; display: block;">
<?php else:
    $block_name = 'block-page-banner';
    $block_classes = ['betterbase-theme', $block_name, $block['className'] ?? null];
    $block_anchor = $block['anchor'] ?? '';
    $block_css = $block['css'] ?? '';
    $padding_top = $block['settings_padding_top'] ?? '120';
    $padding_bottom = $block['settings_padding_bottom'] ?? '120';
    $background_colour = $block['settings_background_colour'] ?? 'black';
    $container = $block['settings_container'] ?? 'lg';
    $setting_classes = ['block-setting-padding', 'block-setting-background-color'];
    $setting_styles = ['--block-padding-top: '.$padding_top.'px', '--block-padding-bottom: '.$padding_bottom.'px', '--block-background-color: var(--'.$background_colour.')'];

    $page_ID = get_the_ID();
    $page_title = get_the_title($page_ID);
    $page_image = get_the_post_thumbnail_url($page_ID, '2048x2048');

    $title = get_field('block_title');
    $image = get_field('block_image'); ?>

    <div class="<?php echo implode(' ', array_filter($block_classes)); ?>" <?php echo ($block_anchor ? 'id="'.esc_attr($block_anchor).'"' : ''); ?> <?php echo ($block_css ? 'style="'.esc_attr($block_css).'"' : ''); ?>>
        <div class="<?php echo implode(' ', $setting_classes); ?>" style="<?php echo implode('; ', $setting_styles); ?>">
            <div class="container-<?php echo $container; ?>">
                <div class="wysiwyg-content text-white">
                    <h1><?php echo ($title ?? $page_title); ?></h1>
                </div>
            </div>
            <?php if (!empty($image)): ?>
                <div class="background-image has-overlay" style="background-image: url(<?php echo esc_url($image['sizes']['2048x2048']); ?>);"></div>
            <?php elseif (!empty($page_image)): ?>
                <div class="background-image has-overlay" style="background-image: url(<?php echo esc_url($page_image); ?>);"></div>
            <?php endif; ?>
        </div>
    </div>

<?php endif; ?>
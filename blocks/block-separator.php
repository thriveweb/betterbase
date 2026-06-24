<?php if (isset($block['data']['preview_image']) && $block['data']['preview_image']): ?>
    <img src="<?php echo get_template_directory_uri(); ?>/blocks/preview/<?php echo $block['data']['preview_image']; ?>" style="width: 100%; height: auto; display: block;">
<?php else:
    $block_name = 'block-separator';
    $block_classes = ['betterbase-theme', $block_name, $block['className'] ?? null];
    $block_anchor = $block['anchor'] ?? '';
    $block_css = $block['css'] ?? '';
    $padding_top = $block['settings_padding_top'] ?? '80';
    $padding_bottom = $block['settings_padding_bottom'] ?? '80';
    $background_colour = $block['settings_background_colour'] ?? 'black';
    $container = $block['settings_container'] ?? 'xl';
    $setting_classes = ['block-setting-padding'];
    $setting_styles = ['--block-padding-top: '.$padding_top.'px', '--block-padding-bottom: '.$padding_bottom.'px']; ?>

    <div class="<?php echo implode(' ', array_filter($block_classes)); ?>" <?php echo ($block_anchor ? 'id="'.esc_attr($block_anchor).'"' : ''); ?> <?php echo ($block_css ? 'style="'.esc_attr($block_css).'"' : ''); ?>>
        <div class="<?php echo implode(' ', $setting_classes); ?>" style="<?php echo implode('; ', $setting_styles); ?>">
            <div class="container-<?php echo $container; ?>">
                <div class="separator" style="--block-background-color: var(--<?php echo $background_colour; ?>);"></div>
            </div>
        </div>
    </div>

<?php endif; ?>
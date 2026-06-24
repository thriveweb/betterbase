<?php if (isset($block['data']['preview_image']) && $block['data']['preview_image']): ?>
    <img src="<?php echo get_template_directory_uri(); ?>/blocks/preview/<?php echo $block['data']['preview_image']; ?>" style="width: 100%; height: auto; display: block;">
<?php else:
    $block_name = 'block-instagrm';
    $block_classes = ['betterbase-theme', $block_name, $block['className'] ?? null];
    $block_anchor = $block['anchor'] ?? '';
    $block_css = $block['css'] ?? '';
    $padding_top = $block['settings_padding_top'] ?? '80';
    $padding_bottom = $block['settings_padding_bottom'] ?? '80';
    $background_color = $block['settings_background_color'] ?? 'none';
    $container = $block['settings_container'] ?? 'xl';
    $setting_classes = ['block-setting-padding', 'block-setting-background-color'];
    $setting_styles = ['--block-padding-top: '.$padding_top.'px', '--block-padding-bottom: '.$padding_bottom.'px', '--block-background-color: var(--'.$background_color.')'];

    $add_social_media = get_field('add_social_media', 'options');
    $instagram = get_instagram($add_social_media); ?>

    <div class="<?php echo implode(' ', array_filter($block_classes)); ?>" <?php echo ($block_anchor ? 'id="'.esc_attr($block_anchor).'"' : ''); ?> <?php echo ($block_css ? 'style="'.esc_attr($block_css).'"' : ''); ?>>
        <div class="<?php echo implode(' ', $setting_classes); ?>" style="<?php echo implode('; ', $setting_styles); ?>">
            <div class="container-sm">
                <div class="inner-block-head">
                    <div class="wysiwyg-content text-center <?php echo get_text_colour($background_color); ?>">
                        <h4>
                            Follow us 
                            <?php if (!empty($instagram['url']) && !empty($instagram['username'])): ?>
                                <a href="<?php echo $instagram['url']; ?>" target="_blank" title="Follow us on Instagram">@<?php echo $instagram['username']; ?></a>
                            <?php endif; ?>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="container-<?php echo $container; ?>">
                <p class="text-center <?php echo get_text_colour($background_color); ?>">[instagram-feed]</p> <?php /* Replace with shortcode */ ?>
            </div>
        </div>
    </div>

<?php endif; ?>
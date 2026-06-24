<?php if (isset($block['data']['preview_image']) && $block['data']['preview_image']): ?>
    <img src="<?php echo get_template_directory_uri(); ?>/blocks/preview/<?php echo $block['data']['preview_image']; ?>" style="width: 100%; height: auto; display: block;">
<?php else:
    $block_name = 'block-post-footer';
    $block_classes = ['betterbase-theme', $block_name, $block['className'] ?? null];
    $block_anchor = $block['anchor'] ?? '';
    $block_css = $block['css'] ?? '';
    $padding_top = $block['settings_padding_top'] ?? '40';
    $padding_bottom = $block['settings_padding_bottom'] ?? '40';
    $background_color = $block['settings_background_color'] ?? 'none';
    $container = $block['settings_container'] ?? 'md';
    $setting_classes = ['block-setting-padding', 'block-setting-background-color'];
    $setting_styles = ['--block-padding-top: '.$padding_top.'px', '--block-padding-bottom: '.$padding_bottom.'px', '--block-background-color: var(--'.$background_color.')'];
    
    $post_ID = get_the_ID();
    $post_prev = get_next_post();
    $post_next = get_previous_post();
    
    $add_social_media = get_field('add_social_media', 'options'); ?>

    <div class="<?php echo implode(' ', array_filter($block_classes)); ?>" <?php echo ($block_anchor ? 'id="'.esc_attr($block_anchor).'"' : ''); ?> <?php echo ($block_css ? 'style="'.esc_attr($block_css).'"' : ''); ?>>
        <div class="<?php echo implode(' ', $setting_classes); ?>" style="<?php echo implode('; ', $setting_styles); ?>">
            <div class="container-<?php echo $container; ?> <?php echo get_text_colour($background_color); ?>">
                <div class="post-pagination flex-layout flex-align-center flex-justify-between flex-gap">
                    <div class="prev-post">
                        <?php if (!empty($post_prev)): ?>
                            <a href="<?php echo get_permalink($post_prev->ID); ?>" title="Previous post">
                                <?php include_asset('icon-arrow-left.svg'); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                    <?php include(get_template_directory().'/parts/social-share.php'); ?>
                    <div class="next-post">
                        <?php if (!empty($post_next)): ?>
                            <a href="<?php echo get_permalink($post_next->ID); ?>" title="Next post">
                                <?php include_asset('icon-arrow-right.svg'); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>
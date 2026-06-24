<?php if (isset($block['data']['preview_image']) && $block['data']['preview_image']): ?>
    <img src="<?php echo get_template_directory_uri(); ?>/blocks/preview/<?php echo $block['data']['preview_image']; ?>" style="width: 100%; height: auto; display: block;">
<?php else:
    $block_name = 'block-post-header';
    $block_classes = ['betterbase-theme', $block_name, $block['className'] ?? null];
    $block_anchor = $block['anchor'] ?? '';
    $block_css = $block['css'] ?? '';
    $padding_top = $block['settings_padding_top'] ?? '40';
    $padding_bottom = $block['settings_padding_bottom'] ?? '40';
    $background_colour = $block['settings_background_colour'] ?? 'none';
    $container = $block['settings_container'] ?? 'md';
    $setting_classes = ['block-setting-padding', 'block-setting-background-color'];
    $setting_styles = ['--block-padding-top: '.$padding_top.'px', '--block-padding-bottom: '.$padding_bottom.'px', '--block-background-color: var(--'.$background_colour.')'];

    $post_ID = get_the_ID();
    $post_title = get_the_title($post_ID);
    $post_categories = get_the_category($post_ID);
    $post_date = get_the_date('d F Y', $post_ID); ?>

   <div class="<?php echo implode(' ', array_filter($block_classes)); ?>" <?php echo ($block_anchor ? 'id="'.esc_attr($block_anchor).'"' : ''); ?> <?php echo ($block_css ? 'style="'.esc_attr($block_css).'"' : ''); ?>>
        <div class="<?php echo implode(' ', $setting_classes); ?>" style="<?php echo implode('; ', $setting_styles); ?>">
            <div class="container-<?php echo $container; ?>">
                <div class="wysiwyg-content <?php echo get_text_colour($background_colour); ?>">
                    <?php if (!empty($post_categories)): ?>
                        <div class="group-tags">
                            <?php foreach ($post_categories as $term): ?>
                                <span><?php echo $term->name; ?></span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <h1 class="h2"><?php echo ($post_title ?? 'Add blog title here...'); ?></h1>
                    <?php if (!empty($post_date)): ?>
                        <p><?php echo $post_date; ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>
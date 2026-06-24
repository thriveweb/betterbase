<?php if (isset($block['data']['preview_image']) && $block['data']['preview_image']): ?>
    <img src="<?php echo get_template_directory_uri(); ?>/blocks/preview/<?php echo $block['data']['preview_image']; ?>" style="width: 100%; height: auto; display: block;">
<?php else:
    $block_name = 'block-post-feed';
    $block_classes = ['betterbase-theme', $block_name, $block['className'] ?? null];
    $block_anchor = $block['anchor'] ?? '';
    $block_css = $block['css'] ?? '';
    $padding_top = $block['settings_padding_top'] ?? '80';
    $padding_bottom = $block['settings_padding_bottom'] ?? '80';
    $background_color = $block['settings_background_color'] ?? 'none';
    $container = $block['settings_container'] ?? 'md';
    $setting_classes = ['block-setting-padding', 'block-setting-background-color'];
    $setting_styles = ['--block-padding-top: '.$padding_top.'px', '--block-padding-bottom: '.$padding_bottom.'px', '--block-background-color: var(--'.$background_color.')'];

    $title = get_field('block_title');
    $select_posts = get_field('block_select_posts');

    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 3,
        'order' => 'desc',
    ); 

    if (!empty($select_posts)) {
        $args['post__in'] = $select_posts;
        $args['orderby'] = 'post__in';
    } else {
        $args['orderby'] = 'date';
    }

    $block_post_query = new WP_Query($args);

    if ($block_post_query->have_posts()): ?>
        <div class="<?php echo implode(' ', array_filter($block_classes)); ?>" <?php echo ($block_anchor ? 'id="'.esc_attr($block_anchor).'"' : ''); ?> <?php echo ($block_css ? 'style="'.esc_attr($block_css).'"' : ''); ?>>
            <div class="<?php echo implode(' ', $setting_classes); ?>" style="<?php echo implode('; ', $setting_styles); ?>">
                <?php if (!empty($title)): ?>
                    <div class="container-sm">
                        <div class="inner-block-head">
                            <div class="wysiwyg-content text-center <?php echo get_text_colour($background_color); ?>">
                                <h3><?php echo $title; ?></h3>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="container-<?php echo $container; ?> <?php echo get_text_colour($background_color); ?>">
                    <div class="listing-posts grid-col-3">
                        <?php while ($block_post_query->have_posts()): $block_post_query->the_post(); $post_ID = get_the_ID(); ?>
                            <?php include(get_template_directory().'/parts/entry-post.php'); ?>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php else: get_empty_block_message(); endif; ?>
<?php endif; ?>
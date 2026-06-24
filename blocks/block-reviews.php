<?php if (isset($block['data']['preview_image']) && $block['data']['preview_image']): ?>
    <img src="<?php echo get_template_directory_uri(); ?>/blocks/preview/<?php echo $block['data']['preview_image']; ?>" style="width: 100%; height: auto; display: block;">
<?php else:
    $block_name = 'block-reviews';
    $block_classes = ['betterbase-theme', $block_name, $block['className'] ?? null];
    $block_anchor = $block['anchor'] ?? '';
    $block_css = $block['css'] ?? '';
    $padding_top = $block['settings_padding_top'] ?? '80';
    $padding_bottom = $block['settings_padding_bottom'] ?? '80';
    $background_color = $block['settings_background_color'] ?? 'none';
    $container = $block['settings_container'] ?? 'sm';
    $setting_classes = ['block-setting-padding', 'block-setting-background-color'];
    $setting_styles = ['--block-padding-top: '.$padding_top.'px', '--block-padding-bottom: '.$padding_bottom.'px', '--block-background-color: var(--'.$background_color.')'];

    $title = get_field('block_title');
    $select_reviews = get_field('block_select_reviews');

    $args = array(
        'post_type' => 'review',
        'post_status' => 'publish',
        'posts_per_page' => 5,
        'order' => 'desc',
    ); 

    if (!empty($select_reviews)) {
        $args['post__in'] = $select_reviews;
        $args['orderby'] = 'post__in';
    } else {
        $args['orderby'] = 'date';
    }

    $block_review_query = new WP_Query($args);

    if ($block_review_query->have_posts()): ?>
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
                    <div class="swiper-carousel-wrap">
                        <div class="carousel-reviews swiper">
                            <div class="swiper-wrapper">
                                <?php while ($block_review_query->have_posts()): $block_review_query->the_post(); $review_ID = get_the_ID(); ?>
                                    <div class="swiper-slide">
                                        <?php include(get_template_directory().'/parts/entry-review.php'); ?>
                                    </div>
                                <?php endwhile; wp_reset_postdata(); ?>
                            </div>
                            <div class="swiper-footer">
                                <div class="swiper-navigation">
                                    <div class="swiper-nav-prev">
                                        <?php include_asset('icon-arrow-left.svg'); ?>
                                    </div>
                                    <div class="swiper-nav-next">
                                        <?php include_asset('icon-arrow-right.svg'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else: get_empty_block_message(); endif; ?>
<?php endif; ?>
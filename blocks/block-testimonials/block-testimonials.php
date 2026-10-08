<?php
if (betterbase_block_preview($block)) {
    return;
}
extract(betterbase_block_settings($block));

$title = get_field('title');
$select_testimonials = get_field('select_testimonials');

$args = array(
    'post_type' => 'testimonial',
    'post_status' => 'publish',
    'posts_per_page' => 5,
    'order' => 'desc',
);

if (!empty($select_testimonials)) {
    $args['post__in'] = $select_testimonials;
    $args['orderby'] = 'post__in';
} else {
    $args['orderby'] = 'date';
}

$get_testimonials = new WP_Query($args);

if ($get_testimonials->have_posts()): ?>
    <div class="<?php echo esc_attr(implode(' ', array_filter($block_classes))); ?>" <?php echo ($block_anchor ? 'id="'.esc_attr($block_anchor).'"' : ''); ?> <?php echo ($block_css ? 'style="'.esc_attr($block_css).'"' : ''); ?>>
        <div class="<?php echo esc_attr(implode(' ', $setting_classes)); ?>" style="<?php echo esc_attr(implode('; ', $setting_styles)); ?>">
            <?php if (!empty($title)): ?>
                <div class="inner-block-head">
                    <div class="container-sm">
                        <div class="wysiwyg-content text-align-center <?php echo esc_attr(betterbase_get_text_color($background_color)); ?>">
                            <h3 class="h2"><?php echo esc_html($title); ?></h3>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="inner-block-main">
                <div class="container-<?php echo esc_attr($container); ?>">
                    <div class="carousel-testimonials swiper <?php echo esc_attr(betterbase_get_text_color($background_color)); ?>">
                        <div class="swiper-wrapper">
                            <?php while ($get_testimonials->have_posts()): $get_testimonials->the_post(); ?>
                                <div class="swiper-slide">
                                    <?php $testimonial_ID = get_the_ID();
                                    include(get_template_directory().'/parts/entry-testimonial.php'); ?>
                                </div>
                            <?php endwhile; wp_reset_postdata(); ?>
                        </div>
                        <div class="swiper-footer">
                            <div class="swiper-navigation">
                                <div class="swiper-nav-prev">
                                    <?php betterbase_include_asset('icon-arrow-left.svg'); ?>
                                </div>
                                <div class="swiper-nav-next">
                                    <?php betterbase_include_asset('icon-arrow-right.svg'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else: betterbase_block_empty(); endif; ?>

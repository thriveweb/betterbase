<?php
if (betterbase_block_preview($block)) {
    return;
}
extract(betterbase_block_settings($block));

$title = get_field('title');
$select_posts = get_field('select_posts');

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

$get_posts = new WP_Query($args);

if ($get_posts->have_posts()): ?>
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
                    <div class="listing-posts grid-col-3 <?php echo esc_attr(betterbase_get_text_color($background_color)); ?>">
                        <?php while ($get_posts->have_posts()): $get_posts->the_post(); ?>
                            <?php $post_ID = get_the_ID();
                            include(get_template_directory().'/parts/entry-post.php'); ?>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else: betterbase_block_empty(); endif; ?>

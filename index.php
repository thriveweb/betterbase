<?php get_header();

$archive_ID = get_option('page_for_posts', true);
$archive_object = get_post($archive_ID);

$categories = get_terms(array(
    'taxonomy' => 'category',
    'orderby' => 'menu_order',
    'order' => 'asc',
    'hide_empty' => false,
    'parent' => 0,
)); ?>

<div class="archive-index">
    <?php echo (!empty($archive_object) ? apply_filters('the_content', $archive_object->post_content) : ''); ?>
    <div class="block-post-feed">
        <div class="block-setting-padding" style="--block-padding-top: 80px; --block-padding-bottom: 80px;">
            <div class="container-lg">
                <?php if (!empty($categories)): ?>
                    <div class="listing-categories flex-layout flex-align-center flex-gap padding-md-bot">
                        <a class="is-active" href="<?php echo get_permalink($archive_ID); ?>">View All</a>
                        <?php foreach ($categories as $term): ?>
                            <a href="<?php echo get_term_link($term->term_id); ?>"><?php echo $term->name; ?></a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <?php if (have_posts()): ?>
                    <div class="listing-posts grid-col-3">
                        <?php while (have_posts()): the_post(); $post_ID = get_the_ID(); ?>
                            <?php include(get_template_directory().'/parts/entry-post.php'); ?>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                    <?php get_pagination(); ?>
                <?php else: ?>
                    <p>No posts found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer();

<?php get_header(); 

$archive_ID = (int) get_option('page_for_posts');
$archive_object = $archive_ID ? get_post($archive_ID) : null;
$active_term_ID = is_category() ? (int) get_queried_object_id() : 0;

$categories = get_terms(array(
    'taxonomy'   => 'category',
    'orderby'    => 'menu_order',
    'order'      => 'ASC',
    'hide_empty' => false,
    'parent'     => 0,
)); ?>

<div class="archive-posts">
    <?php if (!empty($archive_object)) {
        echo apply_filters('the_content', $archive_object->post_content);
    } ?>
    <div class="betterbase-theme block-post-listing">
        <div class="block-setting-padding" style="--block-padding-top: 40px; --block-padding-bottom: 80px;">
            <?php if (!empty($categories) && !is_wp_error($categories)): ?>
                <div class="inner-block-head">
                    <div class="container-lg">
                        <div class="group-categories">
                            <a<?php echo $active_term_ID === 0 ? ' class="is-active"' : ''; ?> href="<?php echo esc_url(get_permalink($archive_ID)); ?>">View All</a>
                            <?php foreach ($categories as $term): ?>
                                <a<?php echo $active_term_ID === (int) $term->term_id ? ' class="is-active"' : ''; ?> href="<?php echo esc_url(get_term_link($term)); ?>"><?php echo esc_html($term->name); ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="inner-block-main">
                <div class="container-lg">
                    <?php if (have_posts()): ?>
                        <div class="listing-posts grid-col-3">
                            <?php while (have_posts()): the_post(); ?>
                                <?php $post_ID = get_the_ID(); 
                                include get_template_directory() . '/parts/entry-post.php'; ?>
                            <?php endwhile; wp_reset_postdata(); ?>
                        </div>
                        <?php betterbase_get_pagination(); ?>
                    <?php else: ?>
                        <p>No posts found.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>

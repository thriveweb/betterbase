<?php get_header();

$page_ID = get_queried_object_ID();
$get_search = esc_html(get_search_query()); ?>

<div class="archive-search">
    <div class="betterbase-theme block-search-results">
        <div class="block-setting-padding" style="--block-padding-top: 80px; --block-padding-bottom: 80px;">
            <div class="container-lg">
                <div class="wysiwyg-content padding-md-bot">
                    <h1 class="h2">Search Results</h1>
                    <?php if (!empty($get_search)): ?>
                        <p>Showing results for: <strong><?php echo $get_search; ?></strong></p>
                    <?php endif; ?>
                </div>
                <?php if (have_posts()): ?>
                    <div class="listing-posts grid-col-3">
                        <?php while (have_posts()): the_post(); $post_ID = get_the_ID();
                            include(get_template_directory().'/parts/entry-post.php'); ?>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                    <?php get_pagination(); ?>
                <?php else: ?>
                    <p>No results found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer();
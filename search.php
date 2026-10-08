<?php get_header();

$search_query = get_search_query(); ?>

<div class="archive-search">
    <div class="betterbase-theme block-search-listing">
        <div class="block-setting-padding" style="--block-padding-top: 40px; --block-padding-bottom: 80px;">
            <div class="inner-block-head">
                <div class="container-md">
                    <div class="wysiwyg-content text-align-center">
                        <h1 class="h2">Search Results</h1>
                        <?php if ($search_query !== ''): ?>
                            <p>Showing results for: <strong><?php echo esc_html($search_query); ?></strong></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="inner-block-main">
                <div class="container-md">
                    <?php if (have_posts()): ?>
                        <div class="listing-search">
                            <?php while (have_posts()): the_post(); ?>
                                <?php $search_ID = get_the_ID();
                                include get_template_directory() . '/parts/entry-search.php'; ?>
                            <?php endwhile; wp_reset_postdata(); ?>
                        </div>
                        <?php betterbase_get_pagination(); ?>
                    <?php else: ?>
                        <div class="search-empty wysiwyg-content text-align-center">
                            <p>No results found. Try something else?</p>
                            <?php get_search_form(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>

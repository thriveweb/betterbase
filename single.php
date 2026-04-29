<?php get_header();

$page_ID = get_queried_object_ID();
$post_type = get_post_type($post_ID); ?>

<div class="single-<?php echo $post_type; ?>">
    <?php while (have_posts()): the_post(); ?>
        <?php the_content(); ?>
    <?php endwhile; ?>
</div>

<?php get_footer();

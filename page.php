<?php get_header(); 

$page_ID = get_queried_object_ID(); ?>

<div class="page-default">
   <?php while (have_posts()): the_post(); ?>
      <?php the_content(); ?>
   <?php endwhile; ?>
</div>

<?php get_footer();

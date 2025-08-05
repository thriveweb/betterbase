<?php get_header();

if (is_home() && !is_front_page()) {
   $archive_ID = get_option('page_for_posts', true);
} elseif (is_tax() || is_category()) {
   $archive_ID = get_queried_object()->term_id;
} else {
   $archive_ID = get_queried_object_ID();
}

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
      <div class="block-setting-padding block-setting-background-colour" style="--block-padding-top: 80px; --block-padding-bottom: 80px; --block-background-colour: var(--none);">
         <div class="container-lg">
            <?php if (!empty($categories)): ?>
               <div class="listing-categories flex-layout flex-align-center flex-gap padding-md-bot">
                  <a href="<?php echo get_permalink($archive_ID); ?>">All</a>
                  <?php foreach ($categories as $cat): ?>
                     <a href="<?php echo get_term_link($cat->term_id); ?>"><?php echo $cat->name; ?></a>
                  <?php endforeach; ?>
               </div>
            <?php endif; ?>
            <?php if (have_posts()): ?>
               <div class="listing-posts grid-col-3">
                  <?php while (have_posts()): the_post(); $post_ID = get_the_ID(); ?>
                     <?php include(get_template_directory().'/parts/entry-post.php'); ?>
                  <?php endwhile; wp_reset_postdata(); ?>
               </div>
            <?php else: ?>
               <p>No posts found.</p>
            <?php endif; ?>
            <?php get_pagination(); ?>
         </div>
      </div>
   </div>
</div>

<?php get_footer();

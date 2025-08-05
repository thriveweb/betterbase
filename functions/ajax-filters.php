<?php

/*---------------------------------------------------------------------------
   AJAX callback for post filter
---------------------------------------------------------------------------*/

function post_ajax_filter_callback() {
   $args = array(
      'post_type' => 'post',
      'post_status' => 'publish',
      'posts_per_page' => -1,
      'orderby' => 'menu_order',
      'surpress_filters' => true,
   );

   if (isset($_POST['category'])) {
      $get_category = $_POST['category'];
      $args['tax_query'] = array(
         array(
         'taxonomy' => 'category',
         'terms' => $get_category,
         'fields' => 'ID',
         )
      );
   } else {
      $get_category = '';
   }

   $ajax_post_query = new WP_Query($args); ?>

   <?php if ($ajax_post_query->have_posts()): ?>
      <div class="listing-posts grid-col-3">
         <?php while ($ajax_post_query->have_posts()): $ajax_post_query->the_post(); $post_ID = get_the_ID(); ?>
            <?php include(get_template_directory().'/parts/entry-post.php'); ?>
         <?php endwhile; ?>
      </div>
   <?php else: ?>
      <p>No posts found.</p>
   <?php endif; wp_reset_postdata(); wp_die();
}
add_action('wp_ajax_post_ajax_filter', 'post_ajax_filter_callback');
add_action('wp_ajax_nopriv_post_ajax_filter', 'post_ajax_filter_callback');
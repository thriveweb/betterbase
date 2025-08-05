<?php
$post_title = get_the_title($post_ID);
$post_image = get_the_post_thumbnail_url($post_ID, 'large');
$post_categories = get_the_category($post_ID); ?>

<a class="entry-post" href="<?php echo get_permalink($post_ID); ?>" title="<?php echo get_the_title($post_ID); ?>">
   <div class="inner-entry-image image-landscape">
      <?php if (!empty($post_image)): ?>
         <div class="background-image" style="background-image: url(<?php echo $post_image; ?>);"></div>
      <?php endif; ?>
   </div>
   <div class="inner-entry-content">
      <?php if (!empty($post_categories)): ?>
         <h6><?php echo $post_categories[0]->name; ?></h6>
      <?php endif; ?>
      <h5><?php echo $post_title; ?></h5>
   </div>
</a>

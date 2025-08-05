<?php if (isset($block['data']['has_preview']) && $block['data']['has_preview']): ?>
<?php else:
   $classes = 'block-post-feed';
   $classes .= (isset($block['className']) ? ' '.$block['className'] : '');
   $anchor = (isset($block['anchor']) ? $block['anchor'] : '');
   $background = (isset($block['settings_background_colour']) ? $block['settings_background_colour'] : 'none');
   $container = (isset($block['settings_container']) ? $block['settings_container'] : 'md');
   $padding_top = (isset($block['settings_padding_top']) ? $block['settings_padding_top'] : '80');
   $padding_bottom = (isset($block['settings_padding_bottom']) ? $block['settings_padding_bottom'] : '80');

   $select_posts = get_field('block_select_posts');

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

   $block_post_query = new WP_Query($args); 

   if ($block_post_query->have_posts()): ?>
      <div class="betterbase-theme <?php echo $classes; ?>" <?php echo ($anchor ? 'id="'.$anchor.'"' : ''); ?>>
         <div class="block-setting-padding block-setting-background-colour" style="--block-padding-top: <?php echo $padding_top; ?>px; --block-padding-bottom: <?php echo $padding_bottom; ?>px; --block-background-colour: var(--<?php echo $background; ?>);">
            <div class="container-<?php echo $container; ?> <?php echo get_text_colour($background); ?>">
               <div class="listing-posts grid-col-3">
                  <?php while ($block_post_query->have_posts()): $block_post_query->the_post(); $post_ID = get_the_ID(); ?>
                     <?php include(get_template_directory().'/parts/entry-post.php'); ?>
                  <?php endwhile; wp_reset_postdata(); ?>
               </div>
            </div>
         </div>
      </div>
   <?php else: ?><p style="text-align: center;">No preview available.</p><?php endif; ?>
<?php endif; ?>
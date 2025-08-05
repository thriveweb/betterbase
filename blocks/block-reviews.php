<?php if (isset($block['data']['has_preview']) && $block['data']['has_preview']): ?>
<?php else:
   $classes = 'block-reviews';
   $classes .= (isset($block['className']) ? ' '.$block['className'] : '');
   $anchor = (isset($block['anchor']) ? $block['anchor'] : '');
   $background = (isset($block['settings_background_colour']) ? $block['settings_background_colour'] : 'none');
   $container = (isset($block['settings_container']) ? $block['settings_container'] : 'sm');
   $padding_top = (isset($block['settings_padding_top']) ? $block['settings_padding_top'] : '80');
   $padding_bottom = (isset($block['settings_padding_bottom']) ? $block['settings_padding_bottom'] : '80');

   $select_reviews = get_field('block_select_reviews');

   $args = array(
      'post_type' => 'review',
      'post_status' => 'publish',
      'posts_per_page' => 3,
      'order' => 'desc',
   ); 

   if (!empty($select_reviews)) {
      $args['post__in'] = $select_reviews;
      $args['orderby'] = 'post__in';
   } else {
      $args['orderby'] = 'date';
   }

   $block_review_query = new WP_Query($args); 

   if ($block_review_query->have_posts()): ?>
      <div class="betterbase-theme <?php echo $classes; ?>" <?php echo ($anchor ? 'id="'.$anchor.'"' : ''); ?>>
         <div class="block-setting-padding block-setting-background-colour" style="--block-padding-top: <?php echo $padding_top; ?>px; --block-padding-bottom: <?php echo $padding_bottom; ?>px; --block-background-colour: var(--<?php echo $background; ?>);">
            <div class="container-<?php echo $container; ?> <?php echo get_text_colour($background); ?>">
               <div class="swiper-carousel-wrap">
                  <div class="carousel-reviews swiper">
                     <div class="swiper-wrapper">
                        <?php while ($block_review_query->have_posts()): $block_review_query->the_post(); $review_ID = get_the_ID(); ?>
                           <div class="swiper-slide">
                              <?php include(get_template_directory().'/parts/entry-review.php'); ?>
                           </div>
                        <?php endwhile; wp_reset_postdata(); ?>
                     </div>
                     <div class="swiper-navigation">
                        <div class="swiper-nav-prev"><?php include_asset('icon-arrow-left.svg'); ?></div>
                        <div class="swiper-nav-next"><?php include_asset('icon-arrow-right.svg'); ?></div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   <?php else: ?><p style="text-align: center;">No preview available.</p><?php endif; ?>
<?php endif; ?>
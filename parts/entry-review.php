<?php
$review_title = get_the_title($review_ID);
$review_rating = get_field('review_rating', $review_ID);
$review_full_quote = get_field('review_quote', $review_ID);
$review_quote_count = explode(' ', $review_full_quote);
$review_short_quote = implode(' ', array_slice($review_quote_count, 0, 40));
$review_byline = get_field('review_byline', $review_ID);
$review_image = get_the_post_thumbnail_url($review_ID, 'large');
$review_categories = get_the_category($review_ID); ?>

<div class="entry-review">
   <div class="inner-entry-content has-read-more text-center">
      <?php if (count($review_quote_count) <= 40): ?>
         <h5>"<?php echo $review_full_quote; ?>"</h5>
      <?php else: ?>
         <h5 class="short-content">"<?php echo $review_short_quote; ?>..."</h5>
         <h5 class="full-content" style="display: none;">"<?php echo $review_full_quote; ?>"</h5>
         <a href="#" class="toggle-read-more" data-text="Read less">Read more</a>
      <?php endif; ?>
   </div>
   <div class="inner-entry-meta flex-layout flex-align-center flex-justify-center flex-gap">
      <div class="inner-entry-image image-square">
         <?php if (!empty($review_image)): ?>
            <div class="background-image" style="background-image: url(<?php echo $review_image; ?>);"></div>
         <?php endif; ?>
      </div>
      <div>
         <p><?php echo $review_title; ?></p>
         <?php if (!empty($review_byline)): ?>
            <h6><?php echo $review_byline ?></h6>
         <?php endif; ?>
      </div>
   </div>
</div>

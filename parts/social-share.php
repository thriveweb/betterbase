<div class="social-icons share-icons flex-layout flex-align-center">
   <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink(); ?>&quote=<?php echo get_the_title(); ?>" target="_blank" rel="noreferrer" title="Share on Facebook">
      <?php include_asset('icon-facebook.svg'); ?>
   </a>
   <a href="https://twitter.com/intent/tweet?url=<?php echo get_permalink(); ?>&text=<?php echo get_the_title(); ?>" target="_blank" rel="noreferrer" title="Share on Twitter">
      <?php include_asset('icon-twitter.svg'); ?>
   </a>
   <a href="https://www.pinterest.com/pin/create/button/?url=<?php echo get_permalink(); ?>&media=<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>&description=<?php echo get_the_title(); ?>" target="_blank" rel="noreferrer" title="Share on Pinterest">
      <?php include_asset('icon-pinterest.svg'); ?>
   </a>
   <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo get_permalink(); ?>" target="_blank" rel="noreferrer" title="Share on Linkedin">
      <?php include_asset('icon-linkedin.svg'); ?>
   </a>
   <div class="copy-to-clipboard" data-url="<?php echo get_permalink(); ?>">
      <span class="tooltip">Copy to clipboard</span>
      <?php include_asset('icon-copy-link.svg'); ?>
   </div>
</div>

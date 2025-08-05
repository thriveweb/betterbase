<?php if (!empty($add_social_media)): ?>
   <div class="social-icons flex-layout flex-align-center">
      <?php foreach ($add_social_media as $media): ?>
         <a href="<?php echo $media['url']; ?>" target="_blank" rel="noopener noreferrer" title="Find us on <?php echo $media['platform']['label']; ?>">
            <?php include_asset('icon-'.$media['platform']['value'].'.svg'); ?>
         </a>
      <?php endforeach; ?>
   </div>
<?php endif; ?>

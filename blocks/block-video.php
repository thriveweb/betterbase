<?php if (isset($block['data']['has_preview']) && $block['data']['has_preview']): ?>
<?php else:
   $classes = 'block-video';
   $classes .= (isset($block['className']) ? ' '.$block['className'] : '');
   $anchor = (isset($block['anchor']) ? $block['anchor'] : '');
   $background = (isset($block['settings_background_colour']) ? $block['settings_background_colour'] : 'none');
   $container = (isset($block['settings_container']) ? $block['settings_container'] : 'sm');
   $padding_top = (isset($block['settings_padding_top']) ? $block['settings_padding_top'] : '80');
   $padding_bottom = (isset($block['settings_padding_bottom']) ? $block['settings_padding_bottom'] : '80');

   $video_type = get_field('block_video_type');
   $embed_video = get_field('block_embed_video');
   $upload_video = get_field('block_upload_video');
   $video_thumbnail = get_field('block_video_thumbnail');

   if (!empty($embed_video) || !empty($upload_video)): ?>
      <div class="betterbase-theme <?php echo $classes; ?>" <?php echo ($anchor ? 'id="'.$anchor.'"' : ''); ?>>
         <div class="block-setting-padding block-setting-background-colour" style="--block-padding-top: <?php echo $padding_top; ?>px; --block-padding-bottom: <?php echo $padding_bottom; ?>px; --block-background-colour: var(--<?php echo $background; ?>);">
            <div class="container-<?php echo $container; ?>">
               <?php if ($video_type === 'embed' && !empty($embed_video)): ?>
                  <div class="responsive-embed">
                     <?php echo $embed_video; ?>
                  </div>
               <?php elseif ($video_type === 'upload' && !empty($upload_video)): ?>
                  <video width="100%" playsinline controls poster="<?php echo ($video_thumbnail ? $video_thumbnail['sizes']['large'] : ''); ?>">
                     <source src="<?php echo $upload_video['url']; ?>" type="video/mp4">
                  </video>
               <?php endif; ?>
            </div>
         </div>
      </div>
   <?php else: ?><p style="text-align: center;">No preview available.</p><?php endif; ?>
<?php endif; ?>
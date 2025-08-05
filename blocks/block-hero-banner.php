<?php if (isset($block['data']['has_preview']) && $block['data']['has_preview']): ?>
<?php else:
   $classes = 'block-hero-banner';
   $classes .= (isset($block['className']) ? ' '.$block['className'] : '');
   $anchor = (isset($block['anchor']) ? $block['anchor'] : '');
   $background = (isset($block['settings_background_colour']) ? $block['settings_background_colour'] : 'none');
   $container = (isset($block['settings_container']) ? $block['settings_container'] : 'md');
   $padding_top = (isset($block['settings_padding_top']) ? $block['settings_padding_top'] : '220');
   $padding_bottom = (isset($block['settings_padding_bottom']) ? $block['settings_padding_bottom'] : '220');

   $content = get_field('block_content');
   $add_button = get_field('block_add_button');
   $button_alignment = get_field('block_button_alignment');
   $background_image = get_field('block_background_image');

   if (!empty($content)): ?>
      <div class="betterbase-theme <?php echo $classes; ?>" <?php echo ($anchor ? 'id="'.$anchor.'"' : ''); ?>>
         <div class="block-setting-padding block-setting-background-colour" style="--block-padding-top: <?php echo $padding_top; ?>px; --block-padding-bottom: <?php echo $padding_bottom; ?>px; --block-background-colour: var(--<?php echo $background; ?>);">
            <div class="container-<?php echo $container; ?>">
               <div class="wysiwyg-content text-white">
                  <?php echo $content; ?>
                  <?php include(get_template_directory().'/parts/group-button.php'); ?>
               </div>
            </div>
            <?php if (!empty($background_image)): ?>
               <div class="background-image" style="background-image: url(<?php echo $background_image['sizes']['2048x2048']; ?>);"></div>
            <?php endif; ?>
         </div>
      </div>
   <?php else: ?><p style="text-align: center;">No preview available.</p><?php endif; ?>
<?php endif; ?>
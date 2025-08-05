<?php if (isset($block['data']['has_preview']) && $block['data']['has_preview']): ?>
<?php else:
   $classes = 'block-wysiwyg-content';
   $classes .= (isset($block['className']) ? ' '.$block['className'] : '');
   $anchor = (isset($block['anchor']) ? $block['anchor'] : '');
   $background = (isset($block['settings_background_colour']) ? $block['settings_background_colour'] : 'none');
   $container = (isset($block['settings_container']) ? $block['settings_container'] : 'md');
   $padding_top = (isset($block['settings_padding_top']) ? $block['settings_padding_top'] : '80');
   $padding_bottom = (isset($block['settings_padding_bottom']) ? $block['settings_padding_bottom'] : '80');

   $content = get_field('block_content');
   $add_button = get_field('block_add_button');
   $button_alignment = get_field('block_button_alignment');

   if (!empty($content)): ?>
      <div class="betterbase-theme <?php echo $classes; ?>" <?php echo ($anchor ? 'id="'.$anchor.'"' : ''); ?>>
         <div class="block-setting-padding block-setting-background-colour" style="--block-padding-top: <?php echo $padding_top; ?>px; --block-padding-bottom: <?php echo $padding_bottom; ?>px; --block-background-colour: var(--<?php echo $background; ?>);">
            <div class="container-<?php echo $container; ?>">
               <div class="wysiwyg-content <?php echo get_text_colour($background); ?>">
                  <?php echo $content; ?>
                  <?php include(get_template_directory().'/parts/group-button.php'); ?>
               </div>
            </div>
         </div>
      </div>
   <?php else: ?><p style="text-align: center;">No preview available.</p><?php endif; ?>
<?php endif; ?>
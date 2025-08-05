<?php if (isset($block['data']['has_preview']) && $block['data']['has_preview']): ?>
   <img src="<?php echo get_template_directory_uri(); ?>/blocks/preview/block-TEMPLATE.png" class="acf_pre" style="width: 100%;">
<?php else:
   $classes = 'block-TEMPLATE';
   $classes .= (isset($block['className']) ? ' '.$block['className'] : '');
   $anchor = (isset($block['anchor']) ? $block['anchor'] : '');
   $background = (isset($block['settings_background_colour']) ? $block['settings_background_colour'] : 'none');
   $container = (isset($block['settings_container']) ? $block['settings_container'] : 'lg');
   $padding_top = (isset($block['settings_padding_top']) ? $block['settings_padding_top'] : '80');
   $padding_bottom = (isset($block['settings_padding_bottom']) ? $block['settings_padding_bottom'] : '80');

   $custom_field = get_field('block_custom_field');

   if (!empty($custom_field)): ?>
      <div class="betterbase-theme <?php echo $classes; ?>" <?php echo ($anchor ? 'id="'.$anchor.'"' : ''); ?>>
         <div class="block-setting-padding block-setting-background-colour" style="--block-padding-top: <?php echo $padding_top; ?>px; --block-padding-bottom: <?php echo $padding_bottom; ?>px; --block-background-colour: var(--<?php echo $background; ?>);">
            <div class="container-<?php echo $container; ?> <?php echo get_text_colour($background); ?>">
               <?php echo $custom_field; ?>
            </div>
         </div>
      </div>
   <?php else: ?><p style="text-align: center;">No preview available.</p><?php endif; ?>
<?php endif; ?>
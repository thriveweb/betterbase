<?php if (isset($block['data']['has_preview']) && $block['data']['has_preview']): ?>
<?php else:
   $classes = 'block-separator';
   $classes .= (isset($block['className']) ? ' '.$block['className'] : '');
   $anchor = (isset($block['anchor']) ? $block['anchor'] : '');
   $background = (isset($block['settings_background_colour']) ? $block['settings_background_colour'] : 'black');
   $container = (isset($block['settings_container']) ? $block['settings_container'] : 'xl');
   $padding_top = (isset($block['settings_padding_top']) ? $block['settings_padding_top'] : '0');
   $padding_bottom = (isset($block['settings_padding_bottom']) ? $block['settings_padding_bottom'] : '0');

   if (!empty($background)): ?>
      <div class="betterbase-theme <?php echo $classes; ?>" <?php echo ($anchor ? 'id="'.$anchor.'"' : ''); ?>>
         <div class="container-<?php echo $container; ?>">
            <div class="separator" style="--block-background-colour: var(--<?php echo $background; ?>);"></div>
         </div>
      </div>
   <?php else: ?><p style="text-align: center;">No preview available.</p><?php endif; ?>
<?php endif; ?>
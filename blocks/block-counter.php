<?php if (isset($block['data']['has_preview']) && $block['data']['has_preview']): ?>
<?php else:
   $classes = 'block-counter';
   $classes .= (isset($block['className']) ? ' '.$block['className'] : '');
   $anchor = (isset($block['anchor']) ? $block['anchor'] : '');
   $background = (isset($block['settings_background_colour']) ? $block['settings_background_colour'] : 'none');
   $container = (isset($block['settings_container']) ? $block['settings_container'] : 'md');
   $padding_top = (isset($block['settings_padding_top']) ? $block['settings_padding_top'] : '80');
   $padding_bottom = (isset($block['settings_padding_bottom']) ? $block['settings_padding_bottom'] : '80');

   $add_counter = get_field('block_add_counter');

   if (!empty($add_counter)): ?>
      <div class="betterbase-theme <?php echo $classes; ?>" <?php echo ($anchor ? 'id="'.$anchor.'"' : ''); ?>>
         <div class="block-setting-padding block-setting-background-colour" style="--block-padding-top: <?php echo $padding_top; ?>px; --block-padding-bottom: <?php echo $padding_bottom; ?>px; --block-background-colour: var(--<?php echo $background; ?>);">
            <div class="container-<?php echo $container; ?> <?php echo get_text_colour($background); ?>">
               <div class="listing-counter grid-col-<?php echo (count($add_counter) <= '4' ? count($add_counter) : '4'); ?>">
                  <?php foreach ($add_counter as $count): ?>
                     <div class="entry-counter">
                        <div class="inner-entry-content">
                           <h4 class="h1">
                              <?php echo ($count['prefix'] ? $count['prefix'] : ''); ?>
                              <span class="anim-count" data-target="<?php echo $count['number']; ?>"><?php echo (is_admin() ? $count['number'] : '0'); ?></span>
                              <?php echo ($count['suffix'] ? $count['suffix'] : ''); ?>
                           </h4>
                           <?php if (!empty($count['title'])): ?>
                              <p><?php echo $count['title']; ?></p>
                           <?php endif; ?>
                        </div>
                     </div>
                  <?php endforeach; ?>
               </div>
            </div>
         </div>
      </div>
   <?php else: ?><p style="text-align: center;">No preview available.</p><?php endif; ?>
<?php endif; ?>
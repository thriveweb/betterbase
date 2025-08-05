<?php if (isset($block['data']['has_preview']) && $block['data']['has_preview']): ?>
<?php else:
   $classes = 'block-split-content';
   $classes .= (isset($block['className']) ? ' '.$block['className'] : '');
   $anchor = (isset($block['anchor']) ? $block['anchor'] : '');
   $background = (isset($block['settings_background_colour']) ? $block['settings_background_colour'] : 'none');
   $container = (isset($block['settings_container']) ? $block['settings_container'] : 'md');
   $padding_top = (isset($block['settings_padding_top']) ? $block['settings_padding_top'] : '80');
   $padding_bottom = (isset($block['settings_padding_bottom']) ? $block['settings_padding_bottom'] : '80');

   $left_column = get_field('block_left_column');
   $left_type = $left_column['content_type'];
   $left_content = $left_column['content'];
   $left_image = $left_column['image'];
   $left_button_alignment = $left_column['button_alignment'];
   $left_add_button = $left_column['add_button'];

   $right_column = get_field('block_right_column');
   $right_type = $right_column['content_type'];
   $right_content = $right_column['content'];
   $right_image = $right_column['image'];
   $right_button_alignment = $right_column['button_alignment'];
   $right_add_button = $right_column['add_button'];

   if (!empty($left_column) && !empty($right_column)): ?>
      <div class="betterbase-theme <?php echo $classes; ?>" <?php echo ($anchor ? 'id="'.$anchor.'"' : ''); ?>>
         <div class="block-setting-padding block-setting-background-colour" style="--block-padding-top: <?php echo $padding_top; ?>px; --block-padding-bottom: <?php echo $padding_bottom; ?>px; --block-background-colour: var(--<?php echo $background; ?>);">
            <div class="container-<?php echo $container; ?>">
               <div class="grid-col-2 flex-align-center">
                  <div class="col-1 col-<?php echo $left_type; ?>">
                     <div class="wysiwyg-content <?php echo get_text_colour($background); ?>">
                        <?php if ($left_type === 'content' && !empty($left_content)): ?>
                           <?php echo $left_content; ?>
                        <?php elseif ($left_type === 'image' && !empty($left_image)): ?>
                           <img src="<?php echo $left_image['sizes']['large']; ?>" alt="<?php echo $left_image['alt']; ?>">
                        <?php endif; ?>
                        <?php $add_button = $left_add_button; $button_alignment = $right_button_alignment;
                        include(get_template_directory().'/parts/group-button.php'); ?>
                     </div>
                  </div>
                  <div class="col-2 col-<?php echo $right_type; ?>">
                  <div class="wysiwyg-content <?php echo get_text_colour($background); ?>">
                     <?php if ($right_type === 'content' && !empty($right_content)): ?>
                        <?php echo $right_content; ?>
                     <?php elseif ($right_type === 'image' && !empty($right_image)): ?>
                        <img src="<?php echo $right_image['sizes']['large']; ?>" alt="<?php echo $right_image['alt']; ?>">
                     <?php endif; ?>
                     <?php $add_button = $right_add_button; $button_alignment = $right_button_alignment;
                     include(get_template_directory().'/parts/group-button.php'); ?>
                  </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   <?php else: ?><p style="text-align: center;">No preview available.</p><?php endif; ?>
<?php endif; ?>
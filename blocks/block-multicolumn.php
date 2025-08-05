<?php if (isset($block['data']['has_preview']) && $block['data']['has_preview']): ?>
<?php else:
   $classes = 'block-multicolumn';
   $classes .= (isset($block['className']) ? ' '.$block['className'] : '');
   $anchor = (isset($block['anchor']) ? $block['anchor'] : '');
   $background = (isset($block['settings_background_colour']) ? $block['settings_background_colour'] : 'none');
   $container = (isset($block['settings_container']) ? $block['settings_container'] : 'md');
   $padding_top = (isset($block['settings_padding_top']) ? $block['settings_padding_top'] : '80');
   $padding_bottom = (isset($block['settings_padding_bottom']) ? $block['settings_padding_bottom'] : '80');
   $column_count = (isset($block['multicolumn_count']) ? $block['multicolumn_count'] : '2');
   $column_style = (isset($block['multicolumn_style']) ? $block['multicolumn_style'] : '2');
   $column_alignment = (isset($block['multicolumn_alignment']) ? $block['multicolumn_alignment'] : 'align-top');

   $add_column = get_field('block_add_column');

   if (!empty($add_column)): ?>
      <div class="betterbase-theme <?php echo $classes; ?>" <?php echo ($anchor ? 'id="'.$anchor.'"' : ''); ?>>
         <div class="block-setting-padding block-setting-background-colour" style="--block-padding-top: <?php echo $padding_top; ?>px; --block-padding-bottom: <?php echo $padding_bottom; ?>px; --block-background-colour: var(--<?php echo $background; ?>);">
            <div class="container-<?php echo $container; ?>">
               <div class="grid-col-<?php echo $column_count; ?> flex-<?php echo $column_alignment; ?> <?php echo $column_style; ?>">
                  <?php $i = 0; foreach ($add_column as $col): $i++; ?>
                  <div class="col-<?php echo $i; ?>">
                     <div class="wysiwyg-content <?php echo get_text_colour($background); ?>">
                        <?php echo ($col['column_content'] ? $col['column_content'] : ''); ?>
                        <?php $add_button = $col['column_add_button']; $button_alignment = $col['column_button_alignment']; 
                        include(get_template_directory().'/parts/group-button.php'); ?>
                     </div>
                  </div>
                  <?php endforeach; ?>
               </div>
            </div>
         </div>
      </div>
   <?php else: ?><p style="text-align: center;">No preview available</p><?php endif; ?>
<?php endif; ?>
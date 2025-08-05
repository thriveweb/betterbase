<?php if (isset($block['data']['has_preview']) && $block['data']['has_preview']): ?>
<?php else:
   $classes = 'block-page-banner';
   $classes .= (isset($block['className']) ? ' '.$block['className'] : '');
   $anchor = (isset($block['anchor']) ? $block['anchor'] : '');
   $background = (isset($block['settings_background_colour']) ? $block['settings_background_colour'] : 'none');
   $container = (isset($block['settings_container']) ? $block['settings_container'] : 'md');
   $padding_top = (isset($block['settings_padding_top']) ? $block['settings_padding_top'] : '120');
   $padding_bottom = (isset($block['settings_padding_bottom']) ? $block['settings_padding_bottom'] : '120');

   $page_ID = get_the_ID();
   $page_title = get_the_title($page_ID);
   $page_image = get_the_post_thumbnail_url($page_ID, '2048x2048');

   $title = get_field('block_title');
   $image = get_field('block_image'); ?>

   <div class="betterbase-theme <?php echo $classes; ?>" <?php echo ($anchor ? 'id="'.$anchor.'"' : ''); ?>>
      <div class="block-setting-padding block-setting-background-colour" style="--block-padding-top: <?php echo $padding_top; ?>px; --block-padding-bottom: <?php echo $padding_bottom; ?>px; --block-background-colour: var(--<?php echo $background; ?>);">
         <div class="container-<?php echo $container; ?>">
            <div class="wysiwyg-content text-white">
               <h1><?php echo ($title ? $title : $page_title); ?></h1>
            </div>
         </div>
         <?php if (!empty($image)): ?>
            <div class="background-image" style="background-image: url(<?php echo $image['sizes']['2048x2048']; ?>"></div>
         <?php elseif (!empty($page_image)): ?>
            <div class="background-image" style="background-image: url(<?php echo $page_image; ?>"></div>
         <?php endif; ?>
      </div>
   </div>

<?php endif; ?>
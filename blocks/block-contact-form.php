<?php if (isset($block['data']['has_preview']) && $block['data']['has_preview']): ?>
<?php else:
   $classes = 'block-contact-form';
   $classes .= (isset($block['className']) ? ' '.$block['className'] : '');
   $anchor = (isset($block['anchor']) ? $block['anchor'] : '');
   $background = (isset($block['settings_background_colour']) ? $block['settings_background_colour'] : 'none');
   $container = (isset($block['settings_container']) ? $block['settings_container'] : 'md');
   $padding_top = (isset($block['settings_padding_top']) ? $block['settings_padding_top'] : '80');
   $padding_bottom = (isset($block['settings_padding_bottom']) ? $block['settings_padding_bottom'] : '80');

   $phone_number = get_field('phone_number', 'options');
   $email_address = get_field('email_address', 'options');
   $street_address = get_field('street_address', 'options');
   $google_maps_url = get_field('google_maps_url', 'options');

   $content = get_field('block_content');
   $show_contact = get_field('block_show_contact');
   $form_id = get_field('block_form_id');

   if (!empty($form_id)): ?>
      <div class="betterbase-theme <?php echo $classes; ?>" <?php echo ($anchor ? 'id="'.$anchor.'"' : ''); ?>>
         <div class="block-setting-padding block-setting-background-colour" style="--block-padding-top: <?php echo $padding_top; ?>px; --block-padding-bottom: <?php echo $padding_bottom; ?>px; --block-background-colour: var(--<?php echo $background; ?>);">
            <div class="container-<?php echo $container; ?> <?php echo get_text_colour($background); ?>">
               <div class="grid-col-2">
                  <div class="wysiwyg-content">
                     <?php echo ($content ? $content : ''); ?>
                     <?php if (!empty($show_contact)): ?>
                        <?php if (!empty($phone_number) && in_array('phone', $show_contact)): ?>
                           <h5><a href="tel:<?php echo $phone_number; ?>" target="_blank" title="Call us"><?php echo $phone_number; ?></a></h5>
                        <?php endif; ?>
                        <?php if (!empty($email_address) && in_array('email', $show_contact)): ?>
                           <h5><a href="mailto:<?php echo $email_address; ?>" target="_blank" title="Email us"><?php echo $email_address; ?></a></h5>
                        <?php endif; ?>
                        <?php if (!empty($street_address) && in_array('address', $show_contact)): ?>
                           <?php if (!empty($google_maps_url)): ?>
                              <h5><a href="<?php echo $google_maps_url; ?>" target="_blank" title="Find us"><?php echo $street_address; ?></a></h5>
                           <?php else: ?>
                              <h5><?php echo $street_address; ?></h5>
                           <?php endif; ?>
                        <?php endif; ?>
                     <?php endif; ?>
                  </div>
                  <div class="contact-form">
                     <?php echo do_shortcode('[gravityform id="'.$form_id.'" title="false" description="false" ajax="true"]'); ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
   <?php else: ?><p style="text-align: center;">No preview available.</p><?php endif; ?>
<?php endif; ?>
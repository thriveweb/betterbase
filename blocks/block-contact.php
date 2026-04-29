<?php if (isset($block['data']['has_preview']) && $block['data']['has_preview']): ?>
    <img src="<?php echo get_template_directory_uri(); ?>/blocks/preview/block-contact.jpg" class="acf_pre" style="width: 100%;">
<?php else:
    $classes = 'block-contact';
    $classes .= (isset($block['className']) ? ' '.$block['className'] : '');
    $anchor = (isset($block['anchor']) ? $block['anchor'] : '');
    $background = (isset($block['settings_background_colour']) ? $block['settings_background_colour'] : 'none');
    $container = (isset($block['settings_container']) ? $block['settings_container'] : 'md');
    $padding_top = (isset($block['settings_padding_top']) ? $block['settings_padding_top'] : '80');
    $padding_bottom = (isset($block['settings_padding_bottom']) ? $block['settings_padding_bottom'] : '80');

    $title = get_field('block_title');
    $description = get_field('block_description');
    $show_contact = get_field('block_show_contact');
    $form_id = get_field('block_form_id');

    $phone_number = get_field('phone_number', 'options');
    $email_address = get_field('email_address', 'options');
    $street_address = get_field('street_address', 'options');
    $google_maps_url = get_field('google_maps_url', 'options');
    $add_social_media = get_field('add_social_media', 'options');

    if (!empty($form_id)): ?>
        <div class="betterbase-theme <?php echo $classes; ?>" <?php echo ($anchor ? 'id="'.$anchor.'"' : ''); ?>>
            <div class="block-setting-padding block-setting-background-colour" style="--block-padding-top: <?php echo $padding_top; ?>px; --block-padding-bottom: <?php echo $padding_bottom; ?>px; --block-background-colour: var(--<?php echo $background; ?>);">
                <div class="container-<?php echo $container; ?> <?php echo get_text_colour($background); ?>">
                    <div class="grid-col-2">
                        <div class="col-1">
                            <div class="wysiwyg-content">
                                <?php if (!empty($title)): ?>
                                    <h3><?php echo $title; ?></h3>
                                <?php endif; ?>
                                <?php if (!empty($description)): ?>
                                    <p><?php echo $description; ?></p>
                                <?php endif; ?>
                                <?php if (!empty($show_contact)): ?>
                                    <?php if (!empty($phone_number) && in_array('phone', $show_contact)): ?>
                                        <div class="entry-contact-detail">
                                            <div class="inner-entry-content">
                                                <h5><a href="tel:<?php echo $phone_number; ?>" target="_blank" title="Call us"><?php echo $phone_number; ?></a></h5>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($email_address) && in_array('email', $show_contact)): ?>
                                        <div class="entry-contact-detail">
                                            <div class="inner-entry-content">
                                                <h5><a href="mailto:<?php echo $email_address; ?>" target="_blank" title="Email us"><?php echo $email_address; ?></a></h5>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($street_address) && in_array('address', $show_contact)): ?>
                                        <div class="entry-contact-detail">
                                            <div class="inner-entry-content">
                                                <h5><?php echo $street_address; ?></h5>
                                                <?php if (!empty($google_maps_url)): ?>
                                                    <p><a href="<?php echo $google_maps_url; ?>" target="_blank" title="Get directions">Get directions</a></p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($add_social_media) && in_array('social', $show_contact)): ?>
                                        <?php include(get_template_directory().'/parts/social-media.php'); ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-2">
                            <?php echo do_shortcode('[gravityform id="'.$form_id.'"]'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?><p style="text-align: center;">No preview available.</p><?php endif; ?>
<?php endif; ?>
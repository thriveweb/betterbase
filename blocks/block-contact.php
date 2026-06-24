<?php if (isset($block['data']['preview_image']) && $block['data']['preview_image']): ?>
    <img src="<?php echo get_template_directory_uri(); ?>/blocks/preview/<?php echo $block['data']['preview_image']; ?>" style="width: 100%; height: auto; display: block;">
<?php else:
    $block_name = 'block-contact';
    $block_classes = ['betterbase-theme', $block_name, $block['className'] ?? null];
    $block_anchor = $block['anchor'] ?? '';
    $block_css = $block['css'] ?? '';
    $padding_top = $block['settings_padding_top'] ?? '80';
    $padding_bottom = $block['settings_padding_bottom'] ?? '80';
    $background_color = $block['settings_background_color'] ?? 'none';
    $container = $block['settings_container'] ?? 'md';
    $setting_classes = ['block-setting-padding', 'block-setting-background-color'];
    $setting_styles = ['--block-padding-top: '.$padding_top.'px', '--block-padding-bottom: '.$padding_bottom.'px', '--block-background-color: var(--'.$background_color.')'];

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
        <div class="<?php echo implode(' ', array_filter($block_classes)); ?>" <?php echo ($block_anchor ? 'id="'.esc_attr($block_anchor).'"' : ''); ?> <?php echo ($block_css ? 'style="'.esc_attr($block_css).'"' : ''); ?>>
            <div class="<?php echo implode(' ', $setting_classes); ?>" style="<?php echo implode('; ', $setting_styles); ?>">
                <div class="container-<?php echo $container; ?> <?php echo get_text_colour($background_color); ?>">
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
                                                <h5><a href="tel:<?php echo esc_attr($phone_number); ?>" target="_blank" title="Call us"><?php echo $phone_number; ?></a></h5>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($email_address) && in_array('email', $show_contact)): ?>
                                        <div class="entry-contact-detail">
                                            <div class="inner-entry-content">
                                                <h5><a href="mailto:<?php echo esc_attr($email_address); ?>" target="_blank" title="Email us"><?php echo $email_address; ?></a></h5>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($street_address) && in_array('address', $show_contact)): ?>
                                        <div class="entry-contact-detail">
                                            <div class="inner-entry-content">
                                                <h5><?php echo $street_address; ?></h5>
                                                <?php if (!empty($google_maps_url)): ?>
                                                    <p><a href="<?php echo esc_url($google_maps_url); ?>" target="_blank" title="Get directions">Get directions</a></p>
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
    <?php else: get_empty_block_message(); endif; ?>
<?php endif; ?>
<?php
if (betterbase_block_preview($block)) {
    return;
}
extract(betterbase_block_settings($block));

$title = get_field('title');
$excerpt = get_field('excerpt');
$show_contact = get_field('show_contact');
$gravity_forms_id = get_field('gravity_forms_id');

$phone_number = get_field('phone_number', 'options');
$email_address = get_field('email_address', 'options');
$street_address = get_field('street_address', 'options');
$google_maps_url = get_field('google_maps_url', 'options');
$add_social_media = get_field('add_social_media', 'options');

if (!empty($gravity_forms_id)): ?>
    <div class="<?php echo esc_attr(implode(' ', array_filter($block_classes))); ?>" <?php echo ($block_anchor ? 'id="'.esc_attr($block_anchor).'"' : ''); ?> <?php echo ($block_css ? 'style="'.esc_attr($block_css).'"' : ''); ?>>
        <div class="<?php echo esc_attr(implode(' ', $setting_classes)); ?>" style="<?php echo esc_attr(implode('; ', $setting_styles)); ?>">
            <div class="container-<?php echo esc_attr($container); ?>">
                <div class="grid-col-2">
                    <div class="col-1 col-content">
                        <div class="wysiwyg-content <?php echo esc_attr(betterbase_get_text_color($background_color)); ?>">
                            <?php if (!empty($title)): ?>
                                <h3 class="h2"><?php echo esc_html($title); ?></h3>
                            <?php endif; ?>
                            <?php if (!empty($excerpt)): ?>
                                <p><?php echo esc_html($excerpt); ?></p>
                            <?php endif; ?>
                            <?php if (!empty($show_contact)): ?>
                                <?php if (!empty($phone_number) && in_array('phone', $show_contact)): ?>
                                    <div class="entry-contact-detail">
                                        <div class="inner-entry-content">
                                            <p class="text-size-large"><a href="tel:<?php echo esc_attr($phone_number); ?>" target="_blank" title="Call us"><?php echo esc_html($phone_number); ?></a></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($email_address) && in_array('email', $show_contact)): ?>
                                    <div class="entry-contact-detail">
                                        <div class="inner-entry-content">
                                            <p class="text-size-large"><a href="mailto:<?php echo esc_attr($email_address); ?>" target="_blank" title="Email us"><?php echo esc_html($email_address); ?></a></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($street_address) && in_array('address', $show_contact)): ?>
                                    <div class="entry-contact-detail">
                                        <div class="inner-entry-content">
                                            <p class="text-size-large"><?php echo esc_html($street_address); ?></p>
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
                    <div class="col-2 col-form">
                        <?php echo do_shortcode('[gravityform id="'.absint($gravity_forms_id).'"]'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else: betterbase_block_empty(); endif; ?>

<?php
$phone_number = get_field('phone_number', 'options');
$email_address = get_field('email_address', 'options');
$street_address = get_field('street_address', 'options');
$google_maps_url = get_field('google_maps_url', 'options');
$add_social_media = get_field('add_social_media', 'options');
$add_policy_link = get_field('add_policy_link', 'options');
$home_url = home_url('/');
$site_name = get_bloginfo('name');
?>

<footer class="site-footer">
    <div class="container-lg">
        <div class="footer-columns grid-col-3 padding-md">
            <div class="footer-logo">
                <a class="site-logo" href="<?php echo esc_url($home_url); ?>" title="<?php echo esc_attr($site_name); ?>">
                    <?php betterbase_include_asset('logo-betterbase.svg'); ?>
                </a>
            </div>
            <?php if (has_nav_menu('footer')): ?>
                <div class="footer-menu">
                    <h6><?php echo esc_html(wp_get_nav_menu_name('footer')); ?></h6>
                    <?php wp_nav_menu(array('theme_location' => 'footer', 'container' => false)); ?>
                </div>
            <?php endif; ?>
            <?php if (!empty($phone_number) || !empty($email_address) || !empty($street_address) || !empty($add_social_media)): ?>
                <div class="footer-contact">
                    <h6>Contact</h6>
                    <?php if (!empty($phone_number) || !empty($email_address) || !empty($street_address)): ?>
                        <ul>
                            <?php if (!empty($phone_number)): ?>
                                <li><a href="tel:<?php echo esc_attr($phone_number); ?>" target="_blank" title="Call us"><?php echo esc_html($phone_number); ?></a></li>
                            <?php endif; ?>
                            <?php if (!empty($email_address)): ?>
                                <li><a href="mailto:<?php echo esc_attr($email_address); ?>" target="_blank" title="Email us"><?php echo esc_html($email_address); ?></a></li>
                            <?php endif; ?>
                            <?php if (!empty($street_address) && !empty($google_maps_url)): ?>
                                <li><a href="<?php echo esc_url($google_maps_url); ?>" target="_blank" title="Visit us"><?php echo esc_html($street_address); ?></a></li>
                            <?php elseif (!empty($street_address)): ?>
                                <li><?php echo esc_html($street_address); ?></li>
                            <?php endif; ?>
                        </ul>
                    <?php endif; ?>
                    <?php include get_template_directory() . '/parts/social-media.php'; ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="footer-copyright padding-sm-bot">
            <div class="flex-layout flex-align-center flex-justify-between flex-gap">
                <p class="text-size-small"><a href="<?php echo esc_url($home_url); ?>" title="<?php echo esc_attr($site_name); ?>"><?php echo esc_html($site_name); ?></a> &copy; <?php echo esc_html(wp_date('Y')); ?></p>
                <?php if (!empty($add_policy_link)): ?>
                    <p class="footer-policies text-size-small">
                        <?php $i = 0; foreach ($add_policy_link as $policy): ?>
                            <?php if (empty($policy['link']['url']) || empty($policy['link']['title'])) { continue; } $i++; ?>
                            <?php if ($i > 1): ?>
                                &nbsp;<span>|</span>&nbsp;
                            <?php endif; ?>
                            <a href="<?php echo esc_url($policy['link']['url']); ?>" target="<?php echo esc_attr($policy['link']['target'] ?: '_self'); ?>" title="<?php echo esc_attr($policy['link']['title']); ?>"><?php echo esc_html($policy['link']['title']); ?></a>
                        <?php endforeach; ?>
                    </p>
                <?php endif; ?>
                <p class="text-size-small">Site by <a href="https://thriveweb.com.au" target="_blank" title="Thrive Digital Web Design & Development Gold Coast">Thrive</a></p>
            </div>
        </div>
    </div>
</footer>

</main>

<div class="site-popups"></div>

<?php wp_footer(); ?>

</body>
</html>

<?php 
$phone_number = get_field('phone_number', 'options');
$email_address = get_field('email_address', 'options');
$street_address = get_field('street_address', 'options');
$google_maps_url = get_field('google_maps_url', 'options');
$add_social_media = get_field('add_social_media', 'options');
$add_policy_link = get_field('add_policy_link', 'options'); ?>

<footer class="site-footer">
    <div class="container-lg padding-md">
        <div class="footer-columns grid-col-3">
            <div class="footer-logo">
                <a class="site-logo" href="<?php echo get_bloginfo('url'); ?>" title="<?php echo get_bloginfo('name'); ?>">
                    <?php include_asset('logo-theme.svg'); ?>
                </a>
            </div>
            <?php if (has_nav_menu('footer')): ?>
                <div class="footer-menu">
                    <h6><?php echo wp_get_nav_menu_name('footer'); ?></h6>
                    <?php wp_nav_menu(array('theme_location' => 'footer', 'container' => false)); ?>
                </div>
            <?php endif; ?>
            <?php if (!empty($phone_number) || !empty($email_address) || !empty($street_address) || !empty($add_social_media)): ?>
                <div class="footer-contact">
                    <h6>Contact</h6>
                    <ul>
                        <?php if (!empty($phone_number)): ?>
                            <li><a href="tel:<?php echo $phone_number; ?>" target="_blank" title="Call us"><?php echo $phone_number; ?></a></li>
                        <?php endif; ?>
                        <?php if (!empty($email_address)): ?>
                            <li><a href="mailto:<?php echo $email_address; ?>" target="_blank" title="Email us"><?php echo $email_address; ?></a></li>
                        <?php endif; ?>
                        <?php if (!empty($street_address) && !empty($google_maps_url)): ?>
                            <li><a href="<?php echo $google_maps_url; ?>" target="_blank" title="Visit us"><?php echo $street_address; ?></a></li>
                        <?php elseif (!empty($street_address)): ?>
                            <li><?php echo $street_address; ?></li>
                        <?php endif; ?>
                        <?php include(get_template_directory().'/parts/social-media.php'); ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="footer-copyright padding-sm">
        <div class="container-lg flex-layout flex-align-center flex-justify-between flex-gap">
            <p class="text-small"><a href="<?php echo get_bloginfo('url'); ?>" title="<?php echo get_bloginfo('name'); ?>"><?php echo get_bloginfo('name'); ?></a> &copy; <?php echo date('Y'); ?></p>
            <?php if (!empty($add_policy_link)): ?>
                <p class="footer-policies text-small">
                    <?php $i = 0; foreach ($add_policy_link as $policy): $i++; ?>
                        <a href="<?php echo $policy['link']['url']; ?>" target="<?php echo $policy['link']['target']; ?>" title="<?php echo $policy['link']['title']; ?>"><?php echo $policy['link']['title']; ?></a>
                        <?php if ($i < count($add_policy_link)): ?>
                            &nbsp;<span>|</span>&nbsp;
                        <?php endif; ?>
                    <?php endforeach; ?>
                </p>
            <?php endif; ?>
            <p class="text-small">Site by <a href="https://thriveweb.com.au" target="_blank" title="Thrive Digital Web Design & Development Gold Coast">Thrive</a></p>
        </div>
    </div>
</footer>

</main>

<div class="site-popups"></div>

<?php wp_footer(); ?>

</body>
</html>

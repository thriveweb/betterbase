<?php 
$phone_number = get_field('phone_number', 'options');
$email_address = get_field('email_address', 'options');
$street_address = get_field('street_address', 'options');
$google_maps_url = get_field('google_maps_url', 'options');
$add_social_media = get_field('add_social_media', 'options');
$footer_message = get_field('footer_message', 'options'); ?>

<footer class="site-footer">
   <div class="container-lg padding-md">
      <div class="footer-columns grid-col-3">
         <div class="footer-logo">
            <a class="site-logo" href="<?php echo get_bloginfo('url'); ?>" title="<?php echo get_bloginfo('name'); ?>">
               <?php include_asset('logo-betterbase.svg'); ?>
            </a>
         </div>
         <?php if (has_nav_menu('footer')): ?>
            <div class="footer-menu">
               <h6><?php echo wp_get_nav_menu_name('footer'); ?></h6>
               <?php wp_nav_menu(array('theme_location' => 'footer', 'container' => false)); ?>
            </div>
         <?php endif; ?>
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
      </div>
   </div>
   <div class="footer-copyright padding-sm">
      <div class="container-lg flex-layout flex-align-center flex-justify-between flex-gap">
         <p><a href="<?php echo get_bloginfo('url'); ?>" title="<?php echo get_bloginfo('name'); ?>"><?php echo get_bloginfo('name'); ?></a> &copy; <?php echo date('Y'); ?></p>
         <p>Site by <a href="https://thriveweb.com.au" target="_blank" title="Thrive Digital Web Design & Development Gold Coast">Thrive Digital</a></p>
      </div>
   </div>
</footer>

</main>

<div class="site-popups"></div>

<?php wp_footer(); ?>

</body>
</html>

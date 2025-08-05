<?php


/*-----------------------------------------------------------------------
   Conditional IE HTML5
-----------------------------------------------------------------------*/

function conditional_ie_html5 () {
   global $is_IE;
   if ($is_IE){
      echo '<!--[if lt IE 9]>';
      echo '<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>';
      echo '<![endif]-->';
   }
}
add_action('wp_head', 'conditional_ie_html5');

/*-----------------------------------------------------------------------
   Check for robots
-----------------------------------------------------------------------*/

function no_robots_notice() {
   if (!get_option('blog_public')) {
      echo '<div class="error"><p>Search engines are blocked</p></div>';
   }
}
add_action('admin_notices', 'no_robots_notice');

/*-----------------------------------------------------------------------
   No pingbacks
-----------------------------------------------------------------------*/

add_filter('xmlrpc_methods', function($methods) {
   unset($methods['pingback.ping']);
   return $methods;
});

/*-----------------------------------------------------------------------
   Remove title prefix
-----------------------------------------------------------------------*/

function remove_protected_text() {
   return __('%s');
}
add_filter('protected_title_format', 'remove_protected_text');

/*-----------------------------------------------------------------------
   PHP Console log
-----------------------------------------------------------------------*/

function console_log($data) {
   echo '<script>';
   echo 'console.log("PHP", '.json_encode($data).')';
   echo '</script>';
}

/*-----------------------------------------------------------------------
   Fix SSL attachment URL
-----------------------------------------------------------------------*/

function fix_ssl_attachment_url($url) {
   if (is_ssl()) {
      $url = str_replace('http://', 'https://', $url);
      return $url;
   }
}
add_filter('wp_get_attachment_url', 'fix_ssl_attachment_url');

/*---------------------------------------------------------------------------
   Customise login page
---------------------------------------------------------------------------*/

function set_login_page_title() {
   return get_bloginfo('title');
}
add_filter('login_headertext', 'set_login_page_title');

function set_login_title_url() {
   return home_url();
}
add_filter('login_headerurl', 'set_login_title_url');

/*-----------------------------------------------------------------------
   Check and include asset if it exists
-----------------------------------------------------------------------*/

function include_asset($src) {
   if (strpos($src, '/assets/img/') === false) {
      $src = '/assets/img/' . $src;
   }

   $file_path = get_template_directory() . $src;

   if (file_exists($file_path)) {
      include $file_path;
   }
}

/*-----------------------------------------------------------------------
   Disable anchor scroll (Gravity Forms)
-----------------------------------------------------------------------*/

add_filter('gform_confirmation_anchor', '__return_false');

/*-----------------------------------------------------------------------
   Rename default page template
-----------------------------------------------------------------------*/

add_filter('default_page_template_title', function() {
   return __('Default');
});

/*-----------------------------------------------------------------------
   Check if WooCommerce is active
-----------------------------------------------------------------------*/

function is_active_woocommerce() {
   return class_exists('WooCommerce');
}

/*-----------------------------------------------------------------------
   Add active class for post type archive pages
-----------------------------------------------------------------------*/

function enable_active_state_archive_menu_links($classes = array(), $menu_item = false) {
   global $post;
   $current_ID = (isset( $post->ID ) ? get_the_ID() : NULL);

   if (isset($current_ID)){
      $classes[] = ($menu_item->url == get_post_type_archive_link($post->post_type)) ? 'current-menu-item' : '';
   }

   return $classes;
}
add_filter('nav_menu_css_class', 'enable_active_state_archive_menu_links', 10, 2);

/*-----------------------------------------------------------------------
   Customised search form output
-----------------------------------------------------------------------*/

function customised_wp_search_form($form) {
   $form = '<form role="search" method="get" id="searchform" class="search-form" action="'.home_url('/').'">
      <label class="screen-reader-text" for="s">Search for</label>
      <input type="text" value="'.get_search_query().'" name="s" id="s" placeholder="Search for something..." />
      <button type="submit">Search</button>
   </form>';

   return $form;
}
add_filter('get_search_form', 'customised_wp_search_form');

/*-----------------------------------------------------------------------
   Responsive content embeds (iframe)
-----------------------------------------------------------------------*/

add_filter('embed_oembed_html', function ($html, $url, $attr, $post_id) {
   if (strpos($html, 'youtube.com') !== false || strpos($html, 'youtu.be') !== false || strpos($html, 'player.vimeo') !== false) {
      return '<div class="responsive-embed">' . $html . '</div>';
   } else {
      return $html;
   }
}, 10, 4);

/*-----------------------------------------------------------------------
   Autoresize WYSIWYG editor based on content
-----------------------------------------------------------------------*/

function resize_tinymce_wysiwyg_area() {  ?>
   <script>
      acf.add_filter('wysiwyg_tinymce_settings', function(mceInit, id, $field) {
         mceInit.wp_autoresize_on = true;
         return mceInit;
      });
   </script>
<?php }
add_action('acf/input/admin_footer', 'resize_tinymce_wysiwyg_area');

/*-----------------------------------------------------------------------
   Tidy admin bar
-----------------------------------------------------------------------*/

add_action('wp_before_admin_bar_render', function() {
   global $wp_admin_bar;
   $wp_admin_bar->remove_node('wp-logo');
   $wp_admin_bar->remove_node('customize');
   $wp_admin_bar->remove_node('updates');
   $wp_admin_bar->remove_menu('comments');
   $wp_admin_bar->remove_node('search');
   $wp_admin_bar->remove_node('gform-forms');
   $wp_admin_bar->remove_node('wpseo-menu');
   $wp_admin_bar->remove_node('password_protected');
   $wp_admin_bar->remove_menu('itsec_admin_bar_menu');
}, 999);

/*-----------------------------------------------------------------------
   Tidy user profile pages
-----------------------------------------------------------------------*/

function remove_profile_fields() { ?>
   <style>
      #your-profile h2,
      #your-profile .application-passwords,
      #your-profile tr.user-syntax-highlighting-wrap,
      #your-profile tr.user-admin-color-wrap,
      #your-profile tr.user-rich-editing-wrap,
      #your-profile tr.user-comment-shortcuts-wrap,
      #your-profile tr.user-profile-picture,
      #your-profile tr.user-sessions-wrap,
      #your-profile tr.user-description-wrap,
      #your-profile tr.user-aim-wrap,
      #your-profile tr.user-yim-wrap,
      #your-profile tr.user-jabber-wrap,
      #your-profile tr.user-facebook-wrap,
      #your-profile tr.user-instagram-wrap,
      #your-profile tr.user-linkedin-wrap,
      #your-profile tr.user-myspace-wrap,
      #your-profile tr.user-pinterest-wrap,
      #your-profile tr.user-soundcloud-wrap,
      #your-profile tr.user-tumblr-wrap,
      #your-profile tr.user-twitter-wrap,
      #your-profile tr.user-youtube-wrap,
      #your-profile tr.user-wikipedia-wrap,
      #your-profile .yoast-settings{
         display: none;
      }

      #your-profile tr .description{
         color: #646970;
      }

      #your-profile td .description{
         display: block;
         margin-top: 5px;
         font-size: 12px;
      }
   </style>
<?php }
add_action('admin_head-user-edit.php', 'remove_profile_fields');
add_action('admin_head-profile.php', 'remove_profile_fields');

/*-----------------------------------------------------------------------
   Register user manual
-----------------------------------------------------------------------*/

function init_user_manual() { ?>
   <style media="screen">
      .user-manual {
         width: 90%;
         height: 100%;
      }
      iframe {
         position: absolute;
         top:0;
         left: 0;
         width: 100%;
         height: calc(100vh - 90px);
      }
   </style>
   <div class="user-manual">
      <iframe src="/user-manual/" width="100%" height="100%"></iframe>
   </div>
<?php }

function register_user_manual() {
   add_menu_page(
      __('User Manual'),
      'User Manual',
      'manage_options',
      'user-manual',
      'init_user_manual',
      'dashicons-sos',
      3
   );
}
add_action('admin_menu', 'register_user_manual');

/*-----------------------------------------------------------------------
   Add Thrive Digital credits
-----------------------------------------------------------------------*/

function thrive_credit_admin_footer() {
   echo 'By <a href="http://thriveweb.com.au/" title="Thrive Digital Web Design & Development Gold Coast">Thrive Digital</a><br>';
}
add_filter('admin_footer_text', 'thrive_credit_admin_footer');

function thrive_credit_console() {
   if (is_front_page()) { ?>
      <script type="text/javascript">
         console.log(`
            .   oooo
         .o8   '888
         .o888oo  888 .oo.   ooood8b  ooo  ooo   ooo   .ooooo.
         888    888P"Y88b  '888'8P  888  '88.  .8'  d88' '88b
         888    888   888   888     888   '88..8'   888ooo888
         888 .  888   888   888     888    '888'    888    .o
         "888" o888o o888o d888b   o888o    '8'     'Y8bod8P'

                     Built by Thrive Digital
         `);
      </script>
   <?php }
}
add_action('wp_footer', 'thrive_credit_console');
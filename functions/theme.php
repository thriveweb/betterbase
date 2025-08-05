<?php

/*-----------------------------------------------------------------------
   Init custom theme support
-----------------------------------------------------------------------*/

function betterbase_theme_support() {
   add_theme_support('title-tag');
   add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'betterbase_theme_support');

/* Disable post type support for comments */

function betterbase_disable_post_support() {
   foreach (get_post_types() as $post_type) {
      remove_post_type_support($post_type, 'comments');
   }
}
add_action('admin_init', 'betterbase_disable_post_support');
add_filter('pings_open', '__return_false', 20, 2);
add_filter('comments_open', '__return_false', 20, 2);
add_filter('comments_array', '__return_empty_array', 10, 2);

/*-----------------------------------------------------------------------
   Register custom menus
-----------------------------------------------------------------------*/

function betterbase_register_menus() {
   register_nav_menu('header', 'Header Menu');
      register_nav_menu('footer', 'Footer Menu');
   }
add_action('init', 'betterbase_register_menus');

/*-----------------------------------------------------------------------
   Customise login page logo
-----------------------------------------------------------------------*/

function init_custom_login_logo() { ?>
   <style type="text/css">
      #login h1 a {
         background-image: url('<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/img/logo-betterbase.svg'); ?>');
         background-size: contain;
         width: 100%;
         height: 80px;
      }
   </style>
<?php }
add_action('login_enqueue_scripts', 'init_custom_login_logo');

/*-----------------------------------------------------------------------
   Tidy admin dashboard menu
-----------------------------------------------------------------------*/

function tidy_dashboard_menu_ordering($menu_ord) {
   if (!$menu_ord) return true;

   return array(
      'index.php', // Dashboard
      'user-manual', // User Manual
      'acf-options-global-options', // ACF Options
      
      'separator1', // First separator

      'upload.php', // Media
      'gf_edit_forms', // Gravity Forms
      'edit.php', // Posts
      'edit.php?post_type=page', // Pages
      'edit.php?post_type=service', // CPT: Services
      'edit.php?post_type=review', // CPT: Reviews

      'woocommerce', // WooCommerce
      'product', // Products
      'admin.php?page=wc-settings&tab=checkout', // Payments
      'woocommerce-marketing', // Marketing
      'wc-admin&path=/analytics/overview', // Analytics
      'jetpack', // Jetpack
      
      'separator2', // Second separator
      
      'options-general.php', // Settings
      'themes.php', // Appearance
      'plugins.php', // Plugins
      'users.php', // Users
      'tools.php', // Tools

      'separator-last', // Last separator
      
      'edit.php?post_type=acf-field-group', // ACF
      'itsec', // Security
      'wpseo_dashboard', // Yoast SEO
   );
}
add_filter('menu_order', 'tidy_dashboard_menu_ordering', 10, 1);
add_filter('custom_menu_order', 'tidy_dashboard_menu_ordering', 10, 1);

function betterbase_remove_dashboard_items() {
   remove_menu_page('edit-comments.php'); // Comments
   remove_menu_page('password-protected'); // Password Protected
   remove_menu_page('options-general.php?page=updraftplus'); // UpdraftPlus
   remove_menu_page('wsal-auditlog'); // WP Activity Log
}
add_action('admin_menu', 'betterbase_remove_dashboard_items', 100);

/*-----------------------------------------------------------------------
   Customised menu output
-----------------------------------------------------------------------*/

function add_menu_icon_to_parent_link($items, $args) {
   if ($args->theme_location == 'header') {
      foreach ($items as &$item) {
         if (in_array('menu-item-has-children', $item->classes)) {
            ob_start();
            echo '<span class="trigger-sub-menu">';
            include_asset('icon-plus.svg');
            echo '</span>';
            $item->title .= ob_get_clean();
         }
      }
   }
   return $items;
}
add_filter('wp_nav_menu_objects', 'add_menu_icon_to_parent_link', 10, 2);

class Submenu_Wrap extends Walker_Nav_Menu {
   function start_lvl(&$output, $depth = 0, $args = array()) {
      $indent = str_repeat("\t", $depth);
      $output .= "\n$indent<div class='sub-menu-wrap'><ul class='sub-menu'>\n";
   }
   function end_lvl(&$output, $depth = 0, $args = array()) {
      $indent = str_repeat("\t", $depth);
      $output .= "$indent</ul></div>\n";
   }
}

/*-----------------------------------------------------------------------
   Change text colour class based on background colour
-----------------------------------------------------------------------*/

function get_text_colour($background_color) {
   $array = array('black');
   return (in_array($background_color, $array) ? 'text-white' : 'text-default');
}

/*-----------------------------------------------------------------------
   Add custom colour options to WYSIWYG editor
-----------------------------------------------------------------------*/

function betterbase_mce_text_colours($init) {
   $custom_colours = '
      "000000", "Black",
      "838383", "Grey",
   ';

   $init['textcolor_map'] = '['.$custom_colours.']';
   return $init;
}
add_filter('tiny_mce_before_init', 'betterbase_mce_text_colours');

/*---------------------------------------------------------------------------
   Add custom format options to WYSIWYG editor
---------------------------------------------------------------------------*/

function betterbase_add_format_buttons($buttons) {
   array_unshift($buttons, 'styleselect');
   return $buttons;
}
add_filter('mce_buttons_2', 'betterbase_add_format_buttons');

function betterbase_custom_wysiwyg_formats($init_array) {
   $style_formats = array(
      array(
         'title' => 'List Style: Checkmark',
         'classes' => 'list-style-checkmark',
         'selector' => 'ul',
      ),
   );
   $init_array['style_formats'] = json_encode($style_formats);
   return $init_array;
}
add_filter('tiny_mce_before_init', 'betterbase_custom_wysiwyg_formats');

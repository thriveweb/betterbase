<?php

/*-----------------------------------------------------------------------
   Enqueue theme scripts and styles
-----------------------------------------------------------------------*/

function init_uncached_theme_scripts(){
   wp_enqueue_script('jquery');

   // wp_enqueue_style('aos-css', get_stylesheet_directory_uri().'/assets/aos/aos.css', null, filemtime(get_stylesheet_directory().'/assets/aos/aos.css'));
   // wp_enqueue_script('aos-js', get_stylesheet_directory_uri().'/assets/aos/aos.js', null, filemtime(get_stylesheet_directory().'/assets/aos/aos.js'));

   wp_enqueue_style('style-css', get_stylesheet_directory_uri().'/style.css', null, filemtime(get_stylesheet_directory().'/style.css'));

   wp_enqueue_script('theme-js', get_stylesheet_directory_uri().'/assets/js/theme.js', null, filemtime(get_stylesheet_directory().'/assets/js/theme.js'));
   wp_localize_script('theme-js', 'theme_ajax', array('url' => admin_url('admin-ajax.php'), 'token' => wp_create_nonce('bones_nonce')));
}
add_action('wp_enqueue_scripts', 'init_uncached_theme_scripts');

/*-----------------------------------------------------------------------
   Enqueue block scripts and styles
-----------------------------------------------------------------------*/

function init_uncached_block_scripts(){
   wp_enqueue_script('jquery');

   wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), '11');
   wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), '11');

   wp_enqueue_style('theme-css', get_stylesheet_directory_uri().'/assets/css/theme.css', null, filemtime(get_stylesheet_directory().'/assets/css/theme.css'));

   wp_enqueue_script('blocks-js', get_stylesheet_directory_uri().'/assets/js/blocks.js', array('wp-blocks', 'wp-dom-ready', 'wp-plugins', 'wp-edit-post', 'wp-element', 'wp-components', 'wp-data'), filemtime(get_stylesheet_directory().'/assets/js/blocks.js'));
}
add_action('enqueue_block_assets', 'init_uncached_block_scripts');

/*-----------------------------------------------------------------------
   Enqueue admin editor scripts and styles
-----------------------------------------------------------------------*/

add_editor_style(get_stylesheet_directory_uri() . '/assets/css/wysiwyg.css?v=' . filemtime(get_stylesheet_directory() . '/assets/css/wysiwyg.css'));

/*-----------------------------------------------------------------------
   Admin CSS tweaks
-----------------------------------------------------------------------*/

function init_admin_styles() { ?>
   <style type="text/css">
      #no-label > .acf-label label,
      .postbox-header a.acf-hndle-cog {
         display: none !important;
      }
      .postbox-header {
         text-transform: capitalize;
      }
      .acf-input select {
         max-width: 100%;
      }
      #adminmenu li.wp-menu-separator {
         height: 1px;
         margin: 8px;
         background: #333;
      }
   </style>
<?php }
add_action('admin_head', 'init_admin_styles');
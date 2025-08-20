<?php

/*-----------------------------------------------------------------------
   Register ACF options page
-----------------------------------------------------------------------*/

if (function_exists('acf_add_options_page')) {
   $parent = acf_add_options_page(array(
      'page_title'  => __('Global Options'),
      'menu_title'  => __('Global Options'),
      'redirect'    => false,
   ));
}

/*-----------------------------------------------------------------------
   Register block categories
-----------------------------------------------------------------------*/

function acf_create_custom_block_categories($categories, $post) {
   $custom_categories = array(
      array(
         'slug'  => 'general',
         'title' => 'General',
         'icon'  => 'dashicons-block-default',
      ),
   );
   return array_merge($categories, $custom_categories);
}
add_filter('block_categories_all', 'acf_create_custom_block_categories', 10, 2);

/*-----------------------------------------------------------------------
   Register ACF blocks
-----------------------------------------------------------------------*/

function acf_register_custom_blocks() {

   /* Content */

   acf_register_block_type(array(
      'name' => 'block-content',
      'title' => __('Content'),
      'description' => __('Use the WYSIWYG editor to create and format content.'),
      'keywords' => array('content', 'wysiwyg'),
      'render_template' => 'blocks/block-content.php',
      'category' => 'general',
      'icon' => 'editor-paragraph',
      'mode' => 'edit',
      'supports' => array('anchor' => true, 'align' => false),
      'validation' => true,
      'example' => array(
         'attributes' => array(
            'mode' => 'preview',
            'data' => array(
               'has_preview' => true,
               'preview_image_help' => '',
            ),
         ),
      ),
   ));

   /* Multicolumn */

   acf_register_block_type(array(
      'name' => 'block-multicolumn',
      'title' => __('Multicolumn'),
      'description' => __('Multicolumn layout with WYSIWYG editor and optional buttons.'),
      'keywords' => array('content', 'wysiwyg', 'image', 'column'),
      'render_template' => 'blocks/block-multicolumn.php',
      'category' => 'general',
      'icon' => 'columns',
      'mode' => 'edit',
      'supports' => array('anchor' => true, 'align' => false),
      'validation' => true,
   ));

   /* Buttons */

   acf_register_block_type(array(
      'name' => 'block-buttons',
      'title' => __('Buttons'),
      'description' => __('Repeatable button fields.'),
      'keywords' => array('button'),
      'render_template' => 'blocks/block-buttons.php',
      'category' => 'general',
      'icon' => 'button',
      'mode' => 'edit',
      'supports' => array('anchor' => true, 'align' => false),
      'validation' => true,
      'example' => array(
         'attributes' => array(
            'mode' => 'preview',
            'data' => array(
               'has_preview' => true,
               'preview_image_help' => '',
            ),
         ),
      ),
   ));

   /* Accordion */

   acf_register_block_type(array(
      'name' => 'block-accordion',
      'title' => __('Accordion'),
      'description' => __('Repeatable accordion fields for additional information.'),
      'keywords' => array('accordion', 'faq', 'content'),
      'render_template' => 'blocks/block-accordion.php',
      'category' => 'general',
      'icon' => 'align-center',
      'mode' => 'edit',
      'supports' => array('anchor' => true, 'align' => false),
      'validation' => true,
      'example' => array(
         'attributes' => array(
            'mode' => 'preview',
            'data' => array(
               'has_preview' => true,
               'preview_image_help' => '',
            ),
         ),
      ),
   ));

   /* Image Gallery */

   acf_register_block_type(array(
      'name' => 'block-image-gallery',
      'title' => __('Image Gallery'),
      'description' => __('Sliding image gallery.'),
      'keywords' => array('carousel', 'image', 'gallery', 'slider'),
      'render_template' => 'blocks/block-image-gallery.php',
      'category' => 'general',
      'icon' => 'format-gallery',
      'mode' => 'edit',
      'supports' => array('anchor' => true, 'align' => false),
      'validation' => true,
      'example' => array(
         'attributes' => array(
            'mode' => 'preview',
            'data' => array(
               'has_preview' => true,
               'preview_image_help' => '',
            ),
         ),
      ),
   ));

   /* Video */

   acf_register_block_type(array(
      'name' => 'block-video',
      'title' => __('Video'),
      'description' => __('Embed or upload a video.'),
      'keywords' => array('video', 'embed'),
      'render_template' => 'blocks/block-video.php',
      'category' => 'general',
      'icon' => 'video-alt2',
      'mode' => 'edit',
      'supports' => array('anchor' => true, 'align' => false),
      'validation' => true,
      'example' => array(
         'attributes' => array(
            'mode' => 'preview',
            'data' => array(
               'has_preview' => true,
               'preview_image_help' => '',
            ),
         ),
      ),
   ));

   /* Separator */

   acf_register_block_type(array(
      'name' => 'block-separator',
      'title' => __('Separator'),
      'description' => __(''),
      'keywords' => array('separator', 'break'),
      'render_template' => 'blocks/block-separator.php',
      'category' => 'general',
      'icon' => 'minus',
      'mode' => 'preview',
      'supports' => array('anchor' => true, 'align' => false),
      'validation' => true,
   ));

   /* Hero Banner */

   acf_register_block_type(array(
      'name' => 'block-hero-banner',
      'title' => __('Hero Banner'),
      'description' => __('Large hero banner with WYSIWYG editor, buttons, and background image.'),
      'keywords' => array('banner', 'hero', 'image', 'wysiwyg'),
      'render_template' => 'blocks/block-hero-banner.php',
      'category' => 'general',
      'icon' => 'welcome-view-site',
      'mode' => 'preview',
      'supports' => array('anchor' => true, 'align' => false),
      'validation' => true,
      'example' => array(
         'attributes' => array(
            'mode' => 'preview',
            'data' => array(
               'has_preview' => true,
               'preview_image_help' => '',
            ),
         ),
      ),
   ));

   /* Page Banner */

   acf_register_block_type(array(
      'name' => 'block-page-banner',
      'title' => __('Page Banner'),
      'description' => __('Internal page banner with title and background image.'),
      'keywords' => array('banner', 'inner', 'image'),
      'render_template' => 'blocks/block-page-banner.php',
      'category' => 'general',
      'icon' => 'welcome-view-site',
      'mode' => 'preview',
      'supports' => array('anchor' => true, 'align' => false),
      'validation' => true,
      'example' => array(
         'attributes' => array(
            'mode' => 'preview',
            'data' => array(
               'has_preview' => true,
               'preview_image_help' => '',
            ),
         ),
      ),
   ));

   /* Split Content */

   acf_register_block_type(array(
      'name' => 'block-split-content',
      'title' => __('Split Content'),
      'description' => __('Two column layout with image and WYSIWYG editor options.'),
      'keywords' => array('columns', 'image', 'content', 'split', 'wysiwyg'),
      'render_template' => 'blocks/block-split-content.php',
      'category' => 'general',
      'icon' => 'align-left',
      'mode' => 'edit',
      'supports' => array('anchor' => true, 'align' => false),
      'validation' => true,
      'example' => array(
         'attributes' => array(
            'mode' => 'preview',
            'data' => array(
               'has_preview' => true,
               'preview_image_help' => '',
            ),
         ),
      ),
   ));

   /* Reviews */

   acf_register_block_type(array(
      'name' => 'block-reviews',
      'title' => __('Reviews'),
      'description' => __('Carousel displaying selected reviews.'),
      'keywords' => array('carousel', 'review', 'feed'),
      'render_template' => 'blocks/block-reviews.php',
      'category' => 'general',
      'icon' => 'admin-comments',
      'mode' => 'edit',
      'supports' => array('anchor' => true, 'align' => false),
      'validation' => true,
      'example' => array(
         'attributes' => array(
            'mode' => 'preview',
            'data' => array(
               'has_preview' => true,
               'preview_image_help' => '',
            ),
         ),
      ),
   ));

   /* Counter */

   acf_register_block_type(array(
      'name' => 'block-counter',
      'title' => __('Counter'),
      'description' => __('Animated counting numbers to show your metrics.'),
      'keywords' => array('number', 'statistics', 'counter'),
      'render_template' => 'blocks/block-counter.php',
      'category' => 'general',
      'icon' => 'chart-bar',
      'mode' => 'edit',
      'supports' => array('anchor' => true, 'align' => false),
      'validation' => true,
      'example' => array(
         'attributes' => array(
            'mode' => 'preview',
            'data' => array(
               'has_preview' => true,
               'preview_image_help' => '',
            ),
         ),
      ),
   ));

   /* Post Feed */

   acf_register_block_type(array(
      'name' => 'block-post-feed',
      'title' => __('Post Feed'),
      'description' => __('Feed displaying selected posts.'),
      'keywords' => array('blog', 'post', 'feed'),
      'render_template' => 'blocks/block-post-feed.php',
      'category' => 'general',
      'icon' => 'admin-post',
      'mode' => 'edit',
      'supports' => array('anchor' => true, 'align' => false),
      'validation' => true,
      'example' => array(
         'attributes' => array(
            'mode' => 'preview',
            'data' => array(
               'has_preview' => true,
               'preview_image_help' => '',
            ),
         ),
      ),
   ));

   /* Contact Form */

   acf_register_block_type(array(
      'name' => 'block-contact-form',
      'title' => __('Contact Form'),
      'description' => __('Embed a form built in Gravity Forms with your contact details.'),
      'keywords' => array('form', 'contact', 'Gravity Forms', 'embed'),
      'render_template' => 'blocks/block-contact-form.php',
      'category' => 'general',
      'icon' => 'feedback',
      'mode' => 'edit',
      'supports' => array('anchor' => true, 'align' => false),
      'validation' => true,
      'example' => array(
         'attributes' => array(
            'mode' => 'preview',
            'data' => array(
               'has_preview' => true,
               'preview_image_help' => '',
            ),
         ),
      ),
   ));
}
add_action('acf/init', 'acf_register_custom_blocks');

/*-----------------------------------------------------------------------------
   List selected blocks in backend editor
-----------------------------------------------------------------------------*/

function acf_custom_block_list($allowed_block_types, $post) {
   $allowed_blocks = array(
      'acf/block-content',
      'acf/block-multicolumn',
      'acf/block-buttons',
      'acf/block-accordion',
      'acf/block-image-gallery',
      'acf/block-video',
      'acf/block-separator',
      'acf/block-hero-banner',
      'acf/block-page-banner',
      'acf/block-split-content',
      'acf/block-reviews',
      'acf/block-counter',
      'acf/block-post-feed',
      'acf/block-contact-form',
   );

   return $allowed_blocks;
}
add_filter('allowed_block_types_all', 'acf_custom_block_list', 10, 2);
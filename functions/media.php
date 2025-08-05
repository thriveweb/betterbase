<?php

/*-----------------------------------------------------------------------
   Register image sizes
-----------------------------------------------------------------------*/

function register_theme_image_sizes() {
   add_image_size('square-thumbnail', 780, 780, ['center', 'center']);
}
// add_action('after_setup_theme', 'register_theme_image_sizes');

function show_image_sizes_editor($sizes) {
   $sizes = array_merge($sizes, array(
      'square-thumbnail' => __('Square Thumbnail'),
   ));
   return $sizes;
}
// add_filter('image_size_names_choose', 'show_image_sizes_editor');

/*-----------------------------------------------------------------------
   Set image quality for JPEG
-----------------------------------------------------------------------*/

function set_jpeg_quality($arg) {
   return (int)75;
}
add_filter('jpeg_quality', 'set_jpeg_quality');

/*-----------------------------------------------------------------------
   Allow SVG support
-----------------------------------------------------------------------*/

function support_svg_mime_types($mime_types) {
   $mime_types['svg'] = 'image/svg+xml';
   return $mime_types;
}
add_filter('upload_mimes', 'support_svg_mime_types');

<?php

/*-----------------------------------------------------------------------
   Set image quality for JPEG
-----------------------------------------------------------------------*/

function set_jpeg_quality($arg) {
    return (int)75;
}
add_filter('jpeg_quality', 'set_jpeg_quality');

/*-----------------------------------------------------------------------
   Set default image size
-----------------------------------------------------------------------*/

function set_default_image_size() {
    update_option('image_default_size', 'large');
}
add_action('after_setup_theme', 'set_default_image_size');

/*-----------------------------------------------------------------------
   Allow SVG support
-----------------------------------------------------------------------*/

function support_svg_mime_types($mime_types) {
    $mime_types['svg'] = 'image/svg+xml';
    return $mime_types;
}
add_filter('upload_mimes', 'support_svg_mime_types');

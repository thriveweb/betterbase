<?php

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

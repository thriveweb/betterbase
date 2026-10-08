<?php

/*-----------------------------------------------------------------------
    Set image quality for JPEG
-----------------------------------------------------------------------*/

function betterbase_set_jpeg_quality($arg) {
    return (int) 75;
}
add_filter('jpeg_quality', 'betterbase_set_jpeg_quality');

/*-----------------------------------------------------------------------
    Set default image size
-----------------------------------------------------------------------*/

function betterbase_set_default_image_size() {
    if (get_option('image_default_size') !== 'large') {
        update_option('image_default_size', 'large');
    }
}
add_action('after_setup_theme', 'betterbase_set_default_image_size');

/*-----------------------------------------------------------------------
    Allow SVG uploads
-----------------------------------------------------------------------*/

function betterbase_support_svg_mime_types($mime_types) {
    if (current_user_can('unfiltered_html')) {
        $mime_types['svg'] = 'image/svg+xml';
    }

    return $mime_types;
}
add_filter('upload_mimes', 'betterbase_support_svg_mime_types');

/*-----------------------------------------------------------------------
    Responsive content embeds (iframe)
-----------------------------------------------------------------------*/

add_filter('embed_oembed_html', function ($html, $url, $attr, $post_id) {
    if (strpos($html, 'youtube.com') !== false || strpos($html, 'youtu.be') !== false || strpos($html, 'player.vimeo') !== false) {
        return '<div class="responsive-embed">' . $html . '</div>';
    }

    return $html;
}, 10, 4);

<?php

/*-----------------------------------------------------------------------
    Register ACF options page
-----------------------------------------------------------------------*/

if (function_exists('acf_add_options_page')) {
    $parent = acf_add_options_page(array(
        'page_title' => __('Global Options'),
        'menu_title' => __('Global Options'),
        'redirect'   => false,
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
        array(
            'slug'  => 'blog',
            'title' => 'Blog',
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
    /* Post Header */
    acf_register_block_type(array(
        'name' => 'block-post-header',
        'title' => __('Post Header'),
        'description' => __('Display title, date, and assigned categories for current post.'),
        'keywords' => array('post', 'blog', 'wysiwyg'),
        'render_template' => 'blocks/block-post-header.php',
        'category' => 'blog',
        'icon' => 'info',
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

    /* Post Content */
    acf_register_block_type(array(
        'name' => 'block-post-content',
        'title' => __('Post Content'),
        'description' => __('Use the WYSIWYG editor to create and format post content.'),
        'keywords' => array('post', 'blog', 'wysiwyg'),
        'render_template' => 'blocks/block-content.php',
        'category' => 'blog',
        'icon' => 'editor-paragraph',
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

    /* Post Footer */
    acf_register_block_type(array(
        'name' => 'block-post-footer',
        'title' => __('Post Footer'),
        'description' => __('Display post pagaintion and social media share icons.'),
        'keywords' => array('post', 'blog', 'pagiantion', 'social', 'share'),
        'render_template' => 'blocks/block-post-footer.php',
        'category' => 'blog',
        'icon' => 'share',
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

    /* Related Posts */
    acf_register_block_type(array(
        'name' => 'block-related-posts',
        'title' => __('Related Posts'),
        'description' => __('Feed displaying related posts.'),
        'keywords' => array('post', 'blog', 'feed'),
        'render_template' => 'blocks/block-related-posts.php',
        'category' => 'blog',
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

    /* Content */
    acf_register_block_type(array(
        'name' => 'block-content',
        'title' => __('Content'),
        'description' => __('Use the WYSIWYG editor to create and format content.'),
        'keywords' => array('content', 'wysiwyg'),
        'render_template' => 'blocks/block-content.php',
        'category' => 'general',
        'icon' => 'editor-paragraph',
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

    /* Multicolumn */
    acf_register_block_type(array(
        'name' => 'block-multicolumn',
        'title' => __('Multicolumn'),
        'description' => __('Multicolumn layout with WYSIWYG editor and optional buttons.'),
        'keywords' => array('content', 'wysiwyg', 'image', 'column'),
        'render_template' => 'blocks/block-multicolumn.php',
        'category' => 'general',
        'icon' => 'columns',
        'mode' => 'preview',
        'supports' => array('anchor' => true, 'align' => false),
        'validation' => true,
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

    /* Gallery */
    acf_register_block_type(array(
        'name' => 'block-image-gallery',
        'title' => __('Gallery'),
        'description' => __('Sliding image carousel.'),
        'keywords' => array('carousel', 'image', 'gallery', 'slider'),
        'render_template' => 'blocks/block-image-gallery.php',
        'category' => 'general',
        'icon' => 'format-gallery',
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

    /* Image */
    acf_register_block_type(array(
        'name' => 'block-image',
        'title' => __('Image'),
        'description' => __('Feature large image.'),
        'keywords' => array('image'),
        'render_template' => 'blocks/block-image.php',
        'category' => 'general',
        'icon' => 'format-image',
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

    /* Video */
    acf_register_block_type(array(
        'name' => 'block-video',
        'title' => __('Video'),
        'description' => __('Embed or upload a video.'),
        'keywords' => array('video', 'embed'),
        'render_template' => 'blocks/block-video.php',
        'category' => 'general',
        'icon' => 'video-alt2',
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

    /* Hero Banner */
    acf_register_block_type(array(
        'name' => 'block-hero-banner',
        'title' => __('Hero Banner'),
        'description' => __('Large hero banner with text, buttons, and background image.'),
        'keywords' => array('banner', 'hero', 'image', 'text'),
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

    /* Accordion */
    acf_register_block_type(array(
        'name' => 'block-accordion',
        'title' => __('Accordion'),
        'description' => __('Repeatable accordion fields for additional information.'),
        'keywords' => array('accordion', 'faq', 'content'),
        'render_template' => 'blocks/block-accordion.php',
        'category' => 'general',
        'icon' => 'align-center',
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

    /* Reviews */
    acf_register_block_type(array(
        'name' => 'block-reviews',
        'title' => __('Reviews'),
        'description' => __('Carousel displaying selected reviews.'),
        'keywords' => array('carousel', 'review', 'feed'),
        'render_template' => 'blocks/block-reviews.php',
        'category' => 'general',
        'icon' => 'admin-comments',
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

    /* Post Feed */
    acf_register_block_type(array(
        'name' => 'block-post-feed',
        'title' => __('Post Feed'),
        'description' => __('Feed displaying selected posts.'),
        'keywords' => array('blog', 'post', 'feed'),
        'render_template' => 'blocks/block-post-feed.php',
        'category' => 'general',
        'icon' => 'admin-post',
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

    /* Contact */
    acf_register_block_type(array(
        'name' => 'block-contact',
        'title' => __('Contact'),
        'description' => __('Embed a form built in Gravity Forms with your contact details.'),
        'keywords' => array('form', 'contact', 'Gravity Forms', 'embed'),
        'render_template' => 'blocks/block-contact.php',
        'category' => 'general',
        'icon' => 'feedback',
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

    /* Instagram */
    acf_register_block_type(array(
        'name' => 'block-instagram',
        'title' => __('Instagram'),
        'description' => __('Embed a an Instagram feed displaying your latest posts.'),
        'keywords' => array('embed', 'social', 'Instagram'),
        'render_template' => 'blocks/block-instagram.php',
        'category' => 'general',
        'icon' => 'instagram',
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
}
add_action('acf/init', 'acf_register_custom_blocks');

/*-----------------------------------------------------------------------
    List selected blocks in backend editor
-----------------------------------------------------------------------*/

function acf_custom_block_list($allowed_block_types, $post) {
    $post_type = $post->post->post_type;

    if (!empty($post_type) && $post_type === 'post') {
        $allowed_blocks = array(
            'acf/block-post-header',
            'acf/block-post-content',
            'acf/block-post-footer',
            'acf/block-related-posts',
            'acf/block-image-gallery',
            'acf/block-image',
            'acf/block-video',
        );
    } else {
        $allowed_blocks = array(
            'acf/block-content',
            'acf/block-multicolumn',
            'acf/block-split-content',
            'acf/block-image-gallery',
            'acf/block-image',
            'acf/block-video',
            'acf/block-hero-banner',
            'acf/block-page-banner',
            'acf/block-accordion',
            'acf/block-reviews',
            'acf/block-post-feed',
            'acf/block-contact',
            'acf/block-instagram',
            'acf/block-separator',
            // 'core/shortcode',
        );
    }

    return $allowed_blocks;
}
add_filter('allowed_block_types_all', 'acf_custom_block_list', 10, 2);
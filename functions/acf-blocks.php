<?php

/*-----------------------------------------------------------------------
    ACF fallback
-----------------------------------------------------------------------*/

if (!function_exists('get_field')) {
    function get_field($selector = '', $post_id = false, $format_value = true) {
        return null;
    }

    function betterbase_acf_inactive_notice() {
        echo '<div class="notice notice-error"><p>This theme requires <strong>Advanced Custom Fields PRO</strong>. Please install and activate it.</p></div>';
    }
    add_action('admin_notices', 'betterbase_acf_inactive_notice');
}

/*-----------------------------------------------------------------------
    Options
-----------------------------------------------------------------------*/

add_action('acf/init', function () {
    if (function_exists('acf_add_options_page')) {
        acf_add_options_page(array(
            'page_title' => __('Global Options'),
            'menu_title' => __('Global Options'),
            'redirect'   => false,
        ));
    }
});

/*-----------------------------------------------------------------------
    Force thumbnail preview on image / gallery fields
-----------------------------------------------------------------------*/

function betterbase_acf_image_preview_thumbnail($field) {
    $field['preview_size'] = 'thumbnail';
    return $field;
}
add_filter('acf/load_field/type=image', 'betterbase_acf_image_preview_thumbnail');
add_filter('acf/load_field/type=gallery', 'betterbase_acf_image_preview_thumbnail');
add_filter('acf/load_field_defaults/type=image', 'betterbase_acf_image_preview_thumbnail');
add_filter('acf/load_field_defaults/type=gallery', 'betterbase_acf_image_preview_thumbnail');

/*-----------------------------------------------------------------------
    Config allowed blocks, categories, and setting defaults
-----------------------------------------------------------------------*/

function betterbase_blocks_config() {
    return array(
        'categories' => array(
            array('slug' => 'general', 'title' => 'General', 'icon' => 'dashicons-block-default'),
            array('slug' => 'blog', 'title' => 'Blog', 'icon' => 'dashicons-block-default'),
        ),
        'allowed' => array(
            'post' => array(
                'acf/block-post-header',
                'acf/block-wysiwyg',
                'acf/block-post-footer',
                'acf/block-gallery',
                'acf/block-video',
            ),
            'default' => array(
                'acf/block-wysiwyg',
                'acf/block-multicolumn',
                'acf/block-split-content',
                'acf/block-accordion',
                'acf/block-gallery',
                'acf/block-video',
                'acf/block-hero-banner',
                'acf/block-page-banner',
                'acf/block-logo-slider',
                'acf/block-post-feed',
                'acf/block-testimonials',
                'acf/block-instagram',
                'acf/block-contact',
                'acf/block-separator',
                'core/shortcode',
            ),
        ),
        'templates' => array(
            'post' => array(
                array('acf/block-post-header'),
                array('acf/block-wysiwyg'),
                array('acf/block-post-footer'),
            ),
        ),
        'defaults' => array(
            'background'     => 'none',
            'container'      => 'lg',
            'padding_top'    => 80,
            'padding_bottom' => 80,
        ),
    );
}

/*-----------------------------------------------------------------------
    Block helpers
-----------------------------------------------------------------------*/

/* Inserter preview — preview.jpg in the block folder only */
function betterbase_block_preview($block) {
    if (empty($block['data']['_is_preview'])) {
        return false;
    }

    $file = ($block['path'] ?? '') . '/preview.jpg';

    if (file_exists($file)) {
        $url = get_template_directory_uri() . str_replace(get_template_directory(), '', $block['path']) . '/preview.jpg';
        echo '<img src="' . esc_url($url) . '" alt="" style="width:100%;height:auto;display:block;">';
    }

    return true;
}

/* Empty block placeholder */
function betterbase_block_empty($message = 'Add content to preview this block.') {
    if (!is_admin()) {
        return;
    }

    echo '<div class="block-empty"><p>' . esc_html($message) . '</p></div>';
}

/* Shared settings vars for block templates */
function betterbase_block_settings($block) {
    $slug = str_replace('acf/', '', $block['name'] ?? '');
    $defaults = betterbase_blocks_config()['defaults'];

    $padding_top = $block['settings_padding_top'] ?? $defaults['padding_top'];
    $padding_bottom = $block['settings_padding_bottom'] ?? $defaults['padding_bottom'];
    $background_color = $block['settings_background_color'] ?? $defaults['background'];
    $container = $block['settings_container'] ?? $defaults['container'];

    $allowed_backgrounds = array_merge(array('none'), array_keys(betterbase_colors()));
    if (!in_array($background_color, $allowed_backgrounds, true)) {
        $background_color = 'none';
    }

    $allowed_containers = array('xs', 'sm', 'md', 'lg', 'xl');
    if (!in_array($container, $allowed_containers, true)) {
        $container = $defaults['container'];
    }

    return array(
        'block_name'       => $slug,
        'block_classes'    => array_filter(array('betterbase-theme', $slug, $block['className'] ?? null)),
        'block_anchor'     => $block['anchor'] ?? '',
        'block_css'        => $block['css'] ?? '',
        'padding_top'      => $padding_top,
        'padding_bottom'   => $padding_bottom,
        'background_color' => $background_color,
        'container'        => $container,
        'setting_classes'  => array('block-setting-padding', 'block-setting-background-color'),
        'setting_styles'   => array(
            '--block-padding-top: ' . intval($padding_top) . 'px',
            '--block-padding-bottom: ' . intval($padding_bottom) . 'px',
            '--block-background-color: var(--' . sanitize_html_class($background_color) . ')',
        ),
    );
}

/*-----------------------------------------------------------------------
    Register blocks and settings
-----------------------------------------------------------------------*/

function betterbase_register_block_categories($categories) {
    return array_merge(betterbase_blocks_config()['categories'], $categories);
}
add_filter('block_categories_all', 'betterbase_register_block_categories', 10, 1);

function betterbase_register_blocks() {
    $config = betterbase_blocks_config();
    $default = $config['allowed']['default'];
    $insert_after = 'acf/block-page-banner';
    $before = array();
    $after = array();
    $passed_slot = false;

    foreach ($default as $name) {
        if (!$passed_slot) {
            $before[] = $name;
            if ($name === $insert_after) {
                $passed_slot = true;
            }
        } else {
            $after[] = $name;
        }
    }

    $known = array_values(array_unique(array_merge($before, $after, $config['allowed']['post'])));
    $registered = array();

    $register = function ($name) use (&$registered) {
        $slug = str_replace('acf/', '', $name);
        $dir = get_template_directory() . '/blocks/' . $slug;

        if (!is_dir($dir) || $slug === 'block-TEMPLATE' || in_array($slug, $registered, true)) {
            return;
        }

        register_block_type($dir);
        $registered[] = $slug;
    };

    foreach ($before as $name) {
        $register($name);
    }

    /* Unlisted block folders register in the new-block slot (after Page Banner) */
    foreach (glob(get_template_directory() . '/blocks/block-*/block.json') as $block_json) {
        $slug = basename(dirname($block_json));
        $name = 'acf/' . $slug;

        if ($slug === 'block-TEMPLATE' || in_array($name, $known, true)) {
            continue;
        }

        $register($name);
    }

    foreach ($after as $name) {
        $register($name);
    }

    foreach ($config['allowed']['post'] as $name) {
        $register($name);
    }
}
add_action('init', 'betterbase_register_blocks');

/* Name, template, setting defaults, preview example */
function betterbase_block_type_metadata($metadata) {
    if (!str_starts_with($metadata['name'] ?? '', 'acf/block-')) {
        return $metadata;
    }

    $slug = str_replace('acf/', '', $metadata['name']);
    $dir = get_template_directory() . '/blocks/' . $slug;

    if (!is_dir($dir) || $slug === 'block-TEMPLATE') {
        return $metadata;
    }

    $metadata['name'] = 'acf/' . $slug;
    $metadata['acf'] = array_merge($metadata['acf'] ?? array(), array(
        'renderTemplate' => $slug . '.php',
    ));

    $settings = array_merge(
        betterbase_blocks_config()['defaults'],
        (isset($metadata['betterbase']['settings']) && is_array($metadata['betterbase']['settings']))
            ? $metadata['betterbase']['settings']
            : array()
    );

    $metadata['attributes'] = array_merge(array(
        'settings_background_color' => array('type' => 'string', 'default' => $settings['background']),
        'settings_container'        => array('type' => 'string', 'default' => $settings['container']),
        'settings_padding_top'      => array('type' => 'number', 'default' => $settings['padding_top']),
        'settings_padding_bottom'   => array('type' => 'number', 'default' => $settings['padding_bottom']),
    ), $metadata['attributes'] ?? array());

    if ($slug === 'block-multicolumn') {
        $metadata['attributes'] = array_merge($metadata['attributes'], array(
            'multicolumn_count'     => array('type' => 'number', 'default' => 2),
            'multicolumn_alignment' => array('type' => 'string', 'default' => 'align-start'),
        ));
    }

    unset($metadata['example']);

    if (file_exists($dir . '/preview.jpg')) {
        $metadata['example'] = array(
            'attributes' => array(
                'mode' => 'preview',
                'data' => array('_is_preview' => true),
            ),
        );
    }

    return $metadata;
}
add_filter('block_type_metadata', 'betterbase_block_type_metadata');

/* Allowlist — after blocks are registered */
function betterbase_allowed_block_types($allowed_block_types, $editor_context) {
    $allowed = betterbase_blocks_config()['allowed'];
    $post_type = $editor_context->post->post_type ?? '';

    return ($post_type === 'post') ? $allowed['post'] : $allowed['default'];
}
add_filter('allowed_block_types_all', 'betterbase_allowed_block_types', 10, 2);

function betterbase_default_block_templates($args, $post_type) {
    $templates = betterbase_blocks_config()['templates'];

    if (!empty($templates[$post_type])) {
        $args['template'] = $templates[$post_type];
    }

    return $args;
}
add_filter('register_post_type_args', 'betterbase_default_block_templates', 10, 2);

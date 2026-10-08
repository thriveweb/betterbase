<?php

/*-----------------------------------------------------------------------
    Fonts
-----------------------------------------------------------------------*/

function betterbase_fonts_url() {
    return 'https://fonts.googleapis.com/css2?family=Google+Sans:ital,opsz,wght@0,17..18,400..700;1,17..18,400..700&display=swap';
}

function betterbase_enqueue_fonts() {
    wp_enqueue_style('betterbase-fonts', betterbase_fonts_url(), array(), null);
}

/*-----------------------------------------------------------------------
    Swiper (carousels)
-----------------------------------------------------------------------*/

function betterbase_needs_swiper() {
    if (is_admin()) {
        return true;
    }

    if (betterbase_is_active_woocommerce() && function_exists('is_product') && is_product()) {
        return true;
    }

    if (is_singular()) {
        $post = get_post();
        if (!$post) {
            return false;
        }

        foreach (array('acf/block-gallery', 'acf/block-testimonials', 'acf/block-split-content', 'acf/block-logo-slider') as $block_name) {
            if (has_block($block_name, $post)) {
                return true;
            }
        }
    }

    return false;
}

function betterbase_enqueue_swiper() {
    wp_enqueue_style('betterbase-swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), '11');
    wp_enqueue_script('betterbase-swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), '11', true);
}

/*-----------------------------------------------------------------------
    Front-end scripts and styles
-----------------------------------------------------------------------*/

function betterbase_enqueue_theme_scripts() {
    betterbase_enqueue_fonts();
    wp_enqueue_style('betterbase-style', get_stylesheet_directory_uri() . '/style.css', array('betterbase-fonts'), filemtime(get_stylesheet_directory() . '/style.css'));
    wp_enqueue_style('betterbase-theme', get_stylesheet_directory_uri() . '/assets/css/theme.css', array('betterbase-fonts'), filemtime(get_stylesheet_directory() . '/assets/css/theme.css'));
    wp_add_inline_style('betterbase-theme', betterbase_color_css());

    // wp_enqueue_style('betterbase-aos', get_stylesheet_directory_uri() . '/assets/aos/aos.css', array(), filemtime(get_stylesheet_directory() . '/assets/aos/aos.css'));
    // wp_enqueue_script('betterbase-aos', get_stylesheet_directory_uri() . '/assets/aos/aos.js', array(), filemtime(get_stylesheet_directory() . '/assets/aos/aos.js'), true);

    $theme_deps = array('jquery');
    if (betterbase_needs_swiper()) {
        betterbase_enqueue_swiper();
        $theme_deps[] = 'betterbase-swiper';
    }

    wp_enqueue_script(
        'betterbase-theme',
        get_stylesheet_directory_uri() . '/assets/js/theme.js',
        $theme_deps,
        filemtime(get_stylesheet_directory() . '/assets/js/theme.js'),
        true
    );
}
add_action('wp_enqueue_scripts', 'betterbase_enqueue_theme_scripts');

/*-----------------------------------------------------------------------
    WooCommerce scripts and styles
-----------------------------------------------------------------------*/

function betterbase_enqueue_woocommerce_assets() {
    if (!betterbase_is_active_woocommerce()) {
        return;
    }

    if (!is_woocommerce() && !is_cart() && !is_checkout() && !is_account_page()) {
        return;
    }

    wp_enqueue_style(
        'betterbase-woocommerce',
        get_stylesheet_directory_uri() . '/assets/css/woocommerce.css',
        array('betterbase-theme'),
        filemtime(get_stylesheet_directory() . '/assets/css/woocommerce.css')
    );

    $woo_deps = array('jquery');
    if (betterbase_needs_swiper()) {
        betterbase_enqueue_swiper();
        $woo_deps[] = 'betterbase-swiper';
    }

    wp_enqueue_script(
        'betterbase-woocommerce',
        get_stylesheet_directory_uri() . '/assets/js/woocommerce.js',
        $woo_deps,
        filemtime(get_stylesheet_directory() . '/assets/js/woocommerce.js'),
        true
    );
}
add_action('wp_enqueue_scripts', 'betterbase_enqueue_woocommerce_assets', 20);

/*-----------------------------------------------------------------------
    Block editor + preview assets
-----------------------------------------------------------------------*/

function betterbase_enqueue_block_assets() {
    if (!is_admin()) {
        return;
    }

    betterbase_enqueue_fonts();
    wp_enqueue_style('betterbase-theme', get_stylesheet_directory_uri() . '/assets/css/theme.css', array('betterbase-fonts'), filemtime(get_stylesheet_directory() . '/assets/css/theme.css'));
    wp_add_inline_style('betterbase-theme', betterbase_color_css());
    betterbase_enqueue_swiper();
}
add_action('enqueue_block_assets', 'betterbase_enqueue_block_assets');

function betterbase_enqueue_admin_color_variables() {
    betterbase_enqueue_fonts();
    wp_register_style('betterbase-color-vars', false);
    wp_enqueue_style('betterbase-color-vars');
    wp_add_inline_style('betterbase-color-vars', betterbase_color_css());
}
add_action('admin_enqueue_scripts', 'betterbase_enqueue_admin_color_variables');

function betterbase_enqueue_block_editor_assets() {
    wp_enqueue_script(
        'betterbase-blocks',
        get_stylesheet_directory_uri() . '/assets/js/blocks.js',
        array('wp-blocks', 'wp-dom-ready', 'wp-edit-post', 'wp-element', 'wp-components', 'wp-data', 'jquery', 'betterbase-swiper'),
        filemtime(get_stylesheet_directory() . '/assets/js/blocks.js'),
        true
    );

    $config = betterbase_blocks_config();

    wp_localize_script('betterbase-blocks', 'betterbaseBlocks', array(
        'allowedBlocks' => array_values(array_unique(array_merge(
            $config['allowed']['post'],
            $config['allowed']['default']
        ))),
        'backgroundColors' => betterbase_background_color_options(),
    ));
}
add_action('enqueue_block_editor_assets', 'betterbase_enqueue_block_editor_assets');

/*-----------------------------------------------------------------------
    Classic editor / ACF TinyMCE styles
-----------------------------------------------------------------------*/

/* Load fonts in the TinyMCE iframe via the browser (add_editor_style fetches
   Google Fonts server-side with a non-browser UA and often gets empty CSS). */
function betterbase_mce_css($mce_css) {
    $fonts = betterbase_fonts_url();
    return $mce_css ? $mce_css . ',' . $fonts : $fonts;
}
add_filter('mce_css', 'betterbase_mce_css');

add_editor_style(get_stylesheet_directory_uri() . '/assets/css/wysiwyg.css?v=' . filemtime(get_stylesheet_directory() . '/assets/css/wysiwyg.css'));

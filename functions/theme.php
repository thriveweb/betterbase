<?php

/*-----------------------------------------------------------------------
    Init custom theme support
-----------------------------------------------------------------------*/

function betterbase_theme_support() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('editor-styles');
    add_theme_support('responsive-embeds');
    add_theme_support('html5', array(
        'search-form',
        'gallery',
        'caption',
        'style',
        'script',
    ));
}
add_action('after_setup_theme', 'betterbase_theme_support');

/*-----------------------------------------------------------------------
    Register custom menus
-----------------------------------------------------------------------*/

function betterbase_register_menus() {
    register_nav_menu('header', 'Header Menu');
    register_nav_menu('footer', 'Footer Menu');
}
add_action('init', 'betterbase_register_menus');

/*-----------------------------------------------------------------------
    Customised menu output
-----------------------------------------------------------------------*/

class BetterBase_Submenu_Wrap extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<div class='sub-menu-wrap'><ul class='sub-menu'>\n";
    }
    function end_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul></div>\n";
    }
}

function betterbase_add_submenu_icon($items, $args) {
    if ($args->theme_location == 'header') {
        foreach ($items as &$item) {
            if (in_array('menu-item-has-children', $item->classes)) {
                $icon = !empty($item->menu_item_parent) ? 'icon-chevron-right.svg' : 'icon-chevron-down.svg';
                ob_start();
                echo '<span class="trigger-sub-menu" aria-expanded="false" aria-hidden="true">';
                betterbase_include_asset($icon);
                echo '</span>';
                $item->title .= ob_get_clean();
            }
        }
    }
    return $items;
}

function betterbase_nav_menu_link_attributes($atts, $item, $args) {
    if (!empty($args->theme_location) && $args->theme_location === 'header' && in_array('menu-item-has-children', (array) $item->classes, true)) {
        $atts['aria-haspopup'] = 'true';
        $atts['aria-expanded'] = 'false';
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'betterbase_nav_menu_link_attributes', 10, 3);
add_filter('wp_nav_menu_objects', 'betterbase_add_submenu_icon', 10, 2);

/*-----------------------------------------------------------------------
    Customise login page
-----------------------------------------------------------------------*/

function betterbase_login_page_title() {
    return get_bloginfo('title');
}
add_filter('login_headertext', 'betterbase_login_page_title');

function betterbase_login_title_url() {
    return home_url();
}
add_filter('login_headerurl', 'betterbase_login_title_url');

function betterbase_login_logo() { ?>
    <style type="text/css">
        #login h1 a {
            background-image: url('<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/img/logo-betterbase.svg'); ?>');
            background-size: contain;
            width: 100%;
            height: 80px;
        }
    </style>
<?php }
add_action('login_enqueue_scripts', 'betterbase_login_logo');

/*-----------------------------------------------------------------------
    Customise WYSIWYG editor
-----------------------------------------------------------------------*/

function betterbase_mce_text_colors($init) {
    $map = array();

    foreach (betterbase_colors() as $color) {
        if ($color['tinymce'] ?? true) {
            $map[] = '"' . ltrim($color['hex'], '#') . '"';
            $map[] = '"' . $color['label'] . '"';
        }
    }

    $init['textcolor_map'] = '[' . implode(', ', $map) . ']';
    $init['content_style'] = betterbase_color_css() . ' ' . ($init['content_style'] ?? '');
    return $init;
}
add_filter('tiny_mce_before_init', 'betterbase_mce_text_colors');

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

/*-----------------------------------------------------------------------
    Gravity Forms defaults
-----------------------------------------------------------------------*/

add_filter('gform_confirmation_anchor', '__return_false');

function betterbase_gf_force_shortcode_atts($form_args) {
    $form_args['display_title'] = false;
    $form_args['display_description'] = false;
    $form_args['ajax'] = true;
    return $form_args;
}
add_filter('gform_form_args', 'betterbase_gf_force_shortcode_atts', 99);

function betterbase_gf_customise_submit_button($button, $form) {
    if (is_admin()) {
        return $button;
    }

    if (!empty($form['button']['type']) && $form['button']['type'] === 'image') {
        return $button;
    }

    $label = !empty($form['button']['text']) ? $form['button']['text'] : 'Submit';

    ob_start();
    betterbase_include_asset('icon-arrow-right.svg');
    $icon = ob_get_clean();

    return '<button type="submit" id="gform_submit_button_'.esc_attr($form['id']).'" class="gform_button button button-default" onclick="gform.submission.handleButtonClick(this);" data-submission-type="submit">'.esc_html($label).$icon.'</button>';
}
// add_filter('gform_submit_button', 'betterbase_gf_customise_submit_button', 10, 2);

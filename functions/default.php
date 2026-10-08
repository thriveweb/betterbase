<?php

/*-----------------------------------------------------------------------
    Check for robots
-----------------------------------------------------------------------*/

function betterbase_no_robots_notice() {
    if (!current_user_can('manage_options')) {
        return;
    }

    if (!get_option('blog_public')) {
        echo '<div class="notice notice-error"><p>Search engines are blocked</p></div>';
    }
}
add_action('admin_notices', 'betterbase_no_robots_notice');

/*-----------------------------------------------------------------------
    No pingbacks
-----------------------------------------------------------------------*/

add_filter('xmlrpc_methods', function($methods) {
    unset($methods['pingback.ping']);
    return $methods;
});

/*-----------------------------------------------------------------------
    Disable comments
-----------------------------------------------------------------------*/

function betterbase_disable_post_support() {
    foreach (get_post_types() as $post_type) {
        remove_post_type_support($post_type, 'comments');
    }
}
add_action('admin_init', 'betterbase_disable_post_support');
add_filter('pings_open', '__return_false', 20, 2);
add_filter('comments_open', '__return_false', 20, 2);
add_filter('comments_array', '__return_empty_array', 10, 2);

/*-----------------------------------------------------------------------
    Remove title prefix
-----------------------------------------------------------------------*/

function betterbase_remove_protected_text() {
    return __('%s');
}
add_filter('protected_title_format', 'betterbase_remove_protected_text');

/*-----------------------------------------------------------------------
    Disable theme/plugin autoupdate emails
-----------------------------------------------------------------------*/

add_filter('auto_plugin_update_send_email', '__return_false');
add_filter('auto_theme_update_send_email', '__return_false');

/*-----------------------------------------------------------------------
    Rename default page template
-----------------------------------------------------------------------*/

add_filter('default_page_template_title', function() {
    return __('Default');
});

/*-----------------------------------------------------------------------
    Add active class for post type archive pages
-----------------------------------------------------------------------*/

function betterbase_enable_active_state_archive_menu_links($classes = array(), $menu_item = false) {
    if (empty($menu_item) || empty($menu_item->url)) {
        return $classes;
    }

    global $post;
    if (empty($post->ID) || empty($post->post_type)) {
        return $classes;
    }

    $archive_link = get_post_type_archive_link($post->post_type);
    if ($archive_link && untrailingslashit($menu_item->url) === untrailingslashit($archive_link)) {
        $classes[] = 'current-menu-item';
    }

    return $classes;
}
add_filter('nav_menu_css_class', 'betterbase_enable_active_state_archive_menu_links', 10, 2);

/*-----------------------------------------------------------------------
    Customised search form output
-----------------------------------------------------------------------*/

function betterbase_customised_wp_search_form($form) {
    $form = '<form role="search" method="get" class="search-form" action="'. esc_url(home_url('/')) .'">
        <label class="screen-reader-text" for="s">' . __('Search for:') . '</label>
        <input type="text" value="'. (is_search() ? esc_attr(get_search_query()) : '') .'" name="s" id="s" placeholder="Search for something..." />
        <button type="submit">Submit</button>
    </form>';

    return $form;
}
add_filter('get_search_form', 'betterbase_customised_wp_search_form');

/*-----------------------------------------------------------------------
    Exclude blog posts from search results
-----------------------------------------------------------------------*/

function betterbase_exclude_posts_from_search($query) {
    if (is_admin() || !$query->is_main_query() || !$query->is_search()) {
        return;
    }

    $post_types = get_post_types(array('exclude_from_search' => false), 'names');
    unset($post_types['post']);

    if (!empty($post_types)) {
        $query->set('post_type', array_values($post_types));
    }
}
add_action('pre_get_posts', 'betterbase_exclude_posts_from_search');

/*-----------------------------------------------------------------------
    Tidy admin bar
-----------------------------------------------------------------------*/

add_action('wp_before_admin_bar_render', function() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_node('wp-logo');
    $wp_admin_bar->remove_node('customize');
    $wp_admin_bar->remove_node('updates');
    $wp_admin_bar->remove_menu('comments');
    $wp_admin_bar->remove_node('search');
    // $wp_admin_bar->remove_node('gform-forms');
    $wp_admin_bar->remove_node('wpseo-menu');
    $wp_admin_bar->remove_node('password_protected');
    $wp_admin_bar->remove_menu('itsec_admin_bar_menu');
}, 999);

/*-----------------------------------------------------------------------
    Tidy admin dashboard menu
-----------------------------------------------------------------------*/

function betterbase_tidy_dashboard_menu_items($menu_ord) {
    if (!$menu_ord) return true;

    return array(
        'index.php', // Dashboard
        'user-manual', // User Manual
        'acf-options-global-options', // ACF Options
        
        'separator1', // First separator

        'upload.php', // Media
        'gf_edit_forms', // Gravity Forms
        'edit.php', // Posts
        'edit.php?post_type=page', // Pages
        'edit.php?post_type=service', // CPT: Services
        'edit.php?post_type=testimonial', // CPT: Testimonials

        'woocommerce', // WooCommerce
        'product', // Products
        'admin.php?page=wc-settings&tab=checkout&from=PAYMENTS_MENU_ITEM', // Payments
        'wc-admin&path=/payments/overview', // Payments
        'woocommerce-marketing', // Marketing
        'wc-admin&path=/analytics/overview', // Analytics
        'jetpack', // Jetpack
        
        'separator2', // Second separator
        
        'options-general.php', // Settings
        'themes.php', // Appearance
        'plugins.php', // Plugins
        'users.php', // Users
        'tools.php', // Tools

        'separator-last', // Last separator
        
        'edit.php?post_type=acf-field-group', // ACF
        'itsec', // Security
        'wpseo_dashboard', // Yoast SEO
    );
}
add_filter('menu_order', 'betterbase_tidy_dashboard_menu_items', 10, 1);
add_filter('custom_menu_order', 'betterbase_tidy_dashboard_menu_items', 10, 1);

function betterbase_remove_dashboard_menu_items() {
    remove_menu_page('edit-comments.php'); // Comments
    remove_menu_page('password-protected'); // Password Protected
    remove_menu_page('options-general.php?page=updraftplus'); // UpdraftPlus
    remove_menu_page('wsal-auditlog'); // WP Activity Log
}
add_action('admin_menu', 'betterbase_remove_dashboard_menu_items', 100);

/*-----------------------------------------------------------------------
    Admin CSS tweaks
-----------------------------------------------------------------------*/

function betterbase_init_admin_styles() { ?>
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
add_action('admin_head', 'betterbase_init_admin_styles');

/*-----------------------------------------------------------------------
    Tidy user profile pages
-----------------------------------------------------------------------*/

function betterbase_tidy_profile_fields() { ?>
    <style>
        #your-profile h2,
        #your-profile tr.user-syntax-highlighting-wrap,
        #your-profile tr.user-admin-color-wrap,
        #your-profile tr.user-rich-editing-wrap,
        #your-profile tr.user-comment-shortcuts-wrap,
        #your-profile tr.user-profile-picture,
        #your-profile tr.user-sessions-wrap,
        #your-profile tr.user-description-wrap,
        #your-profile tr.user-aim-wrap,
        #your-profile tr.user-yim-wrap,
        #your-profile tr.user-jabber-wrap,
        #your-profile tr.user-facebook-wrap,
        #your-profile tr.user-instagram-wrap,
        #your-profile tr.user-linkedin-wrap,
        #your-profile tr.user-myspace-wrap,
        #your-profile tr.user-pinterest-wrap,
        #your-profile tr.user-soundcloud-wrap,
        #your-profile tr.user-tumblr-wrap,
        #your-profile tr.user-twitter-wrap,
        #your-profile tr.user-youtube-wrap,
        #your-profile tr.user-wikipedia-wrap,
        #your-profile .yoast-settings{
            display: none;
        }

        #your-profile tr .description{
            color: #646970;
        }

        #your-profile td .description{
            display: block;
            margin-top: 5px;
            font-size: 12px;
        }
    </style>
<?php }
add_action('admin_head-user-edit.php', 'betterbase_tidy_profile_fields');
add_action('admin_head-profile.php', 'betterbase_tidy_profile_fields');

/*-----------------------------------------------------------------------
    Register user manual
-----------------------------------------------------------------------*/

function betterbase_init_user_manual() { ?>
    <style media="screen">
        .user-manual {
            width: 90%;
            height: 100%;
        }
        .user-manual iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: calc(100vh - 90px);
        }
    </style>
    <div class="user-manual">
        <iframe src="<?php echo esc_url(home_url('/user-manual/')); ?>" width="100%" height="100%"></iframe>
    </div>
<?php }

function betterbase_register_user_manual() {
    add_menu_page(
        __('User Manual'),
        'User Manual',
        'manage_options',
        'user-manual',
        'betterbase_init_user_manual',
        'dashicons-sos',
        3
    );
}
add_action('admin_menu', 'betterbase_register_user_manual');

/*-----------------------------------------------------------------------
    Add Thrive Digital credits
-----------------------------------------------------------------------*/

function betterbase_thrive_credit_admin_footer() {
    echo 'By <a href="https://thriveweb.com.au/" title="Thrive Digital Web Design & Development Gold Coast">Thrive Digital</a><br>';
}
add_filter('admin_footer_text', 'betterbase_thrive_credit_admin_footer');

function betterbase_thrive_credit_console() {
    if (is_front_page()) { ?>
        <script type="text/javascript">
            console.log(`
              .   oooo
            .o8   '888
          .o888oo  888 .oo.   ooood8b  ooo  ooo   ooo   .ooooo.
            888    888P"Y88b  '888'8P  888  '88.  .8'  d88' '88b
            888    888   888   888     888   '88..8'   888ooo888
            888 .  888   888   888     888    '888'    888    .o
            "888" o888o o888o d888b   o888o    '8'     'Y8bod8P'

                        Built by Thrive Digital
            `);
        </script>
    <?php }
}
add_action('wp_footer', 'betterbase_thrive_credit_console');

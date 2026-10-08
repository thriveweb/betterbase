<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <?php if (!empty($_SERVER['SERVER_NAME']) && preg_match('/thrivex\.io/i', $_SERVER['SERVER_NAME'])): ?>
        <meta name="robots" content="noindex, nofollow"> <?php add_filter('wpseo_robots', '__return_false'); ?>
    <?php endif; ?>

    <meta charset="<?php echo esc_attr(get_bloginfo('charset')); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, maximum-scale=5.0, minimal-ui" />
    <meta name="format-detection" content="telephone=no, address=no, email=no">
    <link rel="alternate" type="application/rss+xml" title="<?php echo esc_attr(get_bloginfo('name')); ?> RSS" href="<?php echo esc_url(get_bloginfo('rss2_url')); ?>">

    <?php wp_head(); ?>
</head>

<body <?php body_class('betterbase-theme'); ?>>
<?php wp_body_open(); ?>

<?php
$enable_search = get_field('enable_search', 'options');
$enable_breadcrumbs = get_field('enable_breadcrumbs', 'options');
$enable_notice = get_field('enable_notice', 'options');
$header_button = get_field('header_button', 'options');
?>

<header class="site-header">
    <?php if ($enable_notice && ($notice_text = get_field('notice_text', 'options'))): ?>
        <div class="site-notice">
            <div class="container-lg wysiwyg-content text-size-small text-align-center text-color-white">
                <p><?php echo wp_kses_post($notice_text); ?></p>
            </div>
        </div>
    <?php endif; ?>
    <div class="container-lg flex-layout flex-align-center flex-justify-between">
        <a class="site-logo" href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>">
            <?php betterbase_include_asset('logo-betterbase.svg'); ?>
        </a>
        <div class="main-menu flex-layout flex-align-center flex-justify-end">
            <?php if (has_nav_menu('header')): ?>
                <?php wp_nav_menu(array('theme_location' => 'header', 'container' => false, 'walker' => new BetterBase_Submenu_Wrap)); ?>
            <?php endif; ?>
            <?php if (!empty($header_button['url']) && !empty($header_button['title'])): ?>
                <div class="group-button">
                    <a class="button" href="<?php echo esc_url($header_button['url']); ?>" target="<?php echo esc_attr($header_button['target'] ?: '_self'); ?>" title="<?php echo esc_attr($header_button['title']); ?>">
                        <?php echo esc_html($header_button['title']); ?>
                    </a>
                </div>
            <?php endif; ?>
            <?php if ($enable_search): ?>
                <div class="icon-search trigger-search">
                    <?php betterbase_include_asset('icon-search.svg'); ?>
                </div>
            <?php endif; ?>
            <?php if (betterbase_is_active_woocommerce()): ?>
                <a class="icon-account" href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>" title="Account" aria-label="Account">
                    <?php betterbase_include_asset('icon-account.svg'); ?>
                </a>
                <a class="icon-cart" href="<?php echo esc_url(wc_get_page_permalink('cart')); ?>" title="Cart" aria-label="Cart">
                    <?php betterbase_include_asset('icon-cart.svg'); ?>
                    <span class="cart-count"><?php echo esc_html(WC()->cart ? WC()->cart->get_cart_contents_count() : 0); ?></span>
                </a>
            <?php endif; ?>
            <button type="button" class="icon-hamburger trigger-menu" aria-expanded="false" aria-controls="site-responsive-menu" aria-label="Menu">
                <span></span>
            </button>
        </div>
    </div>
</header>

<div id="site-responsive-menu" class="site-responsive-menu" aria-hidden="true">
    <div class="container-xl">
        <?php if ($enable_search): ?>
            <?php get_search_form(); ?>
        <?php endif; ?>
        <?php if (has_nav_menu('header')): ?>
            <div class="main-menu">
                <?php wp_nav_menu(array('theme_location' => 'header', 'container' => false, 'walker' => new BetterBase_Submenu_Wrap)); ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($header_button['url']) && !empty($header_button['title'])): ?>
            <div class="group-button flex-justify-start">
                <a class="button" href="<?php echo esc_url($header_button['url']); ?>" target="<?php echo esc_attr($header_button['target'] ?: '_self'); ?>" title="<?php echo esc_attr($header_button['title']); ?>">
                    <?php echo esc_html($header_button['title']); ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php if ($enable_search): ?>
    <div class="site-search">
        <div class="container-sm flex-layout flex-align-center">
            <?php get_search_form(); ?>
            <div class="close-search">
                <?php betterbase_include_asset('icon-close.svg'); ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<main id="site-main" class="site-main" tabindex="-1">

<?php if ($enable_breadcrumbs): betterbase_get_breadcrumbs(); endif; ?>

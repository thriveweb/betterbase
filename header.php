<!doctype html>
<html lang="en">
<head>
   <?php if (preg_match('/thrivex.io/i', $_SERVER['SERVER_NAME'])): ?>
      <meta name="robots" content="noindex, nofollow"> <?php add_filter('wpseo_robots', '__return_false'); ?>
   <?php endif; ?>

   <meta charset="<?php echo get_bloginfo('charset'); ?>">
   <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, maximum-scale=5.0, minimal-ui" />
   <meta name="format-detection" content="telephone=no, address=no, email=no">
   <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS" href="<?php bloginfo('rss2_url'); ?>">

   <?php wp_head(); ?>
</head>

<body <?php body_class('betterbase-theme'); ?>>

<?php 
$enable_search = get_field('enable_search', 'options');
$enable_breadcrumbs = get_field('enable_breadcrumbs', 'options');
$enable_notice = get_field('enable_notice', 'options');
$notice_text = get_field('notice_text', 'options');
$header_button = get_field('header_button', 'options'); ?>

<header class="site-header">
   <?php if ($enable_notice && !empty($notice_text)): ?>
      <div class="site-notice">
         <div class="container-lg wysiwyg-content text-center text-white">
            <p class="text-small"><?php echo $notice_text; ?></p>
         </div>
      </div>
   <?php endif; ?>
   <div class="container-lg flex-layout flex-align-center flex-justify-between">
      <div class="header-left">
         <a class="site-logo" href="<?php echo get_bloginfo('url'); ?>" title="<?php echo get_bloginfo('name'); ?>">
            <?php include_asset('logo-betterbase.svg'); ?>
         </a>
      </div>
      <div class="header-right flex-layout flex-align-center flex-justify-end flex-gap">
         <?php if (has_nav_menu('header')): ?>
            <div class="main-menu">
               <?php wp_nav_menu(array('theme_location' => 'header', 'container' => false, 'walker' => new Submenu_Wrap)); ?>
            </div>
         <?php endif; ?>
         <?php if ($enable_search): ?>
            <div class="icon-search trigger-search">
               <?php include_asset('icon-search.svg'); ?>
            </div>
         <?php endif; ?>
         <?php if (!empty($header_button['url']) && !empty($header_button['title'])): ?>
            <a class="button" href="<?php echo $header_button['url']; ?>" target="<?php echo $header_button['target']; ?>" title="<?php echo $header_button['title']; ?>"><?php echo $header_button['title']; ?></a>
         <?php endif; ?>
         <div class="icon-hamburger trigger-menu">
            <span></span>
         </div>
      </div>
   </div>
</header>

<div class="site-responsive-menu">
   <div class="container-xl">
      <?php if ($enable_search): ?>
         <div class="menu-search">
            <div class="flex-layout flex-align-center">
               <?php get_search_form(); ?>
            </div>
         </div>
      <?php endif; ?>
      <?php if (has_nav_menu('header')): ?>
         <div class="main-menu">
            <?php wp_nav_menu(array('theme_location' => 'header', 'container' => false, 'walker' => new Submenu_Wrap)); ?>
         </div>
      <?php endif; ?>
      <?php if (!empty($header_button['url']) && !empty($header_button['title'])): ?>
         <div class="button-group flex-justify-start">
            <a class="button" href="<?php echo $header_button['url']; ?>" target="<?php echo $header_button['target']; ?>" title="<?php echo $header_button['title']; ?>"><?php echo $header_button['title']; ?></a>
         </div>
      <?php endif; ?>
   </div>
</div>

<?php if ($enable_search): ?>
   <div class="site-search">
      <div class="container-sm flex-layout flex-align-center">
         <?php get_search_form(); ?>
         <div class="close-search"><?php include_asset('icon-close.svg'); ?></div>
      </div>
   </div>
<?php endif; ?>

<main class="site-main">

<?php if ($enable_breadcrumbs): get_breadcrumbs(); endif; ?>
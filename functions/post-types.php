<?php

/*-----------------------------------------------------------------------
   Register custom post types
-----------------------------------------------------------------------*/

function register_custom_post_types() {
   /* Post Type: Services */

   $labels = array(
      'name'                  => __('Services'),
      'menu_name'             => __('Services'),
      'singular_name'         => __('Service'),
      'name_admin_bar'        => __('Services'),
      'add_new'               => __('Add New Service'),
      'add_new_item'          => __('Add New'),
      'new_item'              => __('New Service'),
      'edit_item'             => __('Edit Service'),
      'all_items'             => __('All Services'),
      'view_items'            => __('View Services'),
   );
   $args = array(
      'labels'                => $labels,
      'capability_type'       => 'post',
      'public'                => true,
      'publicly_queryable'    => true,
      'show_ui'               => true,
      'show_in_menu'          => true,
      'query_var'             => true,
      'has_archive'           => true,
      'hierarchical'          => true,
      'menu_position'         => null,
      'exclude_from_search'   => false,
      'show_in_rest'          => true,
      'menu_icon'             => 'dashicons-sos',
      'rewrite'               => array('slug' => 'service'),
      'supports'              => array('title', 'thumbnail', 'excerpt', 'editor')
   );
   register_post_type('service', $args);

   /* "Services" Taxonomy: Category */

   $labels = array(
      'name'                  => __('Categories'),
      'menu_name'             => __('Categories'),
      'singular_name'         => __('Category'),
      'add_new_item'          => __('Add New Category'),
      'all_items'             => __('All Categories'),
   );

   $args = array(
      'labels'                => $labels,
      'hierarchical'          => true,
      'public'                => true,
      'show_ui'               => true,
      'show_admin_column'     => true,
      'query_var'             => true,
      'show_in_rest'          => true,
      'rewrite'               => array('slug' => 'service-category'),
   );
   register_taxonomy('service-category', 'service', $args);
  
   /* Post Type: Reviews */

   $labels = array(
      'name'                  => __('Reviews'),
      'menu_name'             => __('Reviews'),
      'singular_name'         => __('Review'),
      'name_admin_bar'        => __('Reviews'),
      'add_new'               => __('Add New Review'),
      'add_new_item'          => __('Add New'),
      'new_item'              => __('New Review'),
      'edit_item'             => __('Edit Review'),
      'all_items'             => __('All Reviews'),
      'view_items'            => __('View Reviews'),
   );
   $args = array(
      'labels'                => $labels,
      'capability_type'       => 'post',
      'public'                => false,
      'publicly_queryable'    => true,
      'show_ui'               => true,
      'show_in_menu'          => true,
      'query_var'             => true,
      'has_archive'           => false,
      'hierarchical'          => true,
      'menu_position'         => null,
      'exclude_from_search'   => false,
      'show_in_rest'          => true,
      'menu_icon'             => 'dashicons-admin-comments',
      'rewrite'               => false,
      'supports'              => array('title', 'thumbnail')
   );
   register_post_type('review', $args);
}
add_action('init', 'register_custom_post_types', 0);
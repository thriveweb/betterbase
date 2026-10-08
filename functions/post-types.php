<?php

/*-----------------------------------------------------------------------
    Setup "Service" CPT
-----------------------------------------------------------------------*/

function betterbase_service_cpt() {
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
        'view_item'             => __('View Service'),
    );
    $args = array(
        'labels'                => $labels,
        'capability_type'       => 'post',
        'public'                => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'query_var'             => true,
        'has_archive'           => 'services',
        'hierarchical'          => false,
        'menu_position'         => null,
        'exclude_from_search'   => false,
        'show_in_rest'          => true,
        'menu_icon'             => 'dashicons-hammer',
        'rewrite'               => array('slug' => 'service'),
        'supports'              => array('title', 'thumbnail', 'excerpt', 'editor'),
    );
    register_post_type('service', $args);

    /* Taxonomy: Category */
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
}

/*-----------------------------------------------------------------------
    Setup "Testimonial" CPT
-----------------------------------------------------------------------*/

function betterbase_testimonial_cpt() {
    $labels = array(
        'name'                  => __('Testimonials'),
        'menu_name'             => __('Testimonials'),
        'singular_name'         => __('Testimonial'),
        'name_admin_bar'        => __('Testimonials'),
        'add_new'               => __('Add New Testimonial'),
        'add_new_item'          => __('Add New'),
        'new_item'              => __('New Testimonial'),
        'edit_item'             => __('Edit Testimonial'),
        'all_items'             => __('All Testimonials'),
        'view_item'             => __('View Testimonial'),
    );
    $args = array(
        'labels'                => $labels,
        'capability_type'       => 'post',
        'public'                => false,
        'publicly_queryable'    => false,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'query_var'             => false,
        'has_archive'           => false,
        'hierarchical'          => false,
        'menu_position'         => null,
        'exclude_from_search'   => true,
        'show_in_rest'          => true,
        'menu_icon'             => 'dashicons-format-quote',
        'rewrite'               => false,
        'supports'              => array('title'),
    );
    register_post_type('testimonial', $args);
}

/*-----------------------------------------------------------------------
    Register all custom post types
-----------------------------------------------------------------------*/

function betterbase_register_custom_post_types() {
    betterbase_service_cpt();
    betterbase_testimonial_cpt();
}
add_action('init', 'betterbase_register_custom_post_types', 0);
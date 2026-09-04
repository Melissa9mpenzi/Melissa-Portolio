<?php
// Function to create separate categories for pages
function register_page_categories() {
    // Register a new taxonomy specifically for pages
    register_taxonomy(
        'page_category',  // Taxonomy name
        'page',           // Object type (pages)
        array(
            'hierarchical' => true,
            'label' => 'Page Categories',
            'query_var' => true,
            'rewrite' => array('slug' => 'page-category'),
            'show_admin_column' => true,
            'public' => true,
            'show_in_rest' => true
        )
    );
}
add_action('init', 'register_page_categories', 0);

// Remove the standard category taxonomy from pages
function remove_categories_from_pages() {
    unregister_taxonomy_for_object_type('category', 'page');
}
add_action('init', 'remove_categories_from_pages');

// Modify queries to keep post and page categories separate
function separate_post_page_categories($query) {
    if (!is_admin() && $query->is_main_query()) {
        // For post category archives, only show posts
        if ($query->is_category()) {
            $query->set('post_type', 'post');
        }
        // For page category archives, only show pages
        elseif ($query->is_tax('page_category')) {
            $query->set('post_type', 'page');
        }
    }
}
add_action('pre_get_posts', 'separate_post_page_categories');
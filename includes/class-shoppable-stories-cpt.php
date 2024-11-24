<?php

// Exit if accessed directly for security.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class to register the custom post type for Shoppable Stories.
 */
class Shoppable_Stories_CPT {

    /**
     * Hook into WordPress to register the custom post type.
     */
    public function init() {
        add_action( 'init', [ $this, 'register_cpt' ] );
    }

    /**
     * Register the 'shoppable_story' custom post type.
     */
    public function register_cpt() {
        $labels = [
            'name'          => 'Stories', // General name for the post type.
            'singular_name' => 'Story',  // Singular name for a single post.
            'add_new'       => 'Add New Story', // Button text in the admin area.
            'edit_item'     => 'Edit Story', // Edit screen title.
        ];

        $args = [
            'labels'             => $labels,
            'public'             => true, // Make it publicly accessible.
            'has_archive'        => true, // Enable archive pages.
            'menu_icon'          => 'dashicons-format-gallery', // Icon for the admin menu.
            'supports'           => [ 'title' ], // Enable basic editing features.
            'show_in_rest'       => false, // Enable Gutenberg support.
        ];

        // Register the custom post type.
        register_post_type( 'shoppable_story', $args );
    }
}

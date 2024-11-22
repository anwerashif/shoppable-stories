<?php

// Exit if accessed directly for security.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class for adding admin functionality for Shoppable Stories.
 */
class Shoppable_Stories_Admin {

    /**
     * Hook into WordPress for admin-specific tasks.
     */
    public function init() {
        // Add custom meta boxes for tagging products.
        add_action( 'add_meta_boxes', [ $this, 'add_meta_boxes' ] );
        // Save metadata when a post is saved.
        add_action( 'save_post', [ $this, 'save_meta' ] );
    }

    /**
     * Add a meta box to tag WooCommerce products to stories.
     */
    public function add_meta_boxes() {
        add_meta_box(
            'shoppable_story_products', // Meta box ID.
            'Tag Products', // Meta box title.
            [ $this, 'render_meta_box' ], // Callback to render the meta box.
            'shoppable_story', // Post type.
            'side', // Display location.
            'default' // Priority.
        );
    }

    /**
     * Render the meta box content.
     *
     * @param WP_Post $post The current post object.
     */
    public function render_meta_box( $post ) {
        // Add a nonce field for security.
        wp_nonce_field( 'shoppable_story_nonce', 'shoppable_story_nonce_field' );

        // Get existing tagged product IDs.
        $product_ids = get_post_meta( $post->ID, '_tagged_products', true );

        // Display a field for entering product IDs.
        echo '<label for="tagged_products">Product IDs (comma-separated):</label>';
        echo '<input type="text" id="tagged_products" name="tagged_products" value="' . esc_attr( $product_ids ) . '" />';
    }

    /**
     * Save metadata when the post is saved.
     *
     * @param int $post_id The ID of the current post.
     */
    public function save_meta( $post_id ) {
        // Verify nonce for security.
        if ( ! isset( $_POST['shoppable_story_nonce_field'] ) || ! wp_verify_nonce( $_POST['shoppable_story_nonce_field'], 'shoppable_story_nonce' ) ) {
            return;
        }

        // Save the tagged products data.
        if ( isset( $_POST['tagged_products'] ) ) {
            update_post_meta( $post_id, '_tagged_products', sanitize_text_field( $_POST['tagged_products'] ) );
        }
    }
}

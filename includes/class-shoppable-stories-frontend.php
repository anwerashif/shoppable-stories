<?php

// Exit if accessed directly for security.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class for front-end display of Shoppable Stories.
 */
class Shoppable_Stories_Frontend {

    /**
     * Hook into WordPress for front-end functionality.
     */
    public function init() {
        // Register a shortcode to display stories.
        add_shortcode( 'shoppable_stories', [ $this, 'render_stories' ] );
        // Enqueue front-end styles and scripts.
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
    }

    /**
     * Enqueue front-end styles and scripts.
     */
    public function enqueue_scripts() {
        wp_enqueue_style( 'shoppable-stories-style', SHOPPABLE_STORIES_URL . 'assets/css/front-style.css', [], SHOPPABLE_STORIES_VERSION );
        wp_enqueue_script( 'shoppable-stories-script', SHOPPABLE_STORIES_URL . 'assets/js/front-script.js', [ 'jquery' ], SHOPPABLE_STORIES_VERSION, true );
    }

    /**
     * Render stories on the front-end using a shortcode.
     *
     * @return string HTML for the stories.
     */
    public function render_stories() {
        // Query for all published stories.
        $stories = new WP_Query( [ 'post_type' => 'shoppable_story' ] );
        ob_start();

        if ( $stories->have_posts() ) {
            echo '<div class="shoppable-stories-carousel">';
            while ( $stories->have_posts() ) {
                $stories->the_post();
                // Include a template for each story.
                include SHOPPABLE_STORIES_PATH . 'templates/front-story-template.php';
            }
            echo '</div>';
        }

        wp_reset_postdata();

        // Return the output buffer content.
        return ob_get_clean();
    }
}

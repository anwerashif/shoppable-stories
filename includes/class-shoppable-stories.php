<?php

// Exit if accessed directly for security.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Main class for the Shoppable Stories plugin.
 * This class initializes all components of the plugin.
 */
class Shoppable_Stories {

    /**
     * Constructor: Load dependencies for the plugin.
     */
    public function __construct() {
        require_once SHOPPABLE_STORIES_PATH . 'includes/class-shoppable-stories-cpt.php'; // Custom Post Type logic.
        require_once SHOPPABLE_STORIES_PATH . 'includes/class-shoppable-stories-frontend.php'; // Front-end display logic.
        require_once SHOPPABLE_STORIES_PATH . 'includes/class-shoppable-stories-admin.php'; // Admin dashboard functionality.
        require_once SHOPPABLE_STORIES_PATH . 'includes/meta-boxes.php'; // Custom Post Type Meta Boxes
    }

    /**
     * Initialize all plugin components.
     */
    public function run() {
        // Initialize the custom post type logic.
        $cpt = new Shoppable_Stories_CPT();
        $cpt->init();

        // Initialize the front-end functionality.
        $frontend = new Shoppable_Stories_Frontend();
        $frontend->init();

        // Initialize the admin panel functionality.
        $admin = new Shoppable_Stories_Admin();
        $admin->init();
    }

    /**
     * Get the full URL for an asset in the plugin.
     *
     * @param string $relative_path The relative path to the asset (e.g., 'assets/img/Polygon_3_1.png').
     * @return string The full URL to the asset.
     */
    public function get_asset_url($relative_path) {
        return SHOPPABLE_STORIES_URL . $relative_path;
    }
}

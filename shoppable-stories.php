<?php
/**
 * Plugin Name: Shoppable Stories
 * Plugin URI: https://example.com
 * Description: A plugin to create and display shoppable stories with WooCommerce integration.
 * Version: 1.0.0
 * Author: Your Name
 * Author URI: https://example.com
 * Text Domain: shoppable-stories
 * Domain Path: /languages
 */

// Prevent direct access to the file for security.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define constants for the plugin's version, path, and URL.
define( 'SHOPPABLE_STORIES_VERSION', '1.0.0' );
define( 'SHOPPABLE_STORIES_PATH', plugin_dir_path( __FILE__ ) );
define( 'SHOPPABLE_STORIES_URL', plugin_dir_url( __FILE__ ) );

// Include the main plugin class file.
require_once SHOPPABLE_STORIES_PATH . 'includes/class-shoppable-stories.php';

// Initialize the plugin.
function shoppable_stories_init() {
    // Create an instance of the main plugin class and run it.
    $plugin_instance = new Shoppable_Stories();
    $plugin_instance->run();
}
// Hook the initialization function to the 'plugins_loaded' action.
add_action( 'plugins_loaded', 'shoppable_stories_init' );

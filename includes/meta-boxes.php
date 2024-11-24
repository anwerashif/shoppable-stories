<?php
/**
 * Shoppable Stories Meta Boxes
 *
 * Handles the custom meta box for Shoppable Stories custom post type.
 */

// Hook to enqueue media uploader scripts
add_action('admin_enqueue_scripts', 'enqueue_media_uploader_scripts');

// Hook to add the meta box
add_action('add_meta_boxes', 'shoppable_story_meta_box');

// Hook to save the meta box data
add_action('save_post', 'save_shoppable_story_meta');

/**
 * Enqueue Media Uploader Scripts.
 *
 * @param string $hook The current admin page.
 */
function enqueue_media_uploader_scripts($hook) {
    // Ensure scripts are loaded only on the Shoppable Story edit screen
    global $post_type;
    if ($post_type === 'shoppable_story') {
        wp_enqueue_media(); // Enqueue the WordPress Media Library uploader
        wp_enqueue_script(
            'shoppable-story-media-uploader',
            plugin_dir_url(__FILE__) . '../assets/js/media-uploader.js', // Path to your custom JS file
            array('jquery'), // Dependencies
            '1.0', // Version
            true // Load in footer
        );
    }
}

/**
 * Adds the Shoppable Story meta box.
 */
function shoppable_story_meta_box() {
    add_meta_box(
        'shoppable_story_meta_box',
        'Shoppable Story Details',
        'render_shoppable_story_meta_box',
        'shoppable_story',
        'normal',
        'high'
    );
}

/**
 * Renders the Shoppable Story meta box.
 *
 * @param WP_Post $post The current post object.
 */
function render_shoppable_story_meta_box($post) {
    // Retrieve existing metadata if available
    $thumbnail = get_post_meta($post->ID, '_story_thumbnail', true);
    $summary = get_post_meta($post->ID, '_story_summary', true);
    $product_id = get_post_meta($post->ID, '_story_product', true);
    $button_text = get_post_meta($post->ID, '_story_button_text', true);

    // Nonce for verification
    wp_nonce_field('shoppable_story_meta_box_nonce', 'shoppable_story_nonce');

    // WooCommerce products for the dropdown
    $products = wc_get_products(array('limit' => -1));
    ?>
    <div style="display: flex; gap: 20px;">
        <!-- Left Column: Thumbnail/Video -->
        <div style="flex: 1;">
            <label for="thumbnail">Thumbnail / Video</label>
            <input type="hidden" id="thumbnail" name="thumbnail" value="<?php echo esc_attr($thumbnail); ?>" />
            <button type="button" class="button shoppable-story-media-upload">Upload Media</button>
            <div class="thumbnail-preview" style="margin-bottom: 10px;">
                <?php if ($thumbnail): ?>
                    <?php
                    $filetype = wp_check_filetype($thumbnail);
                    if (strpos($filetype['type'], 'video') !== false): ?>
                        <video controls style="max-width: 100%; height: auto;">
                            <source src="<?php echo esc_url($thumbnail); ?>" type="<?php echo esc_attr($filetype['type']); ?>">
                            Your browser does not support the video tag.
                        </video>
                    <?php else: ?>
                        <img src="<?php echo esc_url($thumbnail); ?>" style="max-width: 100%; height: auto;" />
                    <?php endif; ?>
                <?php else: ?>
                    <p>No media uploaded yet.</p>
                <?php endif; ?>
            </div>

            <button type="button" class="button shoppable-story-media-upload">
                <?php echo $thumbnail ? 'Replace Media' : 'Upload Media'; ?>
            </button>

            <?php if ($thumbnail): ?>
                <button type="button" class="button shoppable-story-media-remove" style="margin-left: 10px;">Remove Media</button>
            <?php endif; ?>
            <p class="description">Upload or select a photo/video from the Media Library.</p>
        </div>

        <!-- Right Column: Summary and Product Selector -->
        <div style="flex: 1;">
            <label for="summary">Summary</label>
            <textarea id="summary" name="summary" class="widefat" rows="5"><?php echo esc_textarea($summary); ?></textarea>
            <p class="description">Enter a short description or summary for the story.</p>

            <label for="product_id">Link to WooCommerce Product</label>
            <select id="product_id" name="product_id" class="widefat">
                <option value="">-- Select a Product --</option>
                <?php foreach ($products as $product): ?>
                    <option value="<?php echo esc_attr($product->get_id()); ?>" <?php selected($product_id, $product->get_id()); ?>>
                        <?php echo esc_html($product->get_name()); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <p class="description">Select a WooCommerce product to tag in the story.</p>

            <label for="button_text">Button Text</label>
            <input type="text" id="button_text" name="button_text" class="widefat" value="<?php echo esc_attr($button_text); ?>" />
            <p class="description">Customize the "Add to Cart" button text (e.g., "Shop Now").</p>
        </div>
    </div>
    <?php
}

/**
 * Saves the custom meta box data.
 *
 * @param int $post_id The ID of the post being saved.
 * @return int The post ID.
 */
function save_shoppable_story_meta($post_id) {
    // Check if nonce is set and valid
    if (!isset($_POST['shoppable_story_nonce']) || !wp_verify_nonce($_POST['shoppable_story_nonce'], 'shoppable_story_meta_box_nonce')) {
        return $post_id;
    }

    // Avoid autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    // Check if user has permission to edit
    if (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }

    // Save metadata
    if (isset($_POST['thumbnail'])) {
        update_post_meta($post_id, '_story_thumbnail', esc_url_raw($_POST['thumbnail']));
    }

    if (isset($_POST['summary'])) {
        update_post_meta($post_id, '_story_summary', sanitize_textarea_field($_POST['summary']));
    }

    if (isset($_POST['product_id'])) {
        update_post_meta($post_id, '_story_product', sanitize_text_field($_POST['product_id']));
    }

    if (isset($_POST['button_text'])) {
        update_post_meta($post_id, '_story_button_text', sanitize_text_field($_POST['button_text']));
    }
}
<?php
/**
 * Template for displaying a single Shoppable Story.
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Get the current post's ID
$post_id = get_the_ID();

// Retrieve custom field values
$thumbnail = get_post_meta($post_id, '_story_thumbnail', true);
$summary = get_post_meta($post_id, '_story_summary', true);
$product_id = get_post_meta($post_id, '_story_product', true);
$button_text = get_post_meta($post_id, '_story_button_text', true);

// Get product details if a product is linked
$product = $product_id ? wc_get_product($product_id) : null;
$product_url = $product ? get_permalink($product_id) : '#';
$product_name = $product ? $product->get_name() : 'No product linked';

// Determine file type for thumbnail
$filetype = $thumbnail ? wp_check_filetype($thumbnail) : null;
?>
<div class="shoppable-story">
    <?php if ($thumbnail): ?>
        <div class="story-thumbnail">
            <?php if ($filetype && strpos($filetype['type'], 'video') !== false): ?>
                <video controls style="max-width: 100%; height: auto;">
                    <source src="<?php echo esc_url($thumbnail); ?>" type="<?php echo esc_attr($filetype['type']); ?>">
                    Your browser does not support the video tag.
                </video>
            <?php else: ?>
                <img src="<?php echo esc_url($thumbnail); ?>" alt="Story Thumbnail" style="max-width: 100%; height: auto;" />
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if ($summary): ?>
        <div class="story-summary">
            <p><?php echo esc_html($summary); ?></p>
        </div>
    <?php endif; ?>

    <?php if ($product): ?>
        <div class="story-product">
            <p>Linked Product: <a href="<?php echo esc_url($product_url); ?>" target="_blank"><?php echo esc_html($product_name); ?></a></p>
        </div>
    <?php endif; ?>

    <?php if ($button_text && $product): ?>
        <div class="story-action">
            <a href="<?php echo esc_url(add_query_arg('add-to-cart', $product_id, wc_get_cart_url())); ?>" class="button">
                <?php echo esc_html($button_text); ?>
            </a>
        </div>
    <?php endif; ?>
</div>

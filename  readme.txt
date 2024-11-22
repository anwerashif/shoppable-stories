=== Shoppable Stories ===
Contributors: anwerashif  
Donate link: https://example.com/donate  
Tags: stories, woocommerce, shopping, products, ecommerce  
Requires at least: 5.0  
Tested up to: 6.4  
Requires PHP: 7.4  
Stable tag: 1.0.0  
License: GPLv2 or later  
License URI: https://www.gnu.org/licenses/gpl-2.0.html  

Create engaging, interactive stories with integrated WooCommerce products to enhance your store's user experience and drive conversions.

== Description ==

**Shoppable Stories** allows you to create and display interactive stories that integrate directly with WooCommerce products. Engage your audience with visually appealing stories and make them instantly shoppable, increasing your eCommerce conversions.

### Key Features:
- **Custom Post Type**: Create and manage "shoppable stories" as a dedicated post type.
- **WooCommerce Integration**: Tag products to stories and link directly to product pages.
- **Frontend Display**: Showcase stories in a carousel or grid layout with easy navigation.
- **Admin Panel Features**: Add and manage stories with a simple interface in your WordPress dashboard.
- **Responsive Design**: Fully optimized for mobile, tablet, and desktop viewing.

== Installation ==

1. **Upload the Plugin**  
   - Download the plugin zip file.  
   - Go to the WordPress dashboard, navigate to `Plugins > Add New`, and click `Upload Plugin`.  
   - Select the zip file and click "Install Now".  

2. **Activate the Plugin**  
   - Once installed, click `Activate Plugin`.

3. **Create Stories**  
   - Navigate to `Stories > Add New` in your WordPress dashboard.  
   - Add a title, content, and tag WooCommerce products to the story.  

4. **Display Stories**  
   - Use the `[shoppable_stories]` shortcode to display stories on any page or post.  
   - Alternatively, integrate it into your theme using `do_shortcode()`.

== Frequently Asked Questions ==

= How do I tag WooCommerce products to a story? =  
When creating or editing a story, use the "Tag Products" meta box on the right side of the editor. Enter WooCommerce product IDs (comma-separated).

= How do I display stories on my website? =  
You can use the `[shoppable_stories]` shortcode on any page or post. Alternatively, add it to your theme template using `echo do_shortcode('[shoppable_stories]')`.

= Is this plugin compatible with all themes? =  
Yes, Shoppable Stories works with any WooCommerce-compatible theme. Some styling adjustments may be needed for custom themes.

= Can I customize the look and feel of stories? =  
Yes, you can modify the plugin's CSS file located in `assets/css/front-style.css`. You can also override the `front-story-template.php` template in your theme.

== Screenshots ==

1. **Add New Story**: Easily create a new shoppable story in the admin dashboard.  
2. **Story with Tagged Products**: Frontend display of a story with linked products.  
3. **Responsive Stories Carousel**: Stories displayed in a sleek, responsive carousel.

== Changelog ==

= 1.0.0 =  
* Initial release.  
* Added custom post type for stories.  
* Integrated WooCommerce for product tagging.  
* Shortcode for front-end story display.  
* Admin meta box for product tagging.  

== Upgrade Notice ==

= 1.0.0 =  
This is the first release of Shoppable Stories. Upgrade safely for future improvements and features.

== License ==

This plugin is licensed under the GPLv2 or later.  
For more information, visit [https://www.gnu.org/licenses/gpl-2.0.html](https://www.gnu.org/licenses/gpl-2.0.html).

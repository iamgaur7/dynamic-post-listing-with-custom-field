=== Dynamic Post Listing with Custom Field ===
Contributors: naveen.developer
Tags: elementor, posts, custom fields, grid, pagination
Requires at least: 5.0
Tested up to: 6.8
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

An Elementor widget to display dynamic post listings with custom fields, grid layout, pagination, and flexible display options.

== Description ==

The **Dynamic Post Listing with Custom Field** plugin provides a powerful Elementor widget to display WordPress posts in a customizable grid layout. With support for custom fields (via Advanced Custom Fields), pagination, and various display options, this widget is perfect for creating dynamic post listings on your Elementor-powered website.

### Features
- **Flexible Post Selection**: Display posts from a specific category or all categories.
- **Exclude Posts**: Exclude specific post IDs from the listing.
- **Grid Layout**: Choose 1, 2, 3, or 4 items per row for a responsive grid.
- **Pagination**: Enable pagination for category-based listings.
- **Customizable Display**: Toggle post images, excerpts, title links, read more buttons, and set custom excerpt lengths.
- **Image Sizes**: Select from all registered image sizes for post thumbnails.
- **Custom Fields**: Display custom fields (ACF) with optional labels.
- **Elementor Integration**: Seamlessly integrates with Elementor’s drag-and-drop editor.

### Requirements
- Elementor (free or pro version)
- WordPress 5.0 or higher
- PHP 7.4 or higher
- Advanced Custom Fields (optional, for custom field support)

== Installation ==

1. Upload the `dynamic-post-listing` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Ensure Elementor is installed and activated.
4. Open the Elementor editor, search for the "Dynamic Post Listing" widget under the General category, and drag it into your page.
5. Configure the widget settings (category, layout, custom fields, etc.) and save.

== Frequently Asked Questions ==

= Does this plugin require Elementor? =
Yes, this plugin is an Elementor widget and requires Elementor to function.

= Can I use it without Advanced Custom Fields (ACF)? =
Yes, the plugin works without ACF. Custom fields are optional and only displayed if ACF is active and configured.

= How do I exclude specific posts? =
In the widget settings, enter comma-separated post IDs in the "Exclude Post IDs" field (e.g., 1,2,3). Limit to 10 IDs for optimal performance.

= Does it support pagination? =
Yes, you can enable pagination for category-based listings in the widget settings.

= Can I link the post title or add a read more button? =
Yes, use the "Link Post Title" and "Show Read More Button" options in the Post Settings to enable links to the full article.

== Screenshots ==

1. Widget settings in Elementor editor showing post, layout, and custom field options.
2. Frontend view of a 3-column grid layout with images, excerpts, read more buttons, and custom fields.
3. Pagination example on a category-based post listing.

== Changelog ==

= 1.0.0 =
* Initial release with post listing, grid layout, pagination, and custom field support.
* Added option to show a "Read More" button linking to the full article.
* Added option to toggle a link on the post title to the full article.
* Implemented secure pagination output with escaped links.
* Removed external placeholder image in Elementor content template.
* Replaced post__not_in with post__in and preliminary query for better performance.
* Added robust Elementor dependency checks to prevent Widget_Base errors.
* Standardized text domain to dynamic-post-listing-with-custom-field for translation consistency.
* Updated function and constant prefixes from DPL to DPLWCF for consistency and clarity.

== Upgrade Notice ==

= 1.0.0 =
Initial release of Dynamic Post Listing with Custom Field. Install to create dynamic post listings with Elementor, featuring custom fields, grid layouts, pagination, read more buttons, and title links.

== License ==
This plugin is licensed under the GPLv2 or later. See the License URI for details.
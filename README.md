# Dynamic Post Listing with Custom Field

An Elementor widget to display dynamic post listings with custom fields, grid layouts, pagination, and flexible display options.

![WordPress version](https://img.shields.io/badge/WordPress-5.0%2B-blue)
![Tested up to](https://img.shields.io/badge/Tested%20Up%20To-6.8-brightgreen)
![PHP version](https://img.shields.io/badge/PHP-7.4%2B-orange)
![License](https://img.shields.io/badge/License-GPLv2%20or%20later-blue)

---

## Features

- 🔍 **Flexible Post Selection**: Display posts from specific or all categories.
- 🛑 **Exclude Posts**: Filter out specific post IDs from the list.
- 🧱 **Grid Layout**: Choose from 1, 2, 3, or 4-column layouts.
- 🔄 **Pagination**: Enable paginated results for better UX.
- 🧰 **Customizable Display**: Toggle image, excerpt, title links, and "Read More" button.
- 🖼️ **Image Sizes**: Choose any registered thumbnail size.
- 🏷️ **Custom Fields Support**: Display ACF custom fields with optional labels.
- 🎨 **Seamless Elementor Integration**: Use directly in Elementor editor with live preview.

---

## Requirements

- WordPress 5.0 or higher
- PHP 7.4 or higher
- [Elementor](https://wordpress.org/plugins/elementor/) (free or pro)
- [Advanced Custom Fields](https://wordpress.org/plugins/advanced-custom-fields/) (optional)

---

## Installation

1. Download or clone this repository.
2. Upload the folder to your `/wp-content/plugins/` directory.
3. Activate the plugin via **Plugins > Installed Plugins** in WordPress.
4. Ensure Elementor is activated.
5. In Elementor editor, search for **Dynamic Post Listing** widget under the "General" section and drag it into your layout.
6. Customize the settings including category, post layout, custom fields, and display preferences.

---

## FAQ

### ❓ Does this plugin require Elementor?
Yes, Elementor is required to use the widget.

### ❓ Can I use it without Advanced Custom Fields (ACF)?
Yes, ACF is optional. Custom fields will be shown only if ACF is active and configured.

### ❓ How do I exclude posts?
Enter comma-separated post IDs in the "Exclude Post IDs" field (e.g., `1,2,3`). Limit to 10 IDs for best performance.

### ❓ Does it support pagination?
Yes, pagination is supported for category-based listings.

### ❓ Can I link the post title or add a read more button?
Yes, both options can be enabled in the widget settings.

---

## Screenshots

1. Elementor widget settings – post type, layout, custom fields.
2. Frontend grid layout – 3 columns with images, excerpts, read more.
3. Pagination in action on category listing.

---

## Changelog

### 1.0.0
- Initial release
- Grid layout, pagination, and ACF custom field support
- “Read More” button and title link options
- Elementor widget settings
- Secure pagination
- Performance improvements with `post__in`
- Robust Elementor dependency handling
- Standardized text domain and function prefixes

---

## License

This plugin is licensed under the [GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html).

---

## Author

Developed by [Naveen Gaur](http://github.com/iamgaur7)

Contributions, issues, and feature requests welcome!
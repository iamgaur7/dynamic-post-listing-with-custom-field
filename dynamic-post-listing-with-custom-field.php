<?php
/**
 * Plugin Name: Dynamic Post Listing with Custom Field
 * Plugin URI: https://techwithnavi.com/
 * Description: An Elementor widget to display dynamic post listings with custom fields, grid layout, pagination, and flexible display options.
 * Version: 1.0.0
 * Author: Naveen Gaur
 * Author URI: https://techwithnavi.com
 * License: GPL-2.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: dynamic-post-listing-with-custom-field
 * Requires Plugins: elementor
 * Requires at least: 5.0
 * Tested up to: 6.8
 * Requires PHP: 7.4
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Prevent direct file access.
}

// Define constants for plugin file, directory, URL, and version.
define( 'DPLWCF_PLUGIN_FILE', __FILE__ );
define( 'DPLWCF_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'DPLWCF_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'DPLWCF_VERSION', '1.0.0' );

/**
 * Check if Elementor is active and its required files/classes exist.
 *
 * Displays admin notices if Elementor is not properly installed or active.
 *
 * @return bool
 */
function dplwcf_check_elementor() {
    // Check if Elementor has fully loaded.
    if ( ! did_action( 'elementor/loaded' ) ) {
        add_action( 'admin_notices', function() {
            ?>
            <div class="notice notice-error">
                <p><?php esc_html_e( 'Dynamic Post Listing with Custom Field requires Elementor to be installed and activated.', 'dynamic-post-listing-with-custom-field' ); ?></p>
            </div>
            <?php
        } );
        return false;
    }

    // Verify Elementor's widget base file exists (use relative path from plugin dir).
    $elementor_widget_base_file = plugin_dir_path( DPLWCF_PLUGIN_FILE ) . '../elementor/includes/base/widget-base.php';
    if ( ! file_exists( $elementor_widget_base_file ) ) {
        add_action( 'admin_notices', function() {
            ?>
            <div class="notice notice-error">
                <p><?php esc_html_e( 'Elementor installation is incomplete. The widget-base.php file is missing. Please reinstall Elementor.', 'dynamic-post-listing-with-custom-field' ); ?></p>
            </div>
            <?php
        } );
        return false;
    }

    // Ensure the core Widget_Base class is loaded.
    if ( ! class_exists( '\Elementor\Widget_Base' ) ) {
        add_action( 'admin_notices', function() {
            ?>
            <div class="notice notice-error">
                <p><?php esc_html_e( 'Elementor is active, but the Widget_Base class could not be found. This may be due to a corrupted installation or plugin conflict. Please reinstall Elementor or disable other plugins to identify conflicts.', 'dynamic-post-listing-with-custom-field' ); ?></p>
            </div>
            <?php
        } );
        return false;
    }

    return true; // All checks passed.
}

/**
 * Initialize the plugin only when Elementor is fully loaded and verified.
 */
add_action( 'elementor/init', function() {
    if ( dplwcf_check_elementor() ) {

        // Include the widget class file.
        require_once DPLWCF_PLUGIN_DIR . 'includes/class-dynamic-post-listing-widget.php';

        // Enqueue plugin-specific CSS for frontend display.
        add_action( 'wp_enqueue_scripts', function() {
            wp_enqueue_style(
                'dplwcf-styles',
                DPLWCF_PLUGIN_URL . 'assets/css/dynamic-post-listing.css',
                [],
                DPLWCF_VERSION
            );
        } );

        // Register the custom Elementor widget with Elementor's widget manager.
        add_action( 'elementor/widgets/register', function( $widgets_manager ) {
            $widgets_manager->register( new Dynamic_Post_Listing_With_Custom_Field_Widget() );
        } );
    }
}, 20 ); // Use priority 20 to ensure Elementor has fully loaded.

/**
 * Show debug information in admin area when WP_DEBUG is enabled.
 * Helps developers during development or troubleshooting.
 */
add_action( 'admin_notices', function() {
    if ( defined( 'WP_DEBUG' ) && WP_DEBUG && current_user_can( 'manage_options' ) ) {
        $elementor_loaded = did_action( 'elementor/loaded' ) ? 'Yes' : 'No';
        $widget_base_exists = class_exists( '\Elementor\Widget_Base' ) ? 'Yes' : 'No';
        $elementor_version = defined( 'ELEMENTOR_VERSION' ) ? ELEMENTOR_VERSION : 'Not detected';
        $widget_base_file = file_exists( plugin_dir_path( DPLWCF_PLUGIN_FILE ) . '../elementor/includes/base/widget-base.php' ) ? 'Exists' : 'Missing';
        ?>
        <div class="notice notice-info">
            <p><?php esc_html_e( 'Dynamic Post Listing Debug Info:', 'dynamic-post-listing-with-custom-field' ); ?></p>
            <ul>
                <li><?php esc_html_e( 'Elementor Loaded: ', 'dynamic-post-listing-with-custom-field' ); ?><?php echo esc_html( $elementor_loaded ); ?></li>
                <li><?php esc_html_e( 'Elementor\Widget_Base Exists: ', 'dynamic-post-listing-with-custom-field' ); ?><?php echo esc_html( $widget_base_exists ); ?></li>
                <li><?php esc_html_e( 'Elementor Version: ', 'dynamic-post-listing-with-custom-field' ); ?><?php echo esc_html( $elementor_version ); ?></li>
                <li><?php esc_html_e( 'Widget Base File: ', 'dynamic-post-listing-with-custom-field' ); ?><?php echo esc_html( $widget_base_file ); ?></li>
            </ul>
        </div>
        <?php
    }
} );

<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.jackcooc.com
 * @since             1.0.0
 * @package           Mark_Media_Plugin
 *
 * @wordpress-plugin
 * Plugin Name:       Mark Media
 * Plugin URI:        markmedia.co
 * Description:       Custom plugin with the most used functions such as jQuery from CDN, slug class in the body, custom media sizes, Media URl replacement
 * Version:           1.0.0
 * Author:            Jack Cooc
 * Author URI:        http://www.jackcooc.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       mark-media-plugin
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-mark-media-plugin-activator.php
 */
function activate_mark_media_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mark-media-plugin-activator.php';
	Mark_Media_Plugin_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-mark-media-plugin-deactivator.php
 */
function deactivate_mark_media_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mark-media-plugin-deactivator.php';
	Mark_Media_Plugin_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_mark_media_plugin' );
register_deactivation_hook( __FILE__, 'deactivate_mark_media_plugin' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-mark-media-plugin.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_mark_media_plugin() {

	$plugin = new Mark_Media_Plugin();
	$plugin->run();

}
run_mark_media_plugin();

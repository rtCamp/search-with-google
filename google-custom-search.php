<?php
/**
 * Plugin Name: Search with Google
 * Description: Replace WordPress default search with Google Custom Search results.
 * Version:     1.0
 * Author:      rtCamp
 * Author URI:  https://rtCamp.com
 * License:     GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: search-with-google
 *
 * @package  search-with-google
 */

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

if ( ! defined( 'GOOGLE_CUSTOM_SEARCH_PATH' ) ) {
	define( 'GOOGLE_CUSTOM_SEARCH_PATH', __DIR__ );
}

require_once GOOGLE_CUSTOM_SEARCH_PATH . '/inc/helpers/autoloader.php';

/**
 * To load plugin manifest class.
 *
 * @return void
 */
function google_custom_search_plugin_loader() {
	\RT\Google_Custom_Search\Inc\Plugin::get_instance();
}

google_custom_search_plugin_loader();

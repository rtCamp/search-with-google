<?php
/**
 * Plugin Name: Search with Google
 * Description: Replace WordPress default search with Google Custom Search results.
 * Version:     1.1
 * Author:      rtCamp
 * Author URI:  https://rtCamp.com
 * License:     GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: search-with-google
 * Requires PHP: 7.4
 * Requires at least: 4.8
 *
 * @package search-with-google
 */

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

if ( ! defined( 'SEARCH_WITH_GOOGLE_PATH' ) ) {
	define( 'SEARCH_WITH_GOOGLE_PATH', __DIR__ );
}

if ( ! defined( 'SEARCH_WITH_GOOGLE_URL' ) ) {
	define( 'SEARCH_WITH_GOOGLE_URL', plugins_url( '', __FILE__ ) );
}

require_once SEARCH_WITH_GOOGLE_PATH . '/inc/helpers/autoloader.php';

/**
 * To load plugin manifest class.
 *
 * @return void
 */
function search_with_google_plugin_loader() {
	\RT\Search_With_Google\Inc\Plugin::get_instance();
}

search_with_google_plugin_loader();

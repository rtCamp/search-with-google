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
 * @package SearchWithGoogle
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'SEARCH_WITH_GOOGLE_VERSION', '1.1' );
define( 'SEARCH_WITH_GOOGLE_PATH', plugin_dir_path( __FILE__ ) );
define( 'SEARCH_WITH_GOOGLE_URL', plugin_dir_url( __FILE__ ) );

/**
 * Autoload the necessary classes.
 */
require_once SEARCH_WITH_GOOGLE_PATH . 'inc/helpers/autoloader.php';

/**
 * Initialize the plugin.
 *
 * @return void
 */
function search_with_google_plugin_loader() {
	if ( class_exists( '\RT\Search_With_Google\Inc\Plugin' ) ) {
		\RT\Search_With_Google\Inc\Plugin::get_instance();
	}
}

add_action( 'plugins_loaded', 'search_with_google_plugin_loader' );


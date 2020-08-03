<?php
/**
 * Plugin Name: Custom Google Search.
 * Description: A fast and flexible search and query engine for WordPress.
 * Version:     1.0
 * Author:      rtCamp, kiranpotphode
 * Author URI:  http://rtCamp.com
 * License:     GPLv2 or later
 * Text Domain: custom-google-search
 *
 * @package  custom-google-search
 */

if ( ! defined( 'CUSTOM_GOOGLE_SEARCH_VER' ) ) {
	define( 'CUSTOM_GOOGLE_SEARCH_VER', '0.1' );
}

if ( ! defined( 'CUSTOM_GOOGLE_SEARCH_DIR' ) ) {
	define( 'CUSTOM_GOOGLE_SEARCH_DIR', __DIR__ );
}

if ( ! defined( 'CUSTOM_GOOGLE_SEARCH_URL' ) ) {
	define( 'CUSTOM_GOOGLE_SEARCH_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

require_once CUSTOM_GOOGLE_SEARCH_DIR . '/trait-singleton.php';
require_once CUSTOM_GOOGLE_SEARCH_DIR . '/class-custom-google-search.php';
require_once CUSTOM_GOOGLE_SEARCH_DIR . '/class-custom-google-search-settings.php';
require_once CUSTOM_GOOGLE_SEARCH_DIR . '/class-google-custom-search-engine.php';

<?php
/**
 * Plugin Name: Google Custom Search.
 * Description: A plugin for replacing WordPress default search with Google Custom Search results.
 * Version:     1.0
 * Author:      rtCamp, kiranpotphode
 * Author URI:  http://rtCamp.com
 * License:     GPLv2 or later
 * Text Domain: google-custom-search
 *
 * @package  google-custom-search
 */

if ( ! defined( 'GOOGLE_CUSTOM_SEARCH_VER' ) ) {
	define( 'GOOGLE_CUSTOM_SEARCH_VER', '1.0' );
}

if ( ! defined( 'GOOGLE_CUSTOM_SEARCH_DIR' ) ) {
	define( 'GOOGLE_CUSTOM_SEARCH_DIR', __DIR__ );
}

if ( ! defined( 'GOOGLE_CUSTOM_SEARCH_URL' ) ) {
	define( 'GOOGLE_CUSTOM_SEARCH_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

require_once GOOGLE_CUSTOM_SEARCH_DIR . '/trait-singleton.php';
require_once GOOGLE_CUSTOM_SEARCH_DIR . '/class-google-custom-search.php';
require_once GOOGLE_CUSTOM_SEARCH_DIR . '/class-google-custom-search-settings.php';
require_once GOOGLE_CUSTOM_SEARCH_DIR . '/class-google-custom-search-engine.php';

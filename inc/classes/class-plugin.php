<?php
/**
 * Plugin manifest class.
 *
 * @package  google-custom-search
 */

namespace RT\Google_Custom_Search\Inc;

use \RT\Google_Custom_Search\Inc\Traits\Singleton;

/**
 * Class Plugin
 */
class Plugin {

	use Singleton;

	/**
	 * Construct method.
	 */
	protected function __construct() {

		// Load plugin classes.
		Settings::get_instance();
		Search::get_instance();
	}

}

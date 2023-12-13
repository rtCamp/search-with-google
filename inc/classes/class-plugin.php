<?php
/**
 * Plugin manifest class.
 *
 * @package search-with-google
 */

namespace RT\Search_With_Google\Inc;

use RT\Search_With_Google\Inc\Traits\Singleton;

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
		Notice::get_instance();

	}

}
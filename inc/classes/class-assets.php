<?php
/**
 * Assets class.
 *
 * @package search-with-google
 */

namespace RT\Search_With_Google\Inc;

use RT\Search_With_Google\Inc\Traits\Singleton;

/**
 * Class Assets
 */
class Assets {

	use Singleton;

	/**
	 * Construct method.
	 */
	protected function __construct() {

		$this->setup_hooks();

	}

	/**
	 * Action / Filters to be declare here.
	 *
	 * @return void
	 */
	protected function setup_hooks() {

		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_assets' ) );

	}

	/**
	 * Enqueue admin assets.
	 *
	 * @param string $hook_suffix Hook suffix.
	 *
	 * @return void
	 */
	public function enqueue_admin_assets( $hook_suffix ) {

		if ( 'options-reading.php' === $hook_suffix ) {
			wp_enqueue_style(
				'search-with-google-settings-style',
				SEARCH_WITH_GOOGLE_URL . '/assets/css/settings.css',
				array(),
				filemtime( SEARCH_WITH_GOOGLE_PATH . '/assets/css/settings.css' )
			);
		}
	}
}

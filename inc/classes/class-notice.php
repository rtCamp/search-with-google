<?php
/**
 * Display notice on admin dashboard.
 *
 * @package search-with-google
 */

namespace RT\Search_With_Google\Inc;

use RT\Search_With_Google\Inc\Traits\Singleton;

/**
 * Class Notice
 */
class Notice {

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

		/**
		 * Actions.
		 */
		add_action( 'admin_notices', array( $this, 'display_notice' ) );

	}

	/**
	 * Display notice on admin dashboard.
	 *
	 * @return void
	 */
	public function display_notice() {

		$read_more_url = 'https://developers.google.com/custom-search/v1/site_restricted_api';
		?>
		<div class="notice notice-error">
			<p>
				<?php
				esc_html_e( 'Notice : This plugin uses a Custom site-restricted Search API which has been deprecated by Google. Hence, limiting its use to only users with existing API keys. Any new API request to Google will return a 403 error, and it will return an empty posts array on the front-end.', 'search-with-google' );
				?>
				<a href="<?php echo esc_url( $read_more_url ); ?>" target="_blank">
					<?php esc_html_e( 'Read more', 'search-with-google' ); ?>
				</a>
			</p>
		</div>
		<?php

	}
}
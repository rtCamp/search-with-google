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

		$custom_site_restricted_search_read_more = 'https://developers.google.com/custom-search/v1/site_restricted_api';
		$custom_search_read_more                 = 'https://developers.google.com/custom-search/v1/overview#pricing';
		?>
		<div class="notice notice-error">
			<p>
				<?php
				esc_html_e( 'According to a notification from Google, assistance for custom site-restricted search is scheduled to cease as of December 18, 2024.', 'search-with-google' );
				?>
				<a href="<?php echo esc_url( $custom_site_restricted_search_read_more ); ?>" target="_blank">
					<?php esc_html_e( 'Read more', 'search-with-google' ); ?>
				</a>
			</p>
			<p>
				<?php esc_html_e( 'Due to this modification, we are introducing an opt-in feature that enables the use of solely the Custom Search API, as opposed to the Custom Site-restricted Search API. You have the option to opt in for this change by ', 'search-with-google' ); ?>
				<a href="<?php echo esc_url( admin_url( 'options-reading.php#search-type' ) ); ?>">
					<?php esc_html_e( 'Settings > Reading', 'search-with-google' ); ?>
				</a>
			</p>

			<p>
				<?php esc_html_e( 'Note: If you utilize the Custom Search API, there are limitations on the daily volume of search queries allowed. Kindly refer ', 'search-with-google' ); ?>
				<a href="<?php echo esc_url( $custom_search_read_more ); ?>" target="_blank">
					<?php esc_html_e( 'Documentation', 'search-with-google' ); ?>
				</a>
			</p>
		</div>
		<?php

	}
}

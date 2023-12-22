<?php
/**
 * Register plugin settings.
 *
 * @package search-with-google
 */

namespace RT\Search_With_Google\Inc;

use RT\Search_With_Google\Inc\Traits\Singleton;

/**
 * Class Settings
 */
class Settings {

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

		add_action( 'admin_init', array( $this, 'register_settings' ) );

	}

	/**
	 * Register Plugin settings.
	 *
	 * @return void
	 */
	public function register_settings() {

		$args = array(
			'type'              => 'string',
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => null,
		);

		register_setting( 'reading', 'gcs_api_key', $args );
		register_setting( 'reading', 'gcs_cse_id', $args );
		register_setting( 'reading', 'gcs_search_type', $args );

		// Register a new section in the "reading" page.
		add_settings_section(
			'cse_settings_section',
			__( 'Search with Google Settings', 'search-with-google' ),
			array( $this, 'cse_settings_section_cb' ),
			'reading'
		);

		// Register new fields in the "cse_settings_section" section, inside the "reading" page.
		add_settings_field(
			'gcs_api_key',
			__( 'API Key', 'search-with-google' ),
			array( $this, 'cse_api_key_field_cb' ),
			'reading',
			'cse_settings_section'
		);
		add_settings_field(
			'gcs_cse_id',
			__( 'Engine ID', 'search-with-google' ),
			array( $this, 'cse_id_field_cb' ),
			'reading',
			'cse_settings_section'
		);

		// Add a new toggle setting field for selecting between custom search API and custom site-restricted search API.
		add_settings_field(
			'gcs_search_type',
			__( 'Search Type', 'search-with-google' ),
			array( $this, 'cse_search_type_field_cb' ),
			'reading',
			'cse_settings_section'
		);

	}

	/**
	 * Settings section callback.
	 *
	 * @return void
	 */
	public function cse_settings_section_cb() {
	}

	/**
	 * API Key field markup.
	 *
	 * @return void
	 */
	public function cse_api_key_field_cb() {
		// Get the value of the setting we've registered with register_setting().
		$setting = get_option( 'gcs_api_key' );
		// Output the field.
		?>
		<input type="text" name="gcs_api_key" value="<?php echo ! empty( $setting ) ? esc_attr( $setting ) : ''; ?>">
		<?php
	}

	/**
	 * Engine ID field markup.
	 *
	 * @return void
	 */
	public function cse_id_field_cb() {
		// Get the value of the setting we've registered with register_setting().
		$setting = get_option( 'gcs_cse_id' );
		// Output the field.
		?>
		<input type="text" name="gcs_cse_id" value="<?php echo ! empty( $setting ) ? esc_attr( $setting ) : ''; ?>">
		<?php
	}

	/**
	 * Search Type field markup.
	 *
	 * @return void
	 */
	public function cse_search_type_field_cb() {

		// Get the value of the setting we've registered with register_setting().
		$setting = get_option( 'gcs_search_type' );

		// Add slider toggle switch.
		?>
		<div class="switch-wrapper">
			<span><?php esc_html_e( 'Custom Site Restricted Search API', 'search-with-google' ); ?></span>

			<label class="switch">
				<input id="search-type" type="checkbox" name="gcs_search_type" value="1" <?php checked( $setting, '1' ); ?>>
				<span class="slider"></span>
			</label>

			<span><?php esc_html_e( 'Custom Search API', 'search-with-google' ); ?></span>
		</div>
		<?php

	}
}


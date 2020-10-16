<?php
/**
 * Register plugin settings.
 *
 * @package search-with-google
 */

namespace RT\Search_With_Google\Inc;

use \RT\Search_With_Google\Inc\Traits\Singleton;

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
	 */
	protected function setup_hooks() {

		add_action( 'admin_init', array( $this, 'register_settings' ) );
	}

	/**
	 * Register Plugin settings.
	 */
	public function register_settings() {
		$args = array(
			'type'              => 'string',
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => null,
		);
		register_setting( 'reading', 'gcs_api_key', $args );
		register_setting( 'reading', 'gcs_cse_id', $args );

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
	}

	/**
	 * Settings section callback.
	 */
	public function cse_settings_section_cb() {
	}

	/**
	 * API Key field markup.
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
	 */
	public function cse_id_field_cb() {
		// Get the value of the setting we've registered with register_setting().
		$setting = get_option( 'gcs_cse_id' );
		// Output the field.
		?>
		<input type="text" name="gcs_cse_id" value="<?php echo ! empty( $setting ) ? esc_attr( $setting ) : ''; ?>">
		<?php
	}
}


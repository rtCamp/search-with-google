<?php
/**
 * Register plugin settings.
 *
 * @package google-custom-search
 */

namespace rtCamp\GoogleCustomSearch;

/**
 * Class Google_Custom_Search_Settings
 *
 * @package rtCamp\GoogleCustomSearch
 */
class Google_Custom_Search_Settings {

	use \rtCamp\GoogleCustomSearch\Traits\Singleton;

	/**
	 * Action / Filters to be declare here.
	 */
	protected function init() {

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
		register_setting( 'reading', 'cse_api_key', $args );
		register_setting( 'reading', 'cse_id', $args );

		// Register a new section in the "reading" page.
		add_settings_section(
			'cse_settings_section',
			__( 'Custom Google Search Settings', 'google-custom-search' ),
			array( $this, 'cse_settings_section_cb' ),
			'reading'
		);

		// Register new fields in the "cse_settings_section" section, inside the "reading" page.
		add_settings_field(
			'cse_api_key',
			__( 'API Key', 'google-custom-search' ),
			array( $this, 'cse_api_key_field_cb' ),
			'reading',
			'cse_settings_section'
		);
		add_settings_field(
			'cse_id',
			__( 'Engine ID', 'google-custom-search' ),
			array( $this, 'cse_id_field_cb' ),
			'reading',
			'cse_settings_section'
		);
	}

	/**
	 * Settings section callback.
	 */
	public function cse_settings_section_cb() {
		echo esc_html( 'Custom Search engine configurations.' );
	}

	/**
	 * API Key field markup.
	 */
	public function cse_api_key_field_cb() {
		// Get the value of the setting we've registered with register_setting().
		$setting = get_option( 'cse_api_key' );
		// Output the field.
		?>
		<input type="text" name="cse_api_key" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
		<?php
	}

	/**
	 * Engine ID field markup.
	 */
	public function cse_id_field_cb() {
		// Get the value of the setting we've registered with register_setting().
		$setting = get_option( 'cse_id' );
		// Output the field.
		?>
		<input type="text" name="cse_id" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
		<?php
	}
}

add_action(
	'plugins_loaded',
	function () {
		Google_Custom_Search_Settings::get_instance();
	}
);

<?php
/**
 * Settings test class to check settings functionality.
 *
 * @package RT\Google_Custom_Search
 */

namespace RT\Google_Custom_Search\Tests\Unit;

use RT\Google_Custom_Search\Tests\TestCase;
use RT\Google_Custom_Search\Inc\Settings as Testee;

/**
 * Class SettingsTest
 */
class SettingsTest extends TestCase {

	/**
	 * Class in test.
	 *
	 * @var Testee
	 */
	private $testee;

	/**
	 * Runs before each test.
	 */
	public function setUp(): void {
		parent::setUp();

		$this->testee = Testee::get_instance();
	}

	/**
	 * Test the instance is as expected.
	 *
	 * @return void
	 */
	public function test_instance(): void {

		$this->assertInstanceOf( Testee::class, $this->testee );
		$this->assertHooksAdded();
	}

	/**
	 * Test register settings function.
	 *
	 * @return void
	 */
	public function test_register_settings(): void {
		$args = array(
			'type'              => 'string',
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => null,
		);

		$this->wpMockFunction(
			'register_setting',
			array(
				'reading',
				'gcs_api_key',
				$args,
			)
		);

		$this->wpMockFunction(
			'register_setting',
			array(
				'reading',
				'gcs_cse_id',
				$args,
			)
		);

		$this->wpMockFunction(
			'add_settings_section',
			array(
				'cse_settings_section',
				__( 'Google Custom Search Settings', 'search-with-google' ),
				array( $this->testee, 'cse_settings_section_cb' ),
				'reading',
			)
		);

		$this->wpMockFunction(
			'add_settings_field',
			array(
				'gcs_api_key',
				__( 'API Key', 'search-with-google' ),
				array( $this->testee, 'cse_api_key_field_cb' ),
				'reading',
				'cse_settings_section',
			)
		);

		$this->wpMockFunction(
			'add_settings_field',
			array(
				'gcs_cse_id',
				__( 'Engine ID', 'search-with-google' ),
				array( $this->testee, 'cse_id_field_cb' ),
				'reading',
				'cse_settings_section',
			)
		);

		$this->testee->register_settings();

		$this->assertCurrentConditionsMet( 'Settings registered successfully!' );
	}

	/**
	 * Compare the string is as expected.
	 *
	 * Any changes to original method should fail this test method.
	 *
	 * @return void
	 */
	public function test_cse_settings_section_cb(): void {
		ob_start();
		$this->testee->cse_settings_section_cb();
		$result = ob_get_clean();

		$this->assertSame( 'Custom Search engine configurations.', $result );
	}

	/**
	 * Test the API key input field outputs properly.
	 *
	 * @return void
	 */
	public function test_cse_api_key_field_cb(): void {

		$this->wpMockFunction(
			'get_option',
			array(
				'gcs_api_key',
			),
			1,
			'testing_key'
		);

		ob_start();
		$this->testee->cse_api_key_field_cb();
		$result = ob_get_clean();

		$expected = '<input type="text" name="gcs_api_key" value="testing_key">';

		$this->assertCurrentConditionsMet( 'API Key input working fine.' );
		$this->assertEquals( $expected, trim( $result ) );
	}

	/**
	 * Test the Engine ID input field.
	 *
	 * @return void
	 */
	public function test_cse_id_field_cb(): void {

		$this->wpMockFunction(
			'get_option',
			array(
				'gcs_cse_id',
			),
			1,
			'test'
		);

		ob_start();
		$this->testee->cse_id_field_cb();
		$result = ob_get_clean();

		$expected = '<input type="text" name="gcs_cse_id" value="test">';

		$this->assertCurrentConditionsMet( 'Engine ID input working fine.' );
		$this->assertEquals( $expected, trim( $result ) );
	}
}

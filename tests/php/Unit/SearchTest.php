<?php
/**
 * Search test class to check settings functionality.
 *
 * @package RT\Google_Custom_Search
 */

namespace RT\Google_Custom_Search\Tests\Unit;

use RT\Google_Custom_Search\Tests\TestCase;
use RT\Google_Custom_Search\Inc\Search as Testee;
use Mockery;

/**
 * Class SearchTest
 *
 * @package RT\Google_Custom_Search\Tests\Unit
 */
class SearchTest extends TestCase {

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
	 * Test filter search query method for non search pages.
	 *
	 * @return void
	 */
	public function test_filter_search_query_for_non_search_page(): void {

		$wp_query_mock            = Mockery::mock( '\WP_Query' );
		$wp_query_mock->is_search = false;

		$this->wpMockFunction(
			'is_admin',
			array(),
			0,
			true
		);

		$result = $this->testee->filter_search_query( array( 'test' ), $wp_query_mock );

		$this->assertSame( array( 'test' ), $result );
		$this->assertCurrentConditionsMet();
	}

	/**
	 * Test filter search query method.
	 *
	 * @return void
	 */
	public function test_filter_search_query_for_admin_page(): void {

		$wp_query_mock            = Mockery::mock( '\WP_Query' );
		$wp_query_mock->is_search = true;

		$this->wpMockFunction(
			'is_admin',
			array(),
			1,
			true
		);

		$result = $this->testee->filter_search_query( array( 'test' ), $wp_query_mock );

		$this->assertSame( array( 'test' ), $result );
		$this->assertCurrentConditionsMet();
	}

	/**
	 * Test the filter search query for frontend search query.
	 *
	 * @return void
	 */
	public function test_filter_search_query_and_non_admin_pages(): void {

		$wp_query_mock            = Mockery::mock( '\WP_Query' );
		$wp_query_mock->is_search = true;

		$wp_query_mock->shouldReceive( 'get' )
			->with( 's' )
			->times( 1 )
			->andReturn( 'test' );

		$wp_query_mock->shouldReceive( 'get' )
			->with( 'paged' )
			->times( 1 )
			->andReturn( 1 );

		$wp_query_mock->shouldReceive( 'get' )
			->with( 'posts_per_page' )
			->times( 2 )
			->andReturn( 5 );

		/**
		 * If search query is set, then is_admin check will run.
		 */
		$this->wpMockFunction(
			'is_admin',
			array(),
			1,
			false
		);

		$this->testee->filter_search_query( array( 'test' ), $wp_query_mock );

		$this->assertCurrentConditionsMet();
	}
}

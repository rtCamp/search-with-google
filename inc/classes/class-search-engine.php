<?php
/**
 * Register Search_Engine class functionality.
 *
 * @package search-with-google
 */

namespace RT\Search_With_Google\Inc;

use \RT\Search_With_Google\Inc\Traits\Singleton;

/**
 * Class Search_Engine.
 *
 * @package search-with-google
 */
class Search_Engine {

	use Singleton;

	/**
	 * Custom Search Site Restricted JSON API URL.
	 *
	 * @var string
	 */
	const GOOGLE_API_URL = 'https://customsearch.googleapis.com/customsearch/v1/siterestrict';

	/**
	 * API Key.
	 *
	 * @var string
	 */
	private $api_key = '';

	/**
	 * Custom Search Engine ID.
	 *
	 * @var string
	 */
	private $cse_id = '';

	/**
	 * Construct method.
	 */
	protected function __construct() {
		$this->init();
	}

	/**
	 * Action / Filters to be declare here.
	 */
	protected function init() {
		$this->api_key = get_option( 'gcs_api_key' );
		$this->cse_id  = get_option( 'gcs_cse_id' );
	}

	/**
	 * Get search results from the Custom Search Engine.
	 *
	 * @param string $search_query Search Query.
	 * @param int    $page Page number.
	 * @param int    $posts_per_page Items per request.
	 *
	 * @return array|\WP_Error Posts or false if empty or error.
	 */
	public function get_search_results( $search_query, $page = 1, $posts_per_page = 10 ) {

		$item_details  = array();
		$total_results = 0;

		// Create request URL with required parameters.
		$request_url = add_query_arg(
			array(
				'key' => $this->api_key,
				'cx'  => $this->cse_id,
				'q'   => rawurlencode( $search_query ),
				'num' => $posts_per_page,
			),
			self::GOOGLE_API_URL
		);

		if ( $page > 1 ) {
			$start       = $this->get_start_index( $page, $posts_per_page );
			$request_url = add_query_arg( array( 'start' => $start ), $request_url );
		}

		$response = wp_remote_get(
			$request_url,
			array(
				'timeout' => 120,
			)
		);

		// Check the response code.
		$response_code    = wp_remote_retrieve_response_code( $response );
		$response_message = wp_remote_retrieve_response_message( $response );

		if ( 200 !== $response_code && ! empty( $response_message ) ) {
			return new \WP_Error( $response_code, $response_message );
		} elseif ( 200 !== $response_code ) {
			return new \WP_Error( $response_code, __( 'Unknown error occurred', 'search-with-google' ) );
		} else {

			if ( ! is_wp_error( $response ) ) {

				$response_body = wp_remote_retrieve_body( $response );
				$result        = json_decode( $response_body );

				if ( ! is_wp_error( $result ) ) {

					if ( isset( $result->searchInformation->totalResults ) && isset( $result->items ) ) {

						$total_results = (int) $result->searchInformation->totalResults;

						// If no results found and pagination request then try another request.
						if ( 0 === $total_results && $page > 1 ) {
							return $this->get_search_results( $search_query, $page - 1, $posts_per_page );
						}

						if ( ! empty( $result->items ) ) {
							foreach ( $result->items as $item ) {

								$item_detail['title']       = $item->title;
								$item_detail['link']        = $item->link;
								$item_detail['snippet'] = $item->snippet;

								$item_details[] = $item_detail;
							}
						}
					}
				} else {
					return new \WP_Error( $response_code, __( 'Unknown error occurred', 'search-with-google' ) );
				}
			}
		}

		return array(
			'total_results' => $total_results,
			'items'         => $item_details,
		);
	}

	/**
	 * Calculate start index for Custom Search Engine.
	 *
	 * @param int $page Page number of results.
	 * @param int $posts_per_page Results per page.
	 *
	 * @return float|int
	 */
	public function get_start_index( $page, $posts_per_page ) {

		return ( $page * $posts_per_page ) - ( $posts_per_page - 1 );
	}
}

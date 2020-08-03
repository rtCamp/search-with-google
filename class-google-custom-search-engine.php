<?php
/**
 * Register Google_Custom_Search_Engine class  functionality.
 *
 * @package custom-gogle-search
 */

namespace rtCamp\CustomGoogleSearch;

/**
 * Class Google_Custom_Search_Engine.
 *
 * @package custom-gogle-search
 */
class Google_Custom_Search_Engine {

	/**
	 * Google Custom Search API URL.
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

	use \rtCamp\CustomGoogleSearch\Traits\Singleton;

	/**
	 * Initialize the settings.
	 */
	protected function init() {
		$this->api_key = get_option( 'cse_api_key' );
		$this->cse_id  = get_option( 'cse_id' );
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
			return new \WP_Error( $response_code, 'Unknown error occurred' );
		} else {

			if ( ! is_wp_error( $response ) ) {

				$response_body = wp_remote_retrieve_body( $response );
				$result        = json_decode( $response_body );

				if ( ! is_wp_error( $result ) ) {

					if ( isset( $result->searchInformation->totalResults ) && isset( $result->items ) ) {

						$total_results = $result->searchInformation->totalResults;

						if ( ! empty( $result->items ) ) {
							foreach ( $result->items as $item ) {

								$item_detail['title']       = $item->title;
								$item_detail['link']        = $item->link;
								$item_detail['htmlSnippet'] = $item->htmlSnippet;

								$item_details[] = $item_detail;
							}
						}
					}
				} else {
					return new \WP_Error( $response_code, 'Unknown error occurred' );
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

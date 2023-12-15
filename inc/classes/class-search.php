<?php
/**
 * Register plugin Functionality.
 *
 * @package search-with-google
 */

namespace RT\Search_With_Google\Inc;

use RT\Search_With_Google\Inc\Traits\Singleton;

/**
 * Class Search.
 */
class Search {

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
		 * Filters.
		 */
		add_filter( 'posts_pre_query', array( $this, 'filter_search_query' ), 10, 2 );
		add_filter( 'page_link', array( $this, 'update_permalink' ), 10, 2 );

	}

	/**
	 * Filter the WP Search query to get results from Custom Search Engine.
	 *
	 * @param \WP_Post[]|int[]|null $posts Posts array.
	 * @param \WP_Query             $query WP query.
	 *
	 * @return array|null Modified posts.
	 */
	public function filter_search_query( $posts, $query ) {

		if ( ! $query->is_search || is_admin() ) {
			return $posts;
		}

		$search_query   = $query->get( 's' );
		$page           = ! empty( $query->get( 'paged' ) ) ? $query->get( 'paged' ) : 1;
		$posts_per_page = $query->get( 'posts_per_page' ) > 10 ? 10 : $query->get( 'posts_per_page' ); // Restrict posts per page to 10 as Custom Search Site Restricted JSON API allows max 10 results per page.

		// Get query result from Google Custom Search Engine.
		$cse = Search_Engine::get_instance();

		$cse_results = get_transient( $this->get_transient_key( $search_query, $page, $posts_per_page ) );

		if ( false === $cse_results ) {

			$cse_results = $cse->get_search_results( $search_query, $page, $posts_per_page );

			if ( ! is_wp_error( $cse_results ) && 0 !== $cse_results['total_results'] ) {
				set_transient( $this->get_transient_key( $search_query, $page, $posts_per_page ), $cse_results, DAY_IN_SECONDS );
			}
		}

		if ( is_wp_error( $cse_results ) || empty( $cse_results['items'] ) ) {
			return $posts;
		}

		// Translate results from Google Search into WordPress Posts.
		$posts = $this->get_posts( $cse_results['items'] );

		// Set Query object to get pagination working.
		$query->set( 'posts_per_page', $posts_per_page );
		$query->found_posts   = $cse_results['total_results'] > 100 ? 100 : intval( $cse_results['total_results'] ); // Custom Search Site Restricted JSON API return max 100 actual results.
		$query->max_num_pages = intval( floor( $query->found_posts / $posts_per_page ) );

		return $posts;

	}

	/**
	 * Get transients key based on search query and page.
	 *
	 * @param string $search_query   Search query.
	 * @param int    $page           Page.
	 * @param int    $posts_per_page Posts per page.
	 *
	 * @return string
	 */
	public function get_transient_key( $search_query, $page, $posts_per_page ) {

		return 'gcs_results_' . sanitize_title( $search_query ) . '_' . $page . '_' . $posts_per_page;

	}

	/**
	 * Get posts from the results.
	 *
	 * @param array $items Array of results.
	 *
	 * @return array
	 */
	public function get_posts( $items ) {

		$posts = array();

		if ( ! empty( $items ) ) {
			foreach ( $items as $item ) {
				$posts[] = $this->get_post( $item );
			}
		}

		return $posts;

	}

	/**
	 * Get post object from the item.
	 *
	 * @param array $item Custom search result.
	 *
	 * @return \WP_Post
	 */
	public function get_post( $item ) {

		$post_id                = - wp_rand( 1, 99999 ); // Negative ID, to avoid clash with a valid post.
		$post                   = new \stdClass();
		$post->ID               = $post_id;
		$post->post_author      = 1;
		$post->post_date        = current_time( 'mysql' );
		$post->post_date_gmt    = current_time( 'mysql', 1 );
		$post->post_title       = $item['title'];
		$post->post_content     = $item['snippet'];
		$post->post_status      = 'publish';
		$post->comment_status   = 'closed';
		$post->ping_status      = 'closed';
		$post->post_name        = $this->get_post_name( $item['link'] ); // Get post slug from URL.
		$post->search_permalink = $item['link']; // Get post permalink from URL. This will replace the WP default permalink.
		$post->post_type        = 'page';
		$post->filter           = 'raw'; // Important!

		// Convert to WP_Post object.
		return new \WP_Post( $post );

	}

	/**
	 * Get post slug from URL.
	 *
	 * @param string $url Page URL.
	 *
	 * @return string
	 */
	public function get_post_name( $url ) {

		$url_parse = wp_parse_url( $url );

		return ltrim( $url_parse['path'], '/' );

	}

	/**
	 * Set Permalink of search result from Custom search results.
	 *
	 * @param string $permalink Page URL.
	 * @param int    $post_id   Post ID.
	 *
	 * @return string Updated permalink.
	 */
	public function update_permalink( $permalink, $post_id ) {

		$post = get_post( $post_id );

		if ( ! empty( $post->search_permalink ) ) {
			return $post->search_permalink;
		}

		return $permalink;

	}
}

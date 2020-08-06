<?php
/**
 * Register plugin Functionality.
 *
 * @package google-custom-search
 */

namespace rtCamp\GoogleCustomSearch;

use \rtCamp\GoogleCustomSearch\Google_Custom_Search_Engine;
use \rtCamp\GoogleCustomSearch\Google_Custom_Search_Settings;

/**
 * Class Google_Custom_Search.
 *
 * @package google-custom-search
 */
class Google_Custom_Search {

	use \rtCamp\GoogleCustomSearch\Traits\Singleton;

	/**
	 * Initialize Block.
	 */
	protected function init() {

		/**
		 * Filters.
		 */
		add_filter( 'posts_pre_query', array( $this, 'filter_search_query' ), 10, 2 );
	}

	/**
	 * Filter the WP Search query to get results from Custom Search Engine.
	 *
	 * @param array     $posts Posts array.
	 * @param \WP_Query $query WP query.
	 *
	 * @return mixed Modified posts.
	 */
	public function filter_search_query( $posts, $query ) {

		if ( ! $query->is_search || is_admin() ) {
			return $posts;
		}

		$search_query   = $query->get( 's' );
		$page           = ! empty( $query->get( 'paged' ) ) ? $query->get( 'paged' ) : 1;
		$posts_per_page = $query->get( 'posts_per_page' ) > 10 ? 10 : $query->get( 'posts_per_page' ); // Restrict posts per page to 10.

		// Get query result from Google Custom Search Engine.
		$cse = Google_Custom_Search_Engine::get_instance();


		//delete_transient( $this->get_transient_key(  $search_query, $page, $posts_per_page ) );
		$cse_results = get_transient( $this->get_transient_key( $search_query, $page, $posts_per_page ) );

		if ( false === $cse_results ) {

			$cse_results = $cse->get_search_results( $search_query, $page, $posts_per_page );

			if ( ! is_wp_error( $cse_results ) && 0 !== $cse_results['total_results'] ) {
				set_transient( $this->get_transient_key( $search_query, $page, $posts_per_page ), $cse_results, DAY_IN_SECONDS );
			}
		}

		$posts = $this->get_posts( $cse_results['items'] );
		$query->set( 'posts_per_page', $posts_per_page );

		$query->found_posts   = $cse_results['total_results'] > 100 ? 100 : (int) $cse_results['total_results'];
		$query->num_posts     = $query->found_posts;
		$query->max_num_pages = intval( floor( $query->found_posts / $posts_per_page ) );

		return $posts;
	}

	/**
	 * Get transients key based on search query and page.
	 *
	 * @param string $search_query Search query.
	 * @param int    $page Page.
	 * @param int    $posts_per_page Posts per page.
	 *
	 * @return string
	 */
	public function get_transient_key( $search_query, $page, $posts_per_page ) {
		return 'cse_results_' . sanitize_title( $search_query ) . '_' . $page . '_' . $posts_per_page;
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

		foreach ( $items as $item ) {
			$posts[] = $this->get_post( $item );
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

		$post_id              = - wp_rand( 1, 99999 ); // Negative ID, to avoid clash with a valid post.
		$post                 = new \stdClass();
		$post->ID             = $post_id;
		$post->post_author    = 1;
		$post->post_date      = current_time( 'mysql' );
		$post->post_date_gmt  = current_time( 'mysql', 1 );
		$post->post_title     = $item['title'];
		$post->post_content   = $item['htmlSnippet'];
		$post->post_status    = 'publish';
		$post->comment_status = 'closed';
		$post->ping_status    = 'closed';
		$post->post_name      = $this->get_post_name( $item['link'] ); // Append random number to avoid clash.
		$post->post_type      = 'page';
		$post->filter         = 'raw'; // Important!


		// Convert to WP_Post object.
		$wp_post = new \WP_Post( $post );

		// Add the fake post to the cache
		//wp_cache_add( $post_id, $wp_post, 'posts' );

		return $wp_post;
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
}

add_action(
	'plugins_loaded',
	function () {
		Google_Custom_Search::get_instance();
	}
);

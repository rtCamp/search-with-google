<?php
/**
 * Bootstrap for phpunit test.
 * Include necessary files, classes etc.
 *
 * @package RtCamp\Types
 */

$vendor = dirname( __DIR__, 2 ) . '/vendor/';

if ( ! file_exists( $vendor . 'autoload.php' ) ) {
	die( 'Please install via Composer before running tests.' );
}

require_once dirname( __DIR__, 2 ) . '/inc/traits/trait-singleton.php';

WP_Mock::setUsePatchwork( true );
WP_Mock::bootstrap();

unset( $vendor );

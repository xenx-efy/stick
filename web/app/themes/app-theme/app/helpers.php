<?php
/**
 * Load helpers.
 * Define any generic functions in a helper file and then require that helper file here.
 *
 * @package MyApp
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Load helpers.

$helpers = glob( HELPERS_DIR . '*.php' );
foreach ( $helpers as $helper ) {
	if ( ! is_file( $helper ) ) {
		continue;
	}

	require $helper;
}

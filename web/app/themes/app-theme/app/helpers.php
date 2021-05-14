<?php
/**
 * Load helpers.
 * Define any generic functions in a helper file and then require that helper file here.
 *
 * @package MyApp
 */

if ( ! defined('ABSPATH')) {
	exit;
}

$dirs = new DirectoryIterator(HELPERS_DIR);

foreach ($dirs as $dir) {
	if ( ! $dir->isFile()) {
		continue;
	}

	require $dir->getPathname();
}

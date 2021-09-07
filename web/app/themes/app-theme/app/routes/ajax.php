<?php
/**
 * WordPress AJAX Routes.
 * WARNING: Do not use \MyApp::route()->all() here, otherwise you will override
 * ALL AJAX requests which you most likely do not want to do.
 *
 * @link https://docs.wpemerge.com/#/framework/routing/methods
 *
 * @package MyApp
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Using our ExampleController to handle a custom ajax action, for example.
// phpcs:ignore
\MyApp::route()->post()->where( 'ajax', 'post-request' )->handle(
	'ExampleAjaxController@postRequest'
);
\MyApp::route()->get()->where( 'ajax', 'get-request' )->handle( 'ExampleAjaxController@getRequest' );

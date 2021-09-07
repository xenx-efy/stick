<?php

namespace MyApp\Controllers\Ajax;

use Psr\Http\Message\ResponseInterface;
use WPEmerge\Requests\Request;

class ExampleAjaxController {

	public function getRequest( Request $request ): ResponseInterface {
		$params = $request->getQueryParams();

		return \MyApp::json( 'GET response' );
	}

	public function postRequest( Request $request ): ResponseInterface {
		$params = $request->getParsedBody();

		return \MyApp::json( 'POST response' );
	}
}

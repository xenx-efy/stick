<?php

namespace MyApp\Controllers\Web;

use Psr\Http\Message\ResponseInterface;

class ExampleController {

	public function hola(): ResponseInterface {
		return \MyApp::json( 'hola' );
	}

}

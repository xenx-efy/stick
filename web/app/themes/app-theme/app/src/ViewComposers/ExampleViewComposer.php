<?php

namespace MyApp\ViewComposers;

use WPEmerge\View\ViewInterface;

class ExampleViewComposer {
	/**
	 * Compose a view.
	 *
	 * @param ViewInterface $view
	 *
	 * @return void
	 */
	public function compose( $view ) {
		$view->with( [
			'foo' => 'bar',
		] );
	}
}

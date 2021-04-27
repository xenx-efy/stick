<?php

/**
 * Register custom blocks category for acf fields
 */
add_filter('block_categories', 'add_custom_blocks_categories', 10, 2);
function add_custom_blocks_categories($categories, $post): array
{
	return array_merge(
		$categories,
		array(
			array(
				'slug'  => 'custom-blocks',
				'title' => __('Custom Blocks', 'bts-blocks'),
			),
		)
	);
}

/**
 * Create blocks based on templates found in "views/blocks" directory
 */
add_action('acf/init', 'register_acf_blocks');
function register_acf_blocks()
{
	$blocks_dir = get_template_directory() . '/views/blocks';

	if ( ! file_exists($blocks_dir)) {
		return;
	}

	$template_directory = new \DirectoryIterator($blocks_dir);

	foreach ($template_directory as $template) {
		if (function_exists('acf_register_block_type')
		    && ! $template->isDot()
		    && ! $template->isDir()
		) {
			$filename    = $template->getFilename();
			$block_name  = remove_file_extension($filename);
			$block_title = filename_to_string($filename);

			acf_register_block_type(
				array(
					'name'            => $block_name,
					'title'           => __(ucfirst($block_title)),
					'description'     => __("A custom {$block_title} block."),
					'render_callback' => 'render_twig_blocks',
					'category'        => 'custom-blocks',
					'icon'            => 'admin-comments',
					'keywords'        => array('testimonial', 'quote'),
				)
			);
		}
	}
}

/**
 * ACF render callback function
 *
 * @param $block
 */
function render_twig_blocks($block)
{
	$slug = str_replace('acf/', '', $block['name']);
	if (file_exists(
		get_theme_file_path(
			"views/blocks/" . $slug
			. ".twig"
		)
	)
	) {
		$context = Timber::context();
		// Store block values.
		$context['block'] = $block;
		// Store field values.
		$context['fields'] = get_fields();

		Timber::render(
			get_theme_file_path(
				"views/blocks/" . $slug
				. ".twig"
			),
			$context
		);
	}
}

/**
 * Create theme settings page
 */
if (function_exists('acf_add_options_page')) {
	acf_add_options_page(
		array(
			'page_title' => 'Theme General Settings',
			'menu_title' => 'Theme Settings',
			'menu_slug'  => 'theme-general-settings',
			'capability' => 'edit_posts',
			'redirect'   => false
		)
	);

	acf_add_options_sub_page(
		array(
			'page_title'  => 'Theme Header Settings',
			'menu_title'  => 'Header',
			'parent_slug' => 'theme-general-settings',
		)
	);
}

/**
 * Set acf json save path
 */
add_filter(
	'acf/settings/save_json',
	function ($path) {
		$save_path = get_theme_file_path('views/blocks/acf-json/');
		if ( ! file_exists($save_path)
		     && ! mkdir(
				$concurrentDirectory
					= get_theme_file_path('views/blocks/acf-json/')
			)
		     && ! is_dir($concurrentDirectory)
		) {
			throw new \RuntimeException(
				sprintf(
					'Directory "%s" was not created',
					$concurrentDirectory
				)
			);
		}

		return get_theme_file_path('views/blocks/acf-json/');
	},
	0
);

/**
 * Set acf json load path
 */
add_filter(
	'acf/settings/load_json',
	function ($paths) {
		unset($paths[0]);

		$paths[] = get_theme_file_path('views/blocks/acf-json/');

		return $paths;
	}
);

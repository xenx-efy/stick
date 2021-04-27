<?php

namespace MyApp\WordPress;

use WPEmerge\ServiceProviders\ServiceProviderInterface;

/**
 * Register widgets and sidebars.
 */
class AcfServiceProvider implements ServiceProviderInterface
{
	/**
	 * {@inheritDoc}
	 */
	public function register($container)
	{
		// Nothing to register.
	}

	/**
	 * {@inheritDoc}
	 */
	public function bootstrap($container)
	{
		add_action('acf/init', [$this, 'register_blocks']);
		add_filter(
			'block_categories',
			[$this, 'add_custom_blocks_categories'],
			10,
			2
		);
		add_filter(
			'acf/settings/save_json',
			[$this, 'set_json_save_path'],
			0
		);
		add_filter('acf/settings/load_json', [$this, 'set_json_load_path']);
	}

	/**
	 * Set acf json load path
	 *
	 * @param array $paths
	 *
	 * @return mixed
	 */
	public function set_json_load_path(array $paths): array
	{
		unset($paths[0]);

		$save_path = VIEWS_DIR . 'blocks' . DIRECTORY_SEPARATOR . 'acf-json/';

		$paths[] = $save_path;

		return $paths;
	}

	/**
	 * Set acf json save path
	 */
	public function set_json_save_path($path): string
	{
		$save_path = VIEWS_DIR . 'blocks' . DIRECTORY_SEPARATOR . 'acf-json/';

		if ( ! file_exists($save_path)
		     && ! mkdir(
				$save_path
			)
		     && ! is_dir($save_path)
		) {
			throw new \RuntimeException(
				sprintf(
					'Directory "%s" was not created',
					dirname($save_path)
				)
			);
		}

		return $save_path;
	}

	public function add_custom_blocks_categories($categories, $post): array
	{
		return array_merge(
			$categories,
			array(
				array(
					'slug'  => 'custom-blocks',
					'title' => __('Custom Blocks', 'app-blocks'),
				),
			)
		);
	}

	public function register_blocks(): void
	{
		$blocks_dir = VIEWS_DIR . 'blocks';

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
				$block_name  = app_remove_file_extension($filename);
				$block_title = app_only_words($block_name);

				acf_register_block_type(
					array(
						'name'            => $block_name,
						'title'           => __(ucfirst($block_title)),
						'description'     => __(
							"A custom {$block_title} block."
						),
						'render_callback' => 'render_twig_blocks',
						'category'        => 'custom-blocks',
						'icon'            => 'admin-comments',
						'keywords'        => array('testimonial', 'quote'),
					)
				);
			}
		}
	}

}

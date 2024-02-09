<?php
/**
 * Upgrade Themes class for batch
 *
 * @package   PUM
 * @copyright Copyright (c) 2023, Code Atlantic LLC
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Implements a batch processor for migrating existing themes to new data structure.
 *
 * @since 1.8.0
 *
 * @see   PUM_Abstract_Upgrade_Themes
 */
class PUM_Upgrade_v1_8_Themes extends PUM_Abstract_Upgrade_Themes {

	/**
	 * Batch process ID.
	 *
	 * @var    string
	 */
	public $batch_id = 'core-v1_8-themes';

	/**
	 * Only load popups with specific meta keys.r
	 *
	 * @return array
	 */
	public function custom_query_args() {
		return [
			'meta_query' => [
				'relation' => 'OR',
				[
					'key'     => 'popup_theme_data_version',
					'compare' => 'NOT EXISTS',
					'value'   => 'deprecated', // Here for WP 3.9 or less.
				],
				[
					'key'     => 'popup_theme_data_version',
					'compare' => '<',
					'value'   => 3,
				],
			],
		];
	}

	/**
	 * Process needed upgrades on each theme.
	 *
	 * @param int $theme_id
	 */
	public function process_theme( $theme_id = 0 ) {

		$theme = pum_get_theme( $theme_id );

		/**
		 * If the theme is using an out of date data version, process upgrades.
		 */
		if ( $theme->data_version < $theme->model_version ) {
			$theme->passive_migration();
		}
	}

	public function finish() {
		// Clean up transient used to determine when updates are needed.
		delete_transient( 'pum_needs_1_8_theme_upgrades' );

		parent::finish(); // TODO: Change the autogenerated stub
	}


}

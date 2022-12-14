<?php // phpcs:ignore
/**
 * Enqueue Scripts
 *
 * @package WordPress
 * @subpackage WordPressTheme/Plugins/ACF/Admin
 */

namespace WordPressTheme\Plugins\ACF\Admin;

/**
 * Enqueue Scripts
 */
class EnqueueScripts {
	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run() {
		add_action( 'acf/input/admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
	}

	/**
	 * Admin head
	 */
	public function admin_enqueue_scripts() {
	}
}

<?php // phpcs:ignore
/**
 * PostClass
 *
 * @package WordPress
 * @subpackage WordPressTheme
 * @since 0.0.0
 */

namespace WordPressTheme\PostTemplate;

/**
 * PostClass
 *
 * @see https://developer.wordpress.org/reference/hooks/post_class/
 */
class PostClass {

	/**
	 * Run default hooks and actions for WordPress
	 *
	 * @return void
	 */
	public function run() : void {
		add_filter( 'post_class', array( $this, 'post_classes' ), 10, 3 );
	}


	/**
	 * Adds custom class to the array of posts classes.
	 *
	 * @since 0.0.0
	 *
	 * @param string[] $classes  An array of post class names.
	 * @param string[] $class  An array of additional class names added to the post.
	 * @param int      $post_id  The post ID.
	 *
	 * @return array
	 */
	public function post_classes( array $classes, array $class, int $post_id ) : array {
		return $classes;
	}
}

<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase WordPress.Files.FileName.InvalidClassFileName
/**
 * WP Query
 *
 * @package WordPress
 * @subpackage WordPressTheme
 */

namespace WordPressTheme;

use WP_Query;

/**
 * Class WP Query
 */
class WPQuery {

	/**
	 * Run default hooks and actions for WordPress
	 *
	 * @return void
	 */
	public function run() : void {
		add_filter( 'posts_join', array( $this, 'search_join' ), 10, 2 );
		add_filter( 'posts_where', array( $this, 'search_where' ), 10, 2 );
		add_filter( 'posts_distinct', array( $this, 'search_distinct' ), 10, 2 );
	}


	/**
	 * Join posts and postmeta tables
	 *
	 * @param string   $join The JOIN clause of the query.
	 * @param WP_Query $query The WP_Query instance (passed by reference).
	 *
	 * @see https://developer.wordpress.org/reference/hooks/posts_join/
	 *
	 * @return string
	 */
	public function search_join( string $join, WP_Query $query ) : string {
		global $wpdb;

		if ( is_search() ) {
			$join .= ' LEFT JOIN ' . $wpdb->postmeta . ' ON ' . $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
		}

		return $join;
	}


	/**
	 * Modify the search query with posts_where
	 *
	 * @param string   $where The WHERE clause of the query.
	 * @param WP_Query $query The WP_Query instance (passed by reference).
	 *
	 * @see https://developer.wordpress.org/reference/hooks/posts_where/
	 *
	 * @return string
	 */
	public function search_where( string $where, WP_Query $query ) : string {
		global $wpdb;

		if ( is_search() ) {
			$where = preg_replace(
				'/\(\s*' . $wpdb->posts . ".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
				'(' . $wpdb->posts . '.post_title LIKE $1) OR (' . $wpdb->postmeta . '.meta_value LIKE $1)',
				$where
			);
		}

		return $where;
	}


	/**
	 * Prevent duplicates
	 *
	 * @param string   $distinct The DISTINCT clause of the query.
	 * @param WP_Query $query The WP_Query instance (passed by reference).
	 *
	 * @see https://developer.wordpress.org/reference/hooks/posts_distinct/
	 *
	 * @return string
	 */
	public function search_distinct( string $distinct, WP_Query $query ) : string {
		if ( is_search() ) {
			return 'DISTINCT';
		}

		return $distinct;
	}
}

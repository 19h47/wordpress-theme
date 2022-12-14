<?php // phpcs:ignore
/**
 * Query Vars
 *
 * @package WordPress
 * @subpackage WordPressTheme
 */

namespace WordPressTheme\Setup;

/**
 * QueryVars
 */
class QueryVars {

	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run() : void {
		add_filter( 'query_vars', array( $this, 'query_vars' ) );

		add_action( 'init', array( $this, 'add_rewrite_tags' ) );
		add_action( 'init', array( $this, 'add_rewrite_rules' ) );

		add_filter( 'terms_clauses', array( $this, 'terms_clauses' ), 10, 3 );
	}

	/**
	 * Add query vars.
	 *
	 * @param string[] $public_query_vars The array of allowed query variable names.
	 *
	 * @see https://developer.wordpress.org/reference/hooks/query_vars/
	 *
	 * @return string[]
	 */
	public function query_vars( array $public_query_vars ) : array {
		return $public_query_vars;
	}


	/**
	 * Add rewrite tags
	 *
	 * @link https://codex.wordpress.org/Rewrite_API/add_rewrite_tag
	 */
	public function add_rewrite_tags() {
	}


	/**
	 * Add rewrite rules
	 *
	 * @link https://codex.wordpress.org/Rewrite_API/add_rewrite_rule
	 */
	public function add_rewrite_rules() {
	}


	/**
	 * Handle the post_type parameter given in get_terms function
	 *
	 * @param array $pieces Array of query SQL clauses.
	 * @param array $taxonomies An array of taxonomy names.
	 * @param array $args An array of term query arguments.
	 * @return mixed
	 */
	public function terms_clauses( array $pieces, $taxonomies, array $args ) {
		// Make sure we have a post_type argument to run with.
		if ( ! isset( $args['post_type'] ) || empty( $args['post_type'] ) ) {
			return $pieces;
		}

		global $wpdb;

		// Setup the post types in an array.
		$post_types = array();

		// If the argument is an array, check each one and cycle through the post types.
		if ( is_array( $args['post_type'] ) ) {
			foreach ( $args['post_type'] as $post_type ) {
				$post_types[] = "'" . esc_attr( $post_type ) . "'";
			}

			// If the post type argument is a string, not an array.
		} elseif ( is_string( $args['post_type'] ) ) {
			$post_types[] = "'" . esc_attr( $args['post_type'] ) . "'";
		}

		// If we have valid post types, build the new sql.
		if ( ! empty( $post_types ) ) {
			$post_types_string = implode( ',', $post_types );

			$fields = str_replace( 'tt.*', 'tt.term_taxonomy_id, tt.term_id, tt.taxonomy, tt.description, tt.parent', $pieces['fields'] );

			$pieces['fields']  = 'DISTINCT ' . esc_sql( $fields ) . ', COUNT(t.term_id) AS count';
			$pieces['join']   .= ' INNER JOIN ' . $wpdb->term_relationships . ' AS r ON r.term_taxonomy_id = tt.term_taxonomy_id INNER JOIN ' . $wpdb->posts . ' AS p ON p.ID = r.object_id';
			$pieces['where']  .= ' AND p.post_type IN (' . $post_types_string . ') AND p.post_status=\'publish\'';
			$pieces['orderby'] = 'GROUP BY t.term_id ' . $pieces['orderby'];
		}

		return $pieces;
	}
}

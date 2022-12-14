<?php // phpcs:ignore
/**
 * Settings
 *
 * @package WordPress
 * @subpackage WordPressTheme
 */

namespace WordPressTheme\Setup;

/**
 * Supports
 */
class Settings {

	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run() : void {
		add_action( 'admin_init', array( $this, 'settings_api_init' ) );
		add_action( 'init', array( $this, 'register_settings' ) );
	}


	/**
	 * Register settings
	 *
	 * @return void
	 */
	public function settings_api_init() : void {
		add_settings_section(
			'socials',
			'',
			array( $this, 'socials_callback_function' ),
			'general'
		);

		add_settings_section(
			'contacts',
			'',
			array( $this, 'contacts_callback_function' ),
			'general'
		);

		add_settings_field(
			'facebook',
			__( 'Facebook', 'wordpresstheme' ),
			array( $this, 'text_callback_function' ),
			'general',
			'socials',
			array(
				'name'        => 'facebook',
				'placeholder' => 'https://www.facebook.com/artvandelay',
				'description' => __( 'Enter the Facebook URL here.', 'wordpresstheme' ),
			)
		);

		add_settings_field(
			'twitter',
			__( 'Twitter', 'wordpresstheme' ),
			array( $this, 'text_callback_function' ),
			'general',
			'socials',
			array(
				'name'        => 'twitter',
				'placeholder' => 'https://twitter.com/artvandelay',
				'description' => __( 'Enter the Twitter URL here.', 'wordpresstheme' ),
			)
		);

		add_settings_field(
			'instagram',
			__( 'Instagram', 'wordpresstheme' ),
			array( $this, 'text_callback_function' ),
			'general',
			'socials',
			array(
				'name'        => 'instagram',
				'placeholder' => 'https://www.instagram.com/artvandelay',
				'description' => __( 'Enter the Instagram URL here.', 'wordpresstheme' ),
			)
		);

		add_settings_field(
			'public_email',
			__( 'Public Email Address', 'wordpresstheme' ),
			array( $this, 'email_callback_function' ),
			'general',
			'contacts',
			array(
				'name'        => 'public_email',
				'label'       => __( 'Email', 'wordpresstheme' ),
				'description' => __( 'This address is used for public purposes.', 'wordpresstheme' ),
				'placeholder' => 'artvandelay@vandelayindustries.com',
			)
		);

		add_settings_field(
			'page_for_join',
			__( 'Join page', 'wordpresstheme' ),
			array( $this, 'dropdown_pages_callback_function' ),
			'reading',
			'default',
			array(
				'name' => 'page_for_join',
			)
		);

		add_settings_field(
			'page_for_search',
			__( 'Search page', 'wordpresstheme' ),
			array( $this, 'dropdown_pages_callback_function' ),
			'reading',
			'default',
			array(
				'name' => 'page_for_search',
			)
		);

		add_settings_field(
			'page_for_apply',
			__( 'Apply page', 'wordpresstheme' ),
			array( $this, 'url_callback_function' ),
			'reading',
			'default',
			array(
				'name'        => 'page_for_apply',
				'label'       => __( 'Apply page', 'wordpresstheme' ),
				'description' => __( 'This is the URL where the application form is located.', 'wordpresstheme' ),
				'placeholder' => 'https://apply.com/',
			)
		);

		add_settings_field(
			'mailchimp_id',
			__( 'Mailchimp ID', 'wordpresstheme' ),
			array( $this, 'text_callback_function' ),
			'general',
			'default',
			array(
				'name'        => 'mailchimp_id',
				'placeholder' => '1d89f828f2',
				'description' => __( 'Enter the Mailchimp ID here.', 'wordpresstheme' ),
			)
		);

		add_settings_field(
			'mailchimp_user_id',
			__( 'Mailchimp User ID', 'wordpresstheme' ),
			array( $this, 'text_callback_function' ),
			'general',
			'default',
			array(
				'name'        => 'mailchimp_user_id',
				'placeholder' => '329b65911de079f4455a5fc82',
				'description' => __( 'Enter the Mailchimp user ID here.', 'wordpresstheme' ),
			)
		);

		add_settings_field(
			'mailchimp_form_id',
			__( 'Mailchimp Form ID', 'wordpresstheme' ),
			array( $this, 'text_callback_function' ),
			'general',
			'default',
			array(
				'name'        => 'mailchimp_form_id',
				'placeholder' => '00fe50e9f0',
				'description' => __( 'Enter the Mailchimp form ID here.', 'wordpresstheme' ),
			)
		);
	}


	/**
	 * Socials callback function
	 *
	 * @return void
	 */
	public function socials_callback_function() : void {
		echo '';
	}


	/**
	 * Contacts callback function
	 *
	 * @return void
	 */
	public function contacts_callback_function() : void {
		echo '';
	}


	/**
	 * Dropdown pages callback function
	 *
	 * @param array $args Arguments.
	 *
	 * @see https://developer.wordpress.org/reference/functions/wp_dropdown_pages/
	 *
	 * @return void
	 */
	public function dropdown_pages_callback_function( array $args ) : void {
		wp_dropdown_pages(
			array(
				'selected' => get_option( $args['name'] ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				'name'     => $args['name'], // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			)
		);
	}


	/**
	 * Text callback function
	 *
	 * @param array $args Args.
	 *
	 * @return void
	 */
	public function text_callback_function( array $args ) : void {
		wp_form_controls_input(
			array(
				'name'        => $args['name'],
				'value'       => get_option( $args['name'] ),
				'placeholder' => $args['placeholder'],
				'description' => isset( $args['description'] ) && ! empty( $args['description'] ) ? $args['description'] : $args['placeholder'],
			),
		);
	}


	/**
	 * Email callback function
	 *
	 * @param array $args Args.
	 *
	 * @return void
	 */
	public function email_callback_function( $args ) : void {
		wp_form_controls_input(
			array(
				'type'        => 'email',
				'name'        => $args['name'],
				'value'       => get_option( $args['name'] ),
				'placeholder' => $args['placeholder'],
				'description' => $args['description'],
				'attributes'  => array(
					'pattern'      => '[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$',
					'autocomplete' => 'email',
					'aria-label'   => $args['label'],
				),
			)
		);
	}


	/**
	 * URL callback function
	 *
	 * @param array $args Args.
	 *
	 * @return void
	 */
	public function url_callback_function( $args ) : void {
		wp_form_controls_input(
			array(
				'type'        => 'url',
				'name'        => $args['name'],
				'value'       => get_option( $args['name'] ),
				'placeholder' => $args['placeholder'],
				'description' => $args['description'],
			)
		);
	}

	/**
	 * Register settings
	 *
	 * @see https://developer.wordpress.org/reference/functions/register_setting/
	 *
	 * @return void
	 */
	public function register_settings() : void {
		$args = array(
			'type'              => 'string',
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => null,
		);

		foreach ( array( 'instagram', 'twitter', 'facebook', 'public_email', 'mailchimp_id', 'mailchimp_user_id', 'mailchimp_form_id' ) as $setting ) {
			register_setting( 'general', $setting, $args );
		}

		register_setting(
			'reading',
			'page_for_join',
			array(
				'type'              => 'integer',
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => null,
			)
		);

		register_setting(
			'reading',
			'page_for_search',
			array(
				'type'              => 'integer',
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => null,
			)
		);

		register_setting(
			'reading',
			'page_for_apply',
			array(
				'type'              => 'integer',
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => null,
			)
		);
	}
}

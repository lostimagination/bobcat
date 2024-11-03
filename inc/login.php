<?php
/**
 * Customise login screen
 *
 * @link https://codex.wordpress.org/Customizing_the_Login_Form
 *
 * @package bobcat
 * @subpackage inc/
 */

// Enable strict typing mode.
declare( strict_types = 1 );

if ( ! function_exists( 'it_login_url' ) ) {

	/**
	 * Changing the logo link from wordpress.org to root domain
	 *
	 * @return string
	 */
	function it_login_url(): string {
		return home_url();
	}

	add_filter( 'login_headerurl', 'it_login_url' );

}

if ( ! function_exists( 'it_login_title' ) ) {

	/**
	 * Changing the alt text on the logo to show your site name
	 *
	 * @return mixed
	 */
	function it_login_title(): mixed {
		return get_option( 'blogname' );
	}

	add_filter( 'login_headertext', 'it_login_title' );

}

if ( ! function_exists( 'it_login_stylesheet' ) ) {

	/**
	 * Styles for login page
	 *
	 * @return void
	 */
	function it_login_stylesheet(): void {
		wp_enqueue_style( 'it-login', IT_CSS . 'login.css', array(), IT_VERSION );
	}

	add_action( 'login_enqueue_scripts', 'it_login_stylesheet' );

}

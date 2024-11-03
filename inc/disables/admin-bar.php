<?php
/**
 * Admin Bar modifications
 *
 * @package bobcat
 * @subpackage inc/disables/
 */

// Enable strict typing mode.
declare( strict_types = 1 );

if ( ! function_exists( 'it_clear_admin_bar' ) ) {

	/**
	 * Remove WP logo
	 */
	function it_clear_admin_bar(): void {
		global $wp_admin_bar;

		$wp_admin_bar->remove_menu( 'wp-logo' );
	}

	add_action( 'wp_before_admin_bar_render', 'it_clear_admin_bar' );

}

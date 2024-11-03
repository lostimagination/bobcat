<?php
/**
 * AJAX functions
 *
 * @link https://developer.wordpress.org/reference/hooks/wp_ajax_action/
 * @package bobcat
 * @subpackage inc/
 */

// Enable strict typing mode.
declare( strict_types = 1 );

if ( ! function_exists( 'it_example_callback' ) ) {

	/**
	 * Remove archive title prefix.
	 *
	 * @return void
	 */
	function it_example_callback(): void {
		wp_die();
	}

	add_action( 'wp_ajax_it_example_action', 'it_example_callback' );
	add_action( 'wp_ajax_nopriv_it_example_action', 'it_example_callback' );
}

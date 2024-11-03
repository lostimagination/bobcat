<?php
/**
 * Disable wp-embed.js
 *
 * @package bobcat
 * @subpackage inc/disables/
 */

// Enable strict typing mode.
declare( strict_types = 1 );

if ( ! function_exists( 'it_wpembed_deregister_scripts' ) ) {

	/**
	 * Dequeue wp-embed script.
	 *
	 * @return void
	 */
	function it_wpembed_deregister_scripts(): void {
		wp_dequeue_script( 'wp-embed' );
	}

	add_action( 'wp_footer', 'it_wpembed_deregister_scripts' );

}

<?php
/**
 * Disable auto append of sharing buttons after content and excerpt
 *
 * @package bobcat
 * @subpackage inc/disables/
 */

// Enable strict typing mode.
declare( strict_types = 1 );

if ( ! function_exists( 'it_disable_jpsharing_append' ) ) {

	/**
	 * Remove filters of jpsharing.
	 *
	 * @return void
	 */
	function it_disable_jpsharing_append(): void {
		remove_filter( 'the_content', 'sharing_display', 19 );
		remove_filter( 'the_excerpt', 'sharing_display', 19 );
	}

	add_action( 'init', 'it_disable_jpsharing_append' );

}

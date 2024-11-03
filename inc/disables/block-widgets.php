<?php
/**
 * Restoring the classic Widgets Editor
 *
 * @package bobcat
 * @subpackage inc/disables/
 */

// Enable strict typing mode.
declare( strict_types = 1 );

if ( ! function_exists( 'it_restore_classic_widgets' ) ) {

	/**
	 * Disable support for widgets block editor to restore classic widgets.
	 */
	function it_restore_classic_widgets(): void {
		remove_theme_support( 'widgets-block-editor' );
	}

	add_action( 'after_setup_theme', 'it_restore_classic_widgets' );

}

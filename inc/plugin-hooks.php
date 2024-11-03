<?php
/**
 * Functions that depends from vendor plugins.
 *
 * @link https://developer.wordpress.org/reference/hooks/after_setup_theme/
 *
 * @package bobcat
 * @subpackage inc/
 */

// Enable strict typing mode.
declare( strict_types = 1 );

if ( class_exists( 'GFCommon' ) && ! function_exists( 'it_spinner_url' ) ) {

	/**
	 * Changes Gravity Forms Ajax Spinner (next, back, submit) to a transparent image.
	 * this allows us to target the css and create a pure css spinner or add different image instead.
	 *
	 * @return string
	 */
	function it_spinner_url(): string {
		return 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7';
	}

	add_filter( 'gform_ajax_spinner_url', 'it_spinner_url', 10 );

}

if ( class_exists( 'WPCF7' ) ) {

	add_filter( 'wpcf7_autop_or_not', '__return_false' );
	add_filter( 'wpcf7_load_css', '__return_false' );

}

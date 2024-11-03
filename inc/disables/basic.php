<?php
/**
 * General recommended updates
 *
 * @package bobcat
 * @subpackage inc/disables/
 */

// Enable strict typing mode.
declare( strict_types = 1 );

/**
 * Remove WordPress version from head tag
 */
remove_action( 'wp_head', 'wp_generator' );

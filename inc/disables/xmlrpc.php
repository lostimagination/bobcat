<?php
/**
 * Disable XMLRPC
 *
 * @package bobcat
 * @subpackage inc/disables/
 */

// Enable strict typing mode.
declare( strict_types = 1 );

add_filter( 'xmlrpc_enabled', '__return_false' );

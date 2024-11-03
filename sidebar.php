<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bobcat
 */

// Enable strict typing mode.
declare( strict_types = 1 );

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside class="sidebar widget-area">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside>

<?php
/**
 * Global title component.
 *
 * @package bobcat
 * @subpackage template-parts/builder/components
 */

// Enable strict typing mode.
declare( strict_types = 1 );

$class     = $args['class'] ?? 'h2';
$the_title = get_sub_field( 'title' );
$the_tag   = get_sub_field( 'title_tag' ) ? get_sub_field( 'title_tag' ) : 'h2'; // Possible values: h1-h6, span.
$alignment = get_sub_field( 'title_alignment' ) ? get_sub_field( 'title_alignment' ) : 'left'; // Possible values: left, center, right.

if ( $the_title ) {
	printf(
		'<%s class="c-title %s text-%s">%s</%s>',
		esc_attr( $the_tag ),
		esc_attr( $class ),
		esc_attr( $alignment ),
		wp_kses_post( $the_title ),
		esc_attr( $the_tag )
	);
}

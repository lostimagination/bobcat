<?php
/**
 * Flexible Content template
 *
 * @package bobcat
 * @subpackage template-parts
 */

// Enable strict typing mode.
declare( strict_types = 1 );

$index = 1;

// Loop over the ACF flexible fields of this page / post.
while ( have_rows( 'builder' ) ) : the_row();

	// load the layout from sub folder.
	get_template_part( 'template-parts/builder/' . get_row_layout(), null, [ 'index' => $index ] );
	$index++;

endwhile;

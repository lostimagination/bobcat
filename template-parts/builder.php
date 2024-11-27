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
$term = $args['term'] ?? null;
$post_object = $args['post_object'] ?? null;
$post_item = $term ?: $post_object;


while ( have_rows( 'builder' , $post_item ) ) : the_row();

	get_template_part(
		'template-parts/builder/' . get_row_layout(),
		null,
		[
			'index' => $index,
			'term' => $term,
			'post_object' => $post_object
		]
	);
	$index++;

endwhile;

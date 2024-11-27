<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package bobcat
 */

// Enable strict typing mode.
declare( strict_types=1 );

get_header();
the_post();
$post_object = get_queried_object();
?>

<?php if ( have_rows( 'builder', $post_object ) ) : ?>

	<?php
	get_template_part( 'template-parts/builder', null, [
		'post_object' => $post_object
	] );
	?>
<?php endif; ?>

<?php
get_footer();

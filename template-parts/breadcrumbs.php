<?php
/**
 * Output Yoast breadcrumbs if they are enabled, and it is not a homepage
 *
 * @package bobcat
 * @subpackage template-parts
 */

// Enable strict typing mode.
declare( strict_types = 1 );

if ( function_exists( 'yoast_breadcrumb' ) && ! is_front_page() ) : ?>
	<div class="breadcrumbs">
		<div class="container">
			<?php yoast_breadcrumb( '<p id="breadcrumbs">', '</p>' ); ?>
		</div>
	</div>
<?php endif; ?>

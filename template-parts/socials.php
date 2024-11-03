<?php
/**
 * Socials template
 *
 * @package bobcat
 * @subpackage template-parts
 */

// Enable strict typing mode.
declare( strict_types = 1 );

if ( have_rows( 'socials', 'options' ) ) : ?>
	<div class="socials">
		<?php
		while ( have_rows( 'socials', 'options' ) ) : the_row();

			$name = get_sub_field( 'name' );
			$url  = get_sub_field( 'url' );

			if ( $name ) :
				?>
				<a class="socials__item" href="<?php echo esc_url( $url ); ?>" target="_blank" rel="nofollow" aria-label="<?php echo esc_attr( $name ); ?>">
					<svg class="icon-<?php echo esc_attr( $name ); ?>">
						<use xlink:href="#<?php echo esc_attr( $name ); ?>"></use>
					</svg>
				</a>
			<?php endif; ?>

		<?php endwhile; ?>
	</div>
<?php endif; ?>

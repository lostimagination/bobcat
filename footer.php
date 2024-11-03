<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bobcat
 */

// Enable strict typing mode.
declare( strict_types = 1 );

$logo_id       = get_field( 'logo', 'options' );
$logo          = is_int( $logo_id ) ? wp_get_attachment_image( $logo_id, 'medium' ) : '';
$enable_to_top = get_field( 'enable_to_top', 'options' );
?>

</main><!-- /.site-content -->

<footer class="site-footer">
	<div class="container">
		<?php if ( ! empty( $logo ) ) : ?>
			<a href="<?php echo esc_url( home_url() ); ?>" class="site-logo" rel="home" aria-label="<?php bloginfo( 'name' ); ?>">
				<?php echo wp_kses_post( $logo ); ?>
			</a>
		<?php endif; ?>

		<?php
		wp_nav_menu(
			array(
				'theme_location'  => 'footer',
				'container_class' => 'footer-links__container',
				'menu_class'      => 'footer-links',
				'fallback_cb'     => false,
			)
		);
		?>

		<?php get_template_part( 'template-parts/socials' ); ?>
	</div>

	<div class="site-footer__copyright">
		<div class="container">
			<span>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php esc_html_e( 'All rights reserved', 'bobcat' ); ?></span>
		</div>
	</div>
</footer>

<?php get_template_part( 'template-parts/svg' ); ?>

<?php if ( $enable_to_top && ! is_404() ) : ?>
	<a id="to-top" href="#top">
		<svg>
			<use xlink:href="#angle-up"></use>
		</svg>
		<span class="screen-reader-text"><?php esc_html_e( 'Scroll to top', 'bobcat' ); ?></span> </a>
<?php endif; ?>

<?php wp_footer(); ?>

</body></html>

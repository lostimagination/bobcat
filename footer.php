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
declare( strict_types=1 );

$logo_id        = get_field( 'footer_logo', 'options' );
$logo           = is_int( $logo_id ) ? wp_get_attachment_image( $logo_id, 'medium' ) : '';
$enable_to_top  = get_field( 'enable_to_top', 'options' );
$info_section   = get_field( 'info_section', 'options' );
$link_section   = get_field( 'link_section', 'options' );
$number_phone   = get_field( 'number_phone', 'options' );
$email          = get_field( 'email', 'options' );
$title_form     = get_field( 'title_form', 'options' );
$form_footer    = get_field( 'form_footer', 'options' );
$title_address  = get_field( 'title_address', 'options' );
$name_company   = get_field( 'name_company', 'options' );
$address        = get_field( 'address', 'options' );
$title_location = get_field( 'title_location', 'options' );
$title_product  = get_field( 'title_product', 'options' );
$copyright      = get_field( 'copyright', 'option' );
?>

</main><!-- /.site-content -->
<div class="map-wrapper">

	<?php if ( $image_map = get_field( 'image_map', 'options' ) ) : ?>
		<div class="map">
			<?php echo wp_get_attachment_image( $image_map['id'], 'medium', false, array( 'class' => '' ) ); ?>
		</div>
	<?php endif; ?>

	<div class="footer-info">

		<div class="row">
			<div class="col-lg-8">
				<?php if ( $info_section ) : ?>
					<div><?php echo wp_kses_post( $info_section ) ?></div>
				<?php endif; ?>

				<?php if ( $link_section ) :
					$link_section_target = $link_section['target'] ? $link_section['target'] : '_self'; ?>
					<a class="btn btn-secondary" target="<?php echo esc_attr( $link_section_target ); ?>"
					   href="<?php echo esc_url( $link_section['url'] ); ?>">
						<?php echo $link_section['title'] ?>
					</a>
				<?php endif; ?>

			</div>
		</div>
	</div>
</div>
<footer class="site-footer">
	<div class="footer-top">
		<div class="container">
			<div class="row align-center">
				<div class="col-md-6 border-section">
					<div class="wrapper-phone">
						<?php if ( $number_phone ) : ?>
							<a class="footer-phone" href="tel:<?php echo it_phone_cleaner( $number_phone ) ?>">
								<svg>
									<use xlink:href="#phone-white"></use>
								</svg>

								<?php echo esc_html( $number_phone ); ?>
							</a>
						<?php endif; ?>

						<?php if ( $email ) : ?>
							<a class="footer-email" href="mailto:<?php echo $email; ?>">
								<svg>
									<use xlink:href="#letter"></use>
								</svg>
								<?php echo esc_html( $email ); ?>
							</a>
						<?php endif; ?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-footer">
						<?php if ( $title_form ) : ?>
							<h6 class="title-form"><?php echo esc_html( $title_form ) ?></h6>
						<?php endif; ?>

						<?php if ( $form_footer ) : ?>
							<?php echo do_shortcode( $form_footer ); ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="footer-middle">
		<div class="container">
			<div class="row">
				<div class="col-lg-2">
					<?php if ( $title_address ) : ?>
						<h6 class="title-middle"><?php echo esc_html( $title_address ) ?></h6>
					<?php endif; ?>

					<?php if ( $name_company ) : ?>
						<p class="footer-common"><?php echo esc_html( $name_company ) ?></p>
					<?php endif; ?>

					<?php if ( $address ) : ?>
						<p class="footer-common"><?php echo $address ?></p>
					<?php endif; ?>
				</div>
				<div class="col-lg-4">
					<?php if ( $title_location ) : ?>
						<h6 class="title-middle"><?php echo esc_html( $title_location ) ?></h6>
					<?php endif; ?>
					<?php

					$location = get_field( 'location', 'option' );

					if ( $location ): ?>
						<ul class="footer-list">
							<?php foreach ( $location as $post ): ?>
								<?php setup_postdata( $post ); ?>
								<li>
									<a class="footer-common" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>

								</li>
							<?php endforeach; ?>
						</ul>
						<?php wp_reset_postdata(); ?>
					<?php endif; ?>


				</div>
				<div class="col-lg-6">
					<?php if ( $title_product ) : ?>
						<h6 class="title-middle"><?php echo esc_html( $title_product ) ?></h6>
					<?php endif; ?>
					<?php

					$products = get_field( 'products', 'option' );

					if ( $products ): ?>
						<ul class="footer-list">
							<?php foreach ( $products as $post ): ?>
								<?php setup_postdata( $post ); ?>
								<li>
									<a class="footer-common" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>

								</li>
							<?php endforeach; ?>
						</ul>
						<?php wp_reset_postdata(); ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="footer-bottom">
		<div class="container">
			<div class="footer-bottom-inner">
				<?php if ( ! empty( $logo ) ) : ?>
					<a href="<?php echo esc_url( home_url() ); ?>" class="footer-logo" rel="home"
					   aria-label="<?php bloginfo( 'name' ); ?>">
						<?php echo wp_kses_post( $logo ); ?>
					</a>
				<?php endif; ?>
				<div class="footer-copyrights">
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

					<?php if ( $copyright ) : ?>
						<div class="copyright">
							<span>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php echo esc_html($copyright); ?></span>
						</div>
					<?php endif; ?>
				</div>
			</div>


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

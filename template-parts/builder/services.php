<?php
$section_title = get_sub_field( 'section_title' );
?>
<section class="section section-services">
    <div class="container">
		<?php if ( $section_title ) : ?>
            <div class="section-title">
				<?php echo wp_kses_post( $section_title ); ?>
            </div>
		<?php endif; ?>

		<?php if ( have_rows( 'services' ) ) : ?>
            <div class="row justify-content-center">
				<?php while ( have_rows( 'services' ) ) : the_row();
					$title     = get_sub_field( 'title' );
					$info      = get_sub_field( 'info' );
					$more_link = get_sub_field( 'more_link' );
					?>
                    <div class="col-md-6 col-lg-4">
                        <div class="service-card">
							<?php if ( $title ) : ?>
                                <h3 class="service-card__title h2">
									<?php echo esc_html( $title ); ?>
                                </h3>
							<?php endif; ?>

							<?php if ( $info ) : ?>
                                <div class="service-card__info">
									<?php echo wp_kses_post( $info ); ?>
                                </div>
							<?php endif; ?>

							<?php if ( $more_link ) :
								$link_target = $more_link['target'] ? $more_link['target'] : '_self';
								?>
                                <a href="<?php echo esc_url( $more_link['url'] ); ?>"
                                   class="service-card__link"
                                   target="<?php echo esc_attr( $link_target ); ?>">
									<?php echo esc_html( $more_link['title'] ); ?>
                                </a>
							<?php endif; ?>
                        </div>
                    </div>
				<?php endwhile; ?>
            </div>
		<?php endif; ?>
    </div>
</section>

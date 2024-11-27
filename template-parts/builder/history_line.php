<section class="history_line section">
    <div class="container">
		<?php get_template_part( 'template-parts/builder/components/title', null, array( 'class' => '' ) ) ?>
    </div>
    <div class="container">
		<?php if ( have_rows( 'our_history' ) ) : ?>
            <div class="history-slider-wrapper">
                <div class="swiper slider-history">
                    <div class="swiper-wrapper">
						<?php while ( have_rows( 'our_history' ) ) : the_row(); ?>
							<?php
							$year         = get_sub_field( 'year' );
							$history_info = get_sub_field( 'history_info' );
							?>

                            <div class="swiper-slide">
                                <div class="our-history">
									<?php if ( $year ) : ?>
                                        <p class="year"><?php echo esc_html( $year ) ?></p>
									<?php endif; ?>

									<?php if ( $history_info ) : ?>
                                        <div class="history-info"><?php echo wp_kses_post( $history_info ) ?></div>
									<?php endif; ?>
                                </div>
                            </div>
						<?php endwhile; ?>
                    </div>
                    <div class="swiper-button-next arrow-right">
                        <svg>
                            <use xlink:href="#slider-arrow-right"></use>
                        </svg>
                    </div>
                    <div class="swiper-button-prev arrow-left">
                        <svg>
                            <use xlink:href="#slider-arrow-left"></use>
                        </svg>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
		<?php endif; ?>
    </div>
</section>

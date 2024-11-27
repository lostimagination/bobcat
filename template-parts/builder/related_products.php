<?php
$section_title = get_sub_field( 'section_title' );
?>
<section class="related-product-section section section--double-padding section-bg-grey">
    <div class="container">
		<?php if ( $section_title ) : ?>
            <div class="section-title">
				<?php echo wp_kses_post( $section_title ); ?>
            </div>
		<?php endif; ?>
		<?php

		$related_products = get_sub_field( 'related_products' );

		if ( $related_products ): ?>
            <div class="related-product-gallery">
                <div class="swiper related-product-gallery-slider">
                    <div class="swiper-wrapper">
						<?php foreach ( $related_products as $post ): ?>
							<?php setup_postdata( $post ); ?>
                            <div class="swiper-slide">
                                <div class="related-product-card">
									<?php if ( has_post_thumbnail() ) : ?>
                                        <div class="related-product-card__image">
											<?php the_post_thumbnail( 'large', array( 'class' => 'flex-image' ) ) ?>
                                        </div>
									<?php endif; ?>
                                    <div class="related-product-card__info">
                                        <div class="related-product-card__title">
		                                    <?php the_title(); ?>
                                        </div>
                                        <div class="related-product-card__content">
	                                        <?php echo wp_trim_words( get_the_content(), 30 ) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
						<?php endforeach; ?>
                    </div>
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
			<?php wp_reset_postdata(); ?>
		<?php endif; ?>

    </div>
</section>

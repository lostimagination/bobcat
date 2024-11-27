<?php
$rating_value = get_sub_field( 'rating_value' );
$star_rating  = get_sub_field( 'star_rating' );
$info         = get_sub_field( 'info' );
?>
<section class="machine-rating section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="rating-block">
					<?php if ( $rating_value ) : ?>
                        <div class="h2"><?php echo esc_html( $rating_value ); ?></div>
						<?php if ( $star_rating ) : ?>
                            <div class="star-rating">
								<?php for ( $i = 1; $i <= 5; $i ++ ): ?>
									<?php $star_type = $i <= $star_rating ? 'star' : 'star empty-star'; ?>
                                    <svg class="<?php echo esc_attr( $star_type ); ?>">
                                        <use xlink:href="#star"></use>
                                    </svg>
								<?php endfor; ?>
                            </div>
						<?php endif; ?>
					<?php endif; ?>
					<?php if ( $info ) : ?>
                        <article class="machine-rating-info">
							<?php echo wp_kses_post( $info ); ?>
                        </article>
					<?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

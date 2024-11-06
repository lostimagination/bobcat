<section class="section section-border-top">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
				<?php get_template_part( 'template-parts/builder/components/title', null, array( 'class' => '' ) ) ?>

				<?php if ( have_rows( 'mech_features_list' ) ) : ?>
                    <div class="js-accordion m-features-accordion">
						<?php while ( have_rows( 'mech_features_list' ) ) : the_row();
							$name = get_sub_field( 'name' );
							?>
                            <div class="js-accordion-item m-features-accordion-item">
                                <div class="h5 js-accordion-title m-features-accordion__title">
                                    <span><?php echo esc_html( $name ); ?></span>
                                    <svg width="21" height="21">
                                        <use xlink:href="#angle-down"></use>
                                    </svg>
                                </div>
                                <div class="js-accordion-content">
		                            <?php if ( have_rows( 'features' ) ) : ?>
                                        <div class="m-feature-content">
				                            <?php while ( have_rows( 'features' ) ) : the_row();
					                            $feature = get_sub_field( 'feature' );
					                            $value   = get_sub_field( 'value' );
					                            ?>
                                                <div class="m-feature-content-item">
                                                    <div class="m-feature-content-item__name">
							                            <?php if ( $feature ) : ?>
								                            <?php echo esc_html( $feature ); ?>
							                            <?php endif; ?>
                                                    </div>
                                                    <div class="m-feature-content-item__value">
							                            <?php if ( $value ) : ?>
								                            <?php echo esc_html( $value ); ?>
							                            <?php endif; ?>
                                                    </div>
                                                </div>
				                            <?php endwhile; ?>
                                        </div>
		                            <?php endif; ?>
                                </div>
                            </div>
						<?php endwhile; ?>
                    </div>
				<?php endif; ?>

				<?php
				$link = get_sub_field( 'link' );
				if ( $link ) :
					$link_target = $link['target'] ? $link['target'] : '_self';
					?>
                    <a
                            class="btn btn-full"
                            target="<?php echo esc_attr( $link_target ); ?>"
                            href="<?php echo esc_url( is_array( $link ) ? $link['url'] : null ); ?>">
						<?php echo esc_html( $link['title'] ); ?>
                    </a>

				<?php endif; ?>
            </div>
        </div>
    </div>
</section>

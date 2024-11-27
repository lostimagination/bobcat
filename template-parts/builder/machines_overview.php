<section class="section section-border-top">
    <div class="container">
		<?php get_template_part( 'template-parts/builder/components/title', null, array( 'class' => '' ) ) ?>

		<?php
		$info = get_sub_field( 'info' );
		if ( $info ) :
			?>
            <article>
				<?php echo wp_kses_post( $info ); ?>
            </article>
		<?php endif; ?>

		<?php

		$machines_list = get_sub_field( 'machines_list' );

		if ( $machines_list ): ?>
			<?php foreach ( $machines_list as $post ): ?>
				<?php setup_postdata( $post ); ?>
                <div class="machine-wide-card">
                    <a class="flex-link" href="<?php the_permalink(); ?>"></a>
                    <div class="row">
                        <div class="col-md-4">
	                        <?php if ( has_post_thumbnail() ) : ?>
                                <div class="machine-wide-card__image">
			                        <?php the_post_thumbnail( 'large', array( 'class' => 'flex-image' ) ) ?>
                                </div>
	                        <?php endif; ?>
                        </div>
                        <div class="col-md-8">
                            <div class="machine-wide-card__info">
                                <h5><?php the_title(); ?></h5>

		                        <?php if ( have_rows( 'specification' ) ) : ?>
                                    <ul class="list-border list-border--small">
				                        <?php while ( have_rows( 'specification' ) ) : the_row();
					                        $icon           = get_sub_field( 'icon' );
					                        $characteristic = get_sub_field( 'characteristic' );
					                        ?>

                                            <li>
						                        <?php if ( $characteristic ) : ?>
                                                    <span><?php echo esc_html( $characteristic ); ?></span>
						                        <?php endif; ?>
                                            </li>

				                        <?php endwhile; ?>

                                        <li>
					                        <?php echo wp_trim_words( get_the_content(), 30 ); ?>
                                        </li>
                                    </ul>
		                        <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="machine-wide-card__link">
                        <div class="machine-wide-card__icon">
                            <svg>
                                <use xlink:href="#slider-arrow-right"></use>
                            </svg>
                        </div>
                    </div>

                </div>
			<?php endforeach; ?>
			<?php wp_reset_postdata(); ?>
		<?php endif; ?>

    </div>
</section>

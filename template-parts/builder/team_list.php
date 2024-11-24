<section class="section">
    <div class="container">
		<?php get_template_part( 'template-parts/builder/components/title', null, array( 'class' => '' ) ) ?>

		<?php

		$team = get_sub_field( 'team' );

		if ( $team ): ?>
            <div class="row">
				<?php foreach ( $team as $post ): ?>
					<?php setup_postdata( $post ); ?>
					<?php
					$department = get_field( 'department' );
					$phone      = get_field( 'phone' );
					$email      = get_field( 'email' );
					?>

                    <div class="col-lg-4">
                        <div class="member-card">
							<?php if ( $department ) : ?>
                                <div class="member-card__department">
                                    <h3><?php echo esc_html( $department ); ?></h3>
                                </div>
							<?php endif; ?>
							<?php if ( has_post_thumbnail() ) : ?>
                                <div class="member-card__image">
									<?php the_post_thumbnail( 'large', array( 'class' => 'flex-image' ) ) ?>
                                </div>
							<?php endif; ?>
                            <div class="member-card__info">
                                <div class="member-card__title">
									<?php the_title(); ?>
                                </div>
								<?php if ( $phone ) : ?>
                                    <div class="contact-details-item">
                                        <div class="contact-details-item__icon">
                                            <svg>
                                                <use xlink:href="#phone"></use>
                                            </svg>
                                        </div>
                                        <div class="contact-details-item__info">
                                            <a href="tel:<?php echo it_phone_cleaner( $phone ) ?>"><?php echo esc_html( $phone ); ?></a>
                                        </div>
                                    </div>
								<?php endif; ?>
								<?php if ( $email ) : ?>
                                    <div class="contact-details-item">
                                        <div class="contact-details-item__icon">
                                            <svg>
                                                <use xlink:href="#envelope"></use>
                                            </svg>
                                        </div>
                                        <div class="contact-details-item__info">
                                            <a href="mailto:<?php echo $email ?>"><?php echo esc_html( $email ); ?></a>
                                        </div>
                                    </div>
								<?php endif; ?>
                            </div>
                        </div>
                    </div>

				<?php endforeach; ?>
            </div>
			<?php wp_reset_postdata(); ?>
		<?php endif; ?>

    </div>
</section>

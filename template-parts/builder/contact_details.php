<?php
$contacts_title      = get_sub_field( 'contacts_title' );
$location_address    = get_sub_field( 'location_address' );
$phone               = get_sub_field( 'phone' );
$fax                 = get_sub_field( 'fax' );
$email               = get_sub_field( 'email' );
$working_hours_title = get_sub_field( 'working_hours_title' );
$working_hours       = get_sub_field( 'working_hours' );
$map                 = get_sub_field( 'map' );
?>
<section class="section section-contacts">
    <div class="container">
		<?php get_template_part( 'template-parts/builder/components/title', null, array( 'class' => '' ) ) ?>

        <div class="row">
            <div class="col-lg-10">
				<?php
				$info = get_sub_field( 'info' );
				if ( $info ) :
					?>
                    <article class="editor contacts-info">
						<?php echo wp_kses_post( $info ); ?>
                    </article>
				<?php endif; ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-lg-5">
				<?php if ( $contacts_title ) : ?>
                    <h5 class=""><?php echo esc_html( $contacts_title ); ?></h5>
				<?php endif; ?>
				<?php if ( $location_address ) : ?>
                    <div class="contact-details-item">
                        <div class="contact-details-item__icon">
                            <svg>
                                <use xlink:href="#pin"></use>
                            </svg>
                        </div>
                        <div class="contact-details-item__info">
							<?php echo wp_kses_post( nl2br($location_address) ); ?>
                        </div>
                    </div>
				<?php endif; ?>
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
				<?php if ( $fax ) : ?>
                    <div class="contact-details-item">
                        <div class="contact-details-item__icon">
                            <svg>
                                <use xlink:href="#fax"></use>
                            </svg>
                        </div>
                        <div class="contact-details-item__info">
                            <a href="tel:<?php echo it_phone_cleaner( $fax ) ?>"><?php echo esc_html( $fax ); ?></a>
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
            <div class="col-md-6 col-lg-5">
				<?php if ( $working_hours_title ) : ?>
                    <h5><?php echo esc_html( $working_hours_title ); ?></h5>
				<?php endif; ?>
				<?php if ( $location_address ) : ?>
                    <div class="contact-details-item">
                        <div class="contact-details-item__icon">
                            <svg>
                                <use xlink:href="#clock"></use>
                            </svg>
                        </div>
                        <div class="contact-details-item__info">
							<?php echo esc_html( $working_hours ); ?>
                        </div>
                    </div>
				<?php endif; ?>
            </div>
        </div>
		<?php if ( $map ) : ?>
            <div class="contact-map">
				<?php echo $map; ?>
            </div>
		<?php endif; ?>
    </div>
</section>

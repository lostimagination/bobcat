<section class="section section-mech-rent">
    <div class="container">
        <div class="mech-rent-card">
            <div class="row">
                <div class="col-lg-4">
					<?php
					$image = get_sub_field( 'image' );
					if ( $image ) : ?>
                        <div class="mech-rent__image">
							<?php echo wp_get_attachment_image( $image['ID'], 'full', false, array(
								'class' => 'flex-image',
								'alt'   => $image['alt']
							) ); ?>
                        </div>
					<?php endif; ?>
                </div>

                <div class="col-lg-8">
					<?php
					$info = get_sub_field( 'info' );
					if ( $info ) : ?>
                        <div class="mech-rent__info editor">
							<?php echo wp_kses_post( $info ); ?>
                        </div>
					<?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

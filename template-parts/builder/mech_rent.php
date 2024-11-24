<?php
$image_position = get_sub_field( 'image_position' ) ? 'flex-row-reverse' : '';
?>
<section class="section section-mech-rent">
    <div class="container">
        <div class="mech-rent-card">
            <div class="row <?php echo esc_attr( $image_position ); ?>">
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

	                        <?php
	                        if ( $link = get_sub_field( 'link' ) ) :
		                        $link_target = $link['target'] ? $link['target'] : '_self';
		                        ?>
                                <a
                                        class="btn mech-rent__link"
                                        target="<?php echo esc_attr( $link_target ); ?>"
                                        href="<?php echo esc_url( is_array( $link ) ? $link['url'] : null ); ?>">
			                        <?php echo esc_html( $link['title'] ); ?>
                                </a>
	                        <?php endif; ?>
                        </div>
					<?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

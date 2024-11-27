<?php
$info_section = get_sub_field( 'info_section' );
$link_section = get_sub_field( 'link_section' );
?>
<div class="map-wrapper">

	<?php if ( $image_map = get_sub_field( 'image_map', 'options' ) ) : ?>
        <div class="map">
			<?php echo wp_get_attachment_image( $image_map['id'], 'medium', false, array( 'class' => '' ) ); ?>
        </div>
	<?php endif; ?>

    <div class="footer-info">

        <div class="row">
            <div class="col-lg-8">
				<?php if ( $info_section ) : ?>
                    <div><?php echo wp_kses_post( $info_section ) ?></div>
				<?php endif; ?>

				<?php if ( $link_section ) :
					$link_section_target = $link_section['target'] ? $link_section['target'] : '_self'; ?>
                    <a class="btn btn-secondary" target="<?php echo esc_attr( $link_section_target ); ?>"
                       href="<?php echo esc_url( $link_section['url'] ); ?>">
						<?php echo $link_section['title'] ?>
                    </a>
				<?php endif; ?>

            </div>
        </div>
    </div>
</div>

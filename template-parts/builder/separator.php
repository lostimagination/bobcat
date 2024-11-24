<?php
$paragraph = get_sub_field( 'paragraph' );
$bg_type     = get_sub_field( 'background_type' ) ? 'bg-dark' : 'bg-red';
?>

<section class="separator <?php echo esc_attr( $bg_type ); ?>">

		<?php if ( $paragraph ) : ?>
			<div class="separator-text">
				<?php echo wp_kses_post( $paragraph ) ?>
			</div>
		<?php endif; ?>

</section>

<?php
$container_width = get_sub_field( 'container_width' );
$content         = get_sub_field( 'info' );
?>
<section class="default-content section">
    <div class="container">
		<?php if ( $container_width ) : ?>
        <div class="row justify-center">
            <div class="col-lg-8">
				<?php endif; ?>
				<?php echo wp_kses_post( $content ); ?>
				<?php if ( $container_width ) : ?>
            </div>
        </div>
	<?php endif; ?>
    </div>
</section>

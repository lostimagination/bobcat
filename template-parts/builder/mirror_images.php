<section class="section mirror-section section--double-padding">
    <div class="container">
		<?php get_template_part( 'template-parts/builder/components/title', null, array( 'class' => '' ) ) ?>
		<?php
		$info = get_sub_field( 'info' );
		if ( $info ) :
			?>
            <article class="editor mirror-info">
				<?php echo wp_kses_post( $info ); ?>
            </article>
		<?php endif; ?>

		<?php if ( have_rows( 'mirror_images' ) ) : ?>

			<?php while ( have_rows( 'mirror_images' ) ) : the_row();
				$image   = get_sub_field( 'image' );
				$info    = get_sub_field( 'info' );
				$reverse = get_row_index() % 2 === 0 ? 'flex-row-reverse' : '';
				?>

                <div class="row <?php echo esc_attr( $reverse ); ?>">
                    <div class="col-md-6">
						<?php if ( $image ) : ?>
                            <div class="mirror-image">
								<?php echo wp_get_attachment_image( $image['id'], 'large', false, array( 'class' => 'flex-image' ) ); ?>
                            </div>
						<?php endif; ?>
                    </div>
                    <div class="col-md-6">
                        <article class="editor">
							<?php echo wp_kses_post( $info ); ?>
                        </article>
                    </div>
                </div>

			<?php endwhile; ?>

		<?php endif; ?>
    </div>
</section>

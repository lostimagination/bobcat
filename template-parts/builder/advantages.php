<?php
$content = get_sub_field( 'content' );
?>

<section class="advantages section">
	<div class="container">
		<?php get_template_part( 'template-parts/builder/components/title', null, array( 'class' => '' ) ) ?>
		<?php $content = get_sub_field( 'content' ); ?>
		<div class="row">
			<div class="col-lg-10">
				<?php if ( $content ) : ?>
					<div class="content-margin"><?php echo wp_kses_post( $content ) ?></div>
				<?php endif; ?>
			</div>
		</div>
		<div class="row">
			<?php if ( have_rows( 'all_advantages' ) ) : ?>
				<?php while ( have_rows( 'all_advantages' ) ) : the_row(); ?>
					<div class="col-md-6 col-lg-4">
						<div class="advantage">
							<?php
							$icon      = get_sub_field( 'icon' );
							$title     = get_sub_field( 'title' );
							$paragraph = get_sub_field( 'paragraph' );
							?>

							<?php if ( $icon ) : ?>
									<?php echo wp_get_attachment_image( $icon['id'], 'thumbnail', false, array( 'class' => 'icon-svg' ) ); ?>
							<?php endif; ?>

							<div class="advantage-content">
								<?php if ( $title ) : ?>
									<h5 class="advantage-content__title"><?php echo esc_html( $title ) ?></h5>
								<?php endif; ?>

								<?php if ( $paragraph ) : ?>
									<p class="advantage-content__paragraph"><?php echo esc_html( $paragraph ) ?></p>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
			<?php endif; ?>

		</div>
	</div>
</section>

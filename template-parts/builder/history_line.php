<section class="history_line">
	<div class="container">
		<?php get_template_part( 'template-parts/builder/components/title', null, array( 'class' => '' ) ) ?>
	</div>
	<?php if ( have_rows( 'our_history' ) ) : ?>
		<div class="card-history">
			<?php while ( have_rows( 'our_history' ) ) : the_row(); ?>
				<?php
				$year         = get_sub_field( 'year' );
				$history_info = get_sub_field( 'history_info' );
				?>

				<div class="our-history">
					<?php if ( $year ) : ?>
						<p class="year"><?php echo esc_html( $year ) ?></p>
					<?php endif; ?>

					<?php if ( $history_info ) : ?>
						<div class="history-info"><?php echo wp_kses_post( $history_info ) ?></div>
					<?php endif; ?>

				</div>
			<?php endwhile; ?>
		</div>
	<?php endif; ?>
</section>

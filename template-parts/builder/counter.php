<?php
$title_section = get_sub_field( 'title_section' );
$paragraph     = get_sub_field( 'paragraph' );
$link_section  = get_sub_field( 'link_section' )
?>
<section class="counter section">
	<div class="container">
		<?php if ( $title_section ) : ?>
			<?php echo wp_kses_post( $title_section ) ?>
		<?php endif; ?>
		<div class="row">
			<div class="col-lg-10">
				<?php if ( $paragraph ) : ?>
					<div class="counter-paragraph">
						<?php echo wp_kses_post( $paragraph ) ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<div class="row">
			<?php if ( have_rows( 'counter_card' ) ) : ?>
				<?php while ( have_rows( 'counter_card' ) ) : the_row(); ?>
					<div class="col-lg-4">
						<div class="counter-card">
							<?php
							$label          = get_sub_field( 'label' );
							$number_card    = get_sub_field( 'number_card' );
							$paragraph_card = get_sub_field( 'paragraph_card' );
							$symbol_number  = get_sub_field( 'symbol_number' );
							?>

							<?php if ( $label ) : ?>
								<h6 class="counter-card__label"><?php echo esc_html( $label ) ?></h6>
							<?php endif; ?>
							<div class="number-wrapper">
								<?php if ( $number_card ) : ?>
									<p><?php echo( $number_card ) ?></p>
								<?php endif; ?>

								<?php if ( $symbol_number ) : ?>
									<?php echo esc_html( $symbol_number ) ?>
								<?php endif; ?>
							</div>
							<?php if ( $paragraph_card ) : ?>
								<p class="paragraph-card"><?php echo esc_html( $paragraph_card ) ?></p>
							<?php endif; ?>
						</div>
					</div>
				<?php endwhile; ?>
			<?php endif; ?>
		</div>
		<?php if ( $link_section ) :
			$link_section_target = $link_section['target'] ? $link_section['target'] : '_self'; ?>
		<div class="button-center">
			<a class="btn " target="<?php echo esc_attr( $link_section_target ); ?>"
			   href="<?php echo esc_url( $link_section['url'] ); ?>">
				<?php echo $link_section['title'] ?>
			</a>
		</div>

		<?php endif; ?>

	</div>
</section>

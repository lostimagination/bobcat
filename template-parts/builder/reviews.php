<?php
$title_section    = get_sub_field( 'title_section' );
$background_image = get_sub_field( 'background_image' );
?>

<section class="reviews">
	<div class="review-top">
		<?php if ( $background_image ) : ?>
			<div class="review-background">
				<?php echo wp_get_attachment_image( $background_image['id'], 'large', false, array( 'class' => 'flex-image' ) ); ?>
			</div>
		<?php endif; ?>
		<div class="container">
			<?php if ( $title_section ) : ?>
				<div class="text-white">
					<?php echo wp_kses_post( $title_section ) ?>
				</div>
			<?php endif; ?>

			<?php
			$args = array(
				'post_type'      => 'reviews',
				'order'          => 'ASC',
				'orderby'        => 'menu_order',
				'posts_per_page' => - 1,

			);
			?>

			<?php $the_query = new WP_Query( $args ); ?>

			<?php if ( $the_query->have_posts() ) : ?>
				<div class="review-slider-wrapper">
					<div class="swiper slide-reviews">
						<div class="swiper-wrapper">
							<!-- the loop -->
							<?php while ( $the_query->have_posts() ) :
								$the_query->the_post(); ?>

								<div class="swiper-slide">
									<?php
									$position = get_field( 'position' );
									$company  = get_field( 'company' );
									?>
									<div class="wrapper-review">
										<svg class="quotes-svg">
											<use xlink:href="#quotes"></use>
										</svg>
										<div class="personality-wrapper">
											<div class="personality-review"><?php the_content(); ?></div>
											<div class="personality-info">
												<p class="personality-name"><?php the_title(); ?></p>

												<?php if ( $position ) : ?>
													<p class="personality-position"><?php echo esc_html( $position ) ?></p>
												<?php endif; ?>

												<?php if ( $company ) : ?>
													<p class="personality-company"><?php echo esc_html( $company ) ?></p>
												<?php endif; ?>
											</div>
										</div>
									</div>
								</div>
							<?php endwhile; ?>
							<!-- end of the loop -->
							<?php wp_reset_postdata(); ?>
						</div>
					</div>
					<div class="swiper-button-next arrow-right">
						<svg>
							<use xlink:href="#slider-arrow-right"></use>
						</svg>
					</div>
					<div class="swiper-button-prev arrow-left">
						<svg>
							<use xlink:href="#slider-arrow-left"></use>
						</svg>
					</div>
					<div class="swiper-pagination"></div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>


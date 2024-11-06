<section class="jobs section">
	<div class="container">
		<?php if ( have_rows( 'job' ) ) : ?>
			<div class="jobs-slider-wrapper">
				<div class="swiper slider-jobs">
					<div class="swiper-wrapper">
						<?php while ( have_rows( 'job' ) ) :
							the_row(); ?>
							<?php
							$paragraph     = get_sub_field( 'paragraph' );
							$link_section  = get_sub_field( 'link_section' );
							$image_section = get_sub_field( 'image_section' );
							?>
							<div class="swiper-slide">
								<div class="job">
									<div class="row">
										<div class="col-lg-4">
											<div class="job-info">
												<?php get_template_part( 'template-parts/builder/components/title' ) ?>

												<?php if ( $paragraph ) : ?>
													<div class="job-paragraph">
														<?php echo $paragraph ?>
													</div>
												<?php endif; ?>

												<?php if ( $link_section ) :
													$link_section_target = $link_section['target'] ? $link_section['target'] : '_self'; ?>
													<a class="btn btn-small"
													   target="<?php echo esc_attr( $link_section_target ); ?>"
													   href="<?php echo esc_url( $link_section['url'] ); ?>">
														<?php echo $link_section['title'] ?>
													</a>
												<?php endif; ?>
											</div>
										</div>
										<div class="col-lg-8">
											<?php if ( $image_section ) : ?>
												<div class="job-image">
													<?php echo wp_get_attachment_image( $image_section['id'], 'medium', false, array( 'class' => 'flex-image' ) ); ?>
												</div>
											<?php endif; ?>
										</div>
									</div>
								</div>
							</div>
						<?php endwhile; ?>
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

			</div>
		<?php endif; ?>
	</div>
</section>

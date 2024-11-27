<?php
$title_section = get_sub_field( 'title_section' );
$link_section  = get_sub_field( 'link_section' );
?>
<section class="mews section">
	<div class="container">
		<div class="row">
			<div class="col-lg-4">
				<?php if ( $title_section ) : ?>
					<div class="news-title-section">
						<?php echo wp_kses_post( $title_section ) ?>
					</div>
				<?php endif; ?>
			</div>

			<?php
			$news_category = get_sub_field( 'news_category' );
			$posts_amount  = get_sub_field( 'posts_amount' );
			$args          = array(
				'post_type'      => 'post',
				'order'          => 'DESC',
				'orderby'        => 'date',
				'posts_per_page' => $posts_amount ?? 5,
			);
			if ( $news_category ) {
				$args['category__in'] = $news_category;
			}
			?>

			<?php $the_query = new WP_Query( $args ); ?>

			<?php if ( $the_query->have_posts() ) : ?>

				<!-- the loop -->
				<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					<div class="col-lg-4 visible-md-up">
						<div class="news-info">
							<div class="news-image">
								<?php the_post_thumbnail( 'full', array( 'class' => 'flex-image' ) ); ?>
							</div>
							<div class="wrapper-title-link">
								<h5 class="news-title"><?php the_title(); ?></h5>
								<a class="news-link" href="<?php the_permalink(); ?>">
									<?php esc_html_e( 'weiterlesen', 'bobcat' ); ?>
								</a>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
                <div class="mobile-news-slider hidden-lg-up">
                    <div class="swiper slider-news">
                        <div class="swiper-wrapper">
							<?php
							$the_query->rewind_posts();
							while ( $the_query->have_posts() ) : $the_query->the_post();
								?>
                                <div class="swiper-slide">
                                    <div class="news-info">
                                        <div class="news-image">
											<?php the_post_thumbnail( 'full', array( 'class' => 'flex-image' ) ); ?>
                                        </div>
                                        <div class="wrapper-title-link">
                                            <h5 class="news-title"><?php the_title(); ?></h5>
                                            <a class="news-link" href="<?php the_permalink(); ?>">
												<?php esc_html_e( 'weiterlesen', 'bobcat' ); ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
							<?php endwhile; ?>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
				<!-- end of the loop -->
				<?php wp_reset_postdata(); ?>

			<?php endif; ?>

		</div>

		<?php if ( $link_section ) :
			$link_section_target = $link_section['target'] ? $link_section['target'] : '_self'; ?>
			<div class="button-center">
				<a class="btn" target="<?php echo esc_attr( $link_section_target ); ?>"
				   href="<?php echo esc_url( $link_section['url'] ); ?>">
					<?php echo $link_section['title'] ?>
				</a>
			</div>
		<?php endif; ?>
		<?php echo get_post_type_archive_link( 'reviews' ) ?>
	</div>
</section>

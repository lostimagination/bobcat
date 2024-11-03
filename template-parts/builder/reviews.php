<?php
$title_section    = get_sub_field( 'title_section' );
$paragraph        = get_sub_field( 'paragraph' );
$background_image = get_sub_field( 'background_image' );
?>

<section class="reviews">
	<?php if ( $background_image ) : ?>
	<div class="review-background">
		<?php echo wp_get_attachment_image( $background_image['id'], 'large', false, array( 'class' => 'flex-image' ) ); ?>
	</div>
	<?php endif; ?>
	<div class="container">
		<?php if ( $title_section ) : ?>
			<div><?php echo wp_kses_post( $title_section ) ?></div>
		<?php endif; ?>
		<div class="row">
			<?php
			$args = array(
				'post_type'      => 'reviews',
				'order'          => 'ASC',
				// ASC, DESC
				'orderby'        => 'menu_order',
				// none, ID, author, title, name, date, modified, parent, rand, comment_count, menu_order, meta_value, meta_value_num, title menu_order, post__in
				'posts_per_page' => - 1,

			);
			?>

			<?php $the_query = new WP_Query( $args ); ?>

			<?php if ( $the_query->have_posts() ) : ?>

				<!-- the loop -->
				<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					<div class="col-lg-4">
						<?php
						$position = get_field( 'position' );
						$company  = get_field( 'company' );
						?>
						<div class="wrapper-review">
							<svg class="quotes-svg">
								<use xlink:href="#quotes"></use>
							</svg>

							<div class="personality-review"><?php the_content(); ?></div>
							<div class="personality-info">
								<p class="personality-name"><?php the_title(); ?></p>

								<?php if ( $position ) : ?>
									<p><?php echo $position ?></p>
								<?php endif; ?>

								<?php if ( $company ) : ?>
									<p><?php echo $company ?></p>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
				<!-- end of the loop -->
				<?php wp_reset_postdata(); ?>
			<?php endif; ?>
		</div>

	</div>

	<?php if ( $paragraph ) : ?>
		<div><?php echo wp_kses_post( $paragraph ) ?></div>
	<?php endif; ?>

</section>

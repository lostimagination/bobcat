<?php
/**
 * Blog page
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bobcat
 */

// Enable strict typing mode.
declare( strict_types = 1 );

get_header();
?>

	<div class="archive-wrapper">
		<div class="container">
			<?php get_template_part( 'template-parts/breadcrumbs' ); ?>
			<?php if ( have_posts() ) : ?>

				<div class="row">
					<?php
					while ( have_posts() ) :
						the_post();
						?>

						<div class="col-md-6 col-lg-4">
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
				<?php get_template_part( 'template-parts/pagination' ); ?>

			<?php else : ?>

				<div class="row">
					<div class="col-lg-6">
						<?php get_template_part( 'template-parts/content-none' ); ?>
					</div>
				</div>

			<?php endif; ?>

		</div>
	</div>

<?php
get_footer();

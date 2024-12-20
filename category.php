<?php
/**
 * Category archive template
 *
 * @package bobcat
 */

// Enable strict typing mode.
declare( strict_types=1 );

get_header();

$blog_page_id     = get_option( 'page_for_posts' );
$top_info         = get_field( 'top_content', $blog_page_id );
$current_category = get_queried_object();
?>

    <div class="breadcrumbs-section container"><?php get_template_part( 'template-parts/breadcrumbs' ); ?></div>

    <section class="default-content section pb-0">
        <div class="container">
			<?php if ( $current_category->description ) : ?>
                <div class="category-description mb-2">
					<?php echo wp_kses_post( $current_category->description ); ?>
                </div>
			<?php else : ?>
				<?php echo wp_kses_post( $top_info ); ?>
			<?php endif; ?>

			<?php
			$categories = get_categories( array(
				'hide_empty' => true,
				'orderby'    => 'name',
				'order'      => 'ASC'
			) );

			$current_cat_id = get_queried_object_id();

			if ( $categories ) : ?>
                <div class="anchor-list mb-1">
                    <a href="<?php echo get_the_permalink( get_option( 'page_for_posts' ) ); ?>"
                       class="anchor-list__item h5">
						<?php echo esc_html_e( 'Alle', 'bobcat' ); ?>
                    </a>
					<?php foreach ( $categories as $category ) :
						$active_class = ( $current_cat_id === $category->term_id ) ? ' active' : '';
						?>
                        <a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>"
                           class="anchor-list__item h5<?php echo $active_class; ?>"
                           data-posts-count="<?php echo $category->count; ?>">
							<?php echo esc_html( $category->name ); ?>
                        </a>
					<?php endforeach; ?>
                </div>
			<?php endif; ?>
        </div>
    </section>

    <div class="archive-wrapper pt-0">
        <div class="container">
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

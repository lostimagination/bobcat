<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package bobcat
 */

// Enable strict typing mode.
declare( strict_types=1 );

get_header();
the_post();
?>


    <div class="container">
		<?php get_template_part( 'template-parts/breadcrumbs' ); ?>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="h2"><?php the_title(); ?></h1>

                <div class="single-post-excerpt">
					<?php the_excerpt(); ?>
                </div>
            </div>
        </div>
		<?php if ( has_post_thumbnail() ) : ?>
            <div class="post-thumbnail">
				<?php the_post_thumbnail( ); ?>
            </div>
		<?php endif; ?>

        <div class="row justify-content-center">
            <div class="col-lg-8">
				<?php echo do_shortcode( '[lwptoc]' ); ?>

                <div class="entry-content">
					<?php
					the_content();
					?>

                    <div class="post-social-sharing">
                        <h5><?php echo esc_html_e('Teilen :' , 'bobcat'); ?></h5>
		                <?php echo it_get_social_share_buttons(); ?>
                    </div>
                </div>
            </div>
        </div>

		<?php get_template_part( 'template-parts/post-related' ); ?>
    </div>

<?php
get_footer();

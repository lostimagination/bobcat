<?php
/**
 * Article template.
 *
 * @package bobcat
 * @subpackage template-parts
 */

// Enable strict typing mode.
declare( strict_types = 1 );

?>

<article class="article">
	<a class="article__thumbnail" href="<?php the_permalink(); ?>">
		<?php
		if ( has_post_thumbnail() ) {
			the_post_thumbnail( 'large', array( 'class' => 'img-cover' ) );
		} else {
			it_image_placeholder();
		}
		?>
	</a>
	<div class="article__content">
		<div class="entry-meta">
			<?php it_posted_on(); ?>
			<?php it_posted_by(); ?>
			<?php it_cat_links(); ?>
			<?php it_tag_links(); ?>
		</div>
		<h3 class="article__title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h3>
		<div class="article__excerpt"><?php it_excerpt( 15 ); ?></div>
		<a class="btn btn-primary article__more" href="<?php the_permalink(); ?>">
			<?php esc_html_e( 'Read more', 'bobcat' ); ?>
		</a>
	</div>
</article>

<div class="container">
	<?php if ( have_rows( 'anchors_list' ) ) : ?>
        <div class="anchor-list anchor-list--single">
			<?php while ( have_rows( 'anchors_list' ) ) : the_row();
				$anchor_name = get_sub_field( 'anchor_name' );
				$anchor_slug = get_sub_field( 'anchor_slug' );
				?>

                <a href="#<?php echo esc_url( $anchor_slug ); ?>" class="anchor-list__item h5">
					<?php echo esc_html( $anchor_name ); ?>
                </a>

			<?php endwhile; ?>
        </div>
	<?php endif; ?>
</div>


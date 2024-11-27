<?php
$title           = get_sub_field( 'title' );
$info            = get_sub_field( 'info' );
$link            = get_sub_field( 'link' );
$mech_categories = get_sub_field( 'mech_categories' );
?>
<section class="section mech-category-section">
    <div class="container">
        <div class="section-top-separator"></div>
        <div class="row">
            <div class="col-lg-10">
				<?php if ( $title ) : ?>
                    <div class="section-title">
						<?php echo wp_kses_post( $title ); ?>
                    </div>
				<?php endif; ?>
				<?php
				$info = get_sub_field( 'info' );
				if ( $info ) :
					?>
                    <article class="editor">
						<?php echo wp_kses_post( $info ); ?>
                    </article>
				<?php endif; ?>
            </div>
        </div>
		<?php if ( $mech_categories ) : ?>
            <div class="row mech-categories-list">
				<?php foreach ( $mech_categories as $category ): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="mech-category-card">

							<?php if ( $mech_image = get_field( 'mech_image', $category ) ) : ?>
                                <div class="mech-category-card__image">
									<?php echo wp_get_attachment_image( $mech_image['id'], 'large', false, array( 'class' => 'flex-image' ) ); ?>
                                </div>
							<?php endif; ?>

                            <div class="mech-category-card__title">
								<?php echo $category->name; ?>
                                <div class="mech-category-card__icon">
                                    <svg>
                                        <use xlink:href="#slider-arrow-right"></use>
                                    </svg>
                                </div>
                            </div>

                            <a href="<?php echo esc_url( get_term_link( $category, '' ) ); ?>" class="flex-link"></a>
                        </div>
                    </div>
				<?php endforeach; ?>
            </div>
		<?php endif; ?>
		<?php
		if ( $link ) :
			$link_target = $link['target'] ? $link['target'] : '_self';
			?>
            <div class="text-center mech-categories-button">
                <a
                        class="btn"
                        target="<?php echo esc_attr( $link_target ); ?>"
                        href="<?php echo esc_url( is_array( $link ) ? $link['url'] : null ); ?>">
					<?php echo esc_html( $link['title'] ); ?>
                </a>
            </div>
		<?php endif; ?>
    </div>
</section>

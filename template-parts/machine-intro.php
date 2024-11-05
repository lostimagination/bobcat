<?php
$main_link      = get_sub_field( 'main_link' );
$secondary_link = get_sub_field( 'secondary_link' );
$gallery        = get_sub_field( 'gallery' )
?>
<section class="machine-intro">
    <div class="container">
        <div class="col-lg-6">
            <h1 class="h2">
				<?php the_title(); ?>
            </h1>
            <article class="machine-intro__content">
				<?php the_content(); ?>
            </article>
			<?php if ( have_rows( 'specification' ) ) : ?>
                <ul class="machine-specs">
					<?php while ( have_rows( 'specification' ) ) : the_row();
						$icon           = get_sub_field( 'icon' );
						$characteristic = get_sub_field( 'characteristic' );
						?>

                        <li class="machine-specs-item">
							<?php if ( $icon ) : ?>
                                <div class="machine-specs-item__icon">
									<?php echo it_inline_svg( $icon['url'] ); ?>
                                </div>
							<?php endif; ?>
							<?php if ( $characteristic ) : ?>
                                <span><?php echo esc_html( $characteristic ); ?></span>
							<?php endif; ?>
                        </li>

					<?php endwhile; ?>
                </ul>
			<?php endif; ?>
			<?php if ( $main_link || $secondary_link ) : ?>
                <div class="btn-group">
					<?php
					if ( $main_link ) :
						$main_link_target = $main_link['target'] ? $main_link['target'] : '_self';
						?>
                        <a
                                class="btn btn-small"
                                target="<?php echo esc_attr( $main_link_target ); ?>"
                                href="<?php echo esc_url( is_array( $main_link ) ? $main_link['url'] : null ); ?>">
							<?php echo esc_html( $main_link['title'] ); ?>
                        </a>
					<?php endif; ?>
					<?php
					if ( $secondary_link ) :
						$secondary_link_target = $secondary_link['target'] ? $secondary_link['target'] : '_self';
						?>
                        <a
                                class="btn btn-outline"
                                target="<?php echo esc_attr( $secondary_link_target ); ?>"
                                href="<?php echo esc_url( is_array( $secondary_link ) ? $secondary_link['url'] : null ); ?>">
							<?php echo esc_html( $secondary_link['title'] ); ?>
                        </a>
					<?php endif; ?>
                </div>
			<?php endif; ?>
        </div>
        <div class="col-lg-6">
			<?php if ( has_post_thumbnail() ) : ?>
                <div class="machine-post-image">
					<?php the_post_thumbnail( 'large', array( 'class' => 'flex-image' ) ); ?>
                </div>
			<?php endif; ?>

			<?php if ( $gallery ): ?>
                <div class="machine-gallery">
					<?php foreach ( $gallery as $image ): ?>

                        <div class="col-4">
							<?php echo it_inline_svg( $image['url'] ); ?>
                        </div>

					<?php endforeach; ?>
                </div>
			<?php endif; ?>
        </div>
    </div>
</section>

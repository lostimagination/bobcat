<?php
/**
 * Global images component.
 *
 * @package bobcat
 * @subpackage template-parts/builder/components
 */

// Enable strict typing mode.
declare( strict_types = 1 );

$field_group = $args['field_group'] ?? 'images';
$image_ids   = get_sub_field( $field_group );
?>

<?php if ( is_array( $image_ids ) ) : ?>

	<?php if ( count( $image_ids ) > 1 ) : ?>

		<div class="swiper swiper-images">
			<div class="swiper-wrapper">
				<?php foreach ( $image_ids as $image_id ) : ?>
					<div class="swiper-slide">
						<div class="c-image">
							<?php echo wp_get_attachment_image( $image_id, 'large', false, array( 'class' => 'img-cover' ) ); ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
			<div class="swiper-pagination"></div>
			<div class="swiper-button-prev">
				<svg>
					<use xlink:href="#angle-left"></use>
				</svg>
			</div>
			<div class="swiper-button-next">
				<svg>
					<use xlink:href="#angle-right"></use>
				</svg>
			</div>
		</div>

	<?php elseif ( count( $image_ids ) === 1 ) : ?>

		<div class="c-image">
			<?php echo wp_get_attachment_image( $image_ids[0], 'large' ); ?>
		</div>

	<?php endif; ?>

<?php endif; ?>

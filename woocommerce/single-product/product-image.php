<?php
/**
 * Single Product Image
 *
 * @package WooCommerce\Templates
 * @version 9.0.0
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;

$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters(
	'woocommerce_single_product_image_gallery_classes',
	array(
		'woocommerce-product-gallery',
		'woocommerce-product-gallery--' . ( $post_thumbnail_id ? 'with-images' : 'without-images' ),
		'product__images',
	)
);
$attachment_ids    = $product->get_gallery_image_ids();

if ( $attachment_ids || $product->get_image_id() ) : ?>

	<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>">
		<div class="swiper swiper-product-image" data-columns="<?php echo esc_attr( $columns ); ?>">
			<div class="swiper-wrapper">
				<?php if ( $post_thumbnail_id ) : ?>
					<div class="swiper-slide" data-image-id="<?php echo $post_thumbnail_id; ?>">
						<a class="c-image" data-fancybox="gallery" href="<?php echo wp_get_attachment_url( $post_thumbnail_id ); ?>">
							<?php echo wp_get_attachment_image( $post_thumbnail_id, 'large', false, [ 'class' => 'img-cover' ] ); ?>
						</a>
					</div>
				<?php endif; ?>
				<?php foreach ( $attachment_ids as $attachment_id ) : ?>
					<div class="swiper-slide" data-image-id="<?php echo $attachment_id; ?>">
						<a class="c-image" data-fancybox="gallery" href="<?php echo wp_get_attachment_url( $attachment_id ); ?>">
							<?php echo wp_get_attachment_image( $attachment_id, 'large', false, [ 'class' => 'img-cover' ] ); ?>
						</a>
					</div>
				<?php endforeach; ?>
			</div>
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

		<div class="swiper swiper-product-thumbs">
			<div class="swiper-wrapper">
				<?php if ( $post_thumbnail_id ) : ?>
					<div class="swiper-slide">
						<figure class="c-image">
							<?php echo wp_get_attachment_image( $post_thumbnail_id, 'medium_large', false, [ 'class' => 'img-cover' ] ); ?>
						</figure>
					</div>
				<?php endif; ?>
				<?php foreach ( $attachment_ids as $attachment_id ) : ?>
					<div class="swiper-slide">
						<figure class="c-image">
							<?php echo wp_get_attachment_image( $attachment_id, 'medium_large', false, [ 'class' => 'img-cover' ] ); ?>
						</figure>
					</div>
				<?php endforeach; ?>
			</div>
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
	</div>

<?php else : ?>

	<?php
	$wrapper_classname = $product->is_type( 'variable' ) && ! empty( $product->get_available_variations( 'image' ) ) ?
		'woocommerce-product-gallery__image woocommerce-product-gallery__image--placeholder' :
		'woocommerce-product-gallery__image--placeholder';
	$html              = sprintf( '<div class="%s">', esc_attr( $wrapper_classname ) );
	$html             .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
	$html             .= '</div>';

	echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id ); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped
	?>

<?php endif; ?>

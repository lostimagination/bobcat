<?php
/**
 * Global video component.
 *
 * @package bobcat
 * @subpackage template-parts/builder/components
 */

// Enable strict typing mode.
declare( strict_types = 1 );

$field_group = $args['field_group'] ?? 'video';
$video_group = isset( get_sub_field( $field_group )['video_group'] ) ? get_sub_field( $field_group )['video_group'] : false;
?>

<?php if ( $video_group ) : ?>

	<?php
		$file_type = $video_group['type']; // Possible values: embed, file.
		$file      = $video_group['file'];
		$poster    = $video_group['poster'];
		$embed     = $video_group['embed'];
	?>

	<?php if ( 'embed' === $file_type && $embed ) : ?>

		<?php echo $embed; // phpcs:ignore ?>

	<?php elseif ( 'file' === $file_type && $file ) : ?>

		<?php if ( $poster ) : ?>
			<a class="c-video" data-fancybox="video" href="<?php echo esc_url( $file ); ?>">
				<span class="c-video__poster">
					<?php echo wp_get_attachment_image( $poster, 'large', false, array( 'class' => 'img-cover' ) ); ?>
					<svg><use xlink:href="#play-circle"></use></svg>
				</span> </a>
		<?php else : ?>
			<video class="c-video" src="<?php echo esc_url( $file ); ?>" controls></video>
		<?php endif; ?>

	<?php endif; ?>

<?php endif; ?>

<?php
$paragraph   = get_sub_field( 'paragraph' );
$intro_link  = get_sub_field( 'intro_link' );
$intro_image = get_sub_field( 'intro_image' );
?>
<section class="intro">
	<div class="container container-large">
		<div class="row">
			<div class="col-lg-5">
				<div class="info-wrapper">
					<?php get_template_part( 'template-parts/builder/components/title', null, array( 'class' => 'title-white' ) ) ?>

					<?php if ( $paragraph ) : ?>
						<div class="intro-paragraph">
							<?php echo wp_kses_post( $paragraph ) ?>
						</div>
					<?php endif; ?>

					<?php if ( $intro_link ) :
						$intro_link_target = $intro_link['target'] ? $intro_link['target'] : '_self'; ?>
						<a class="btn btn-secondary" target="<?php echo esc_attr( $intro_link_target ); ?>"
						   href="<?php echo esc_url( $intro_link['url'] ); ?>">
							<?php echo $intro_link['title'] ?></a>
					<?php endif; ?>
				</div>
			</div>
			<div class="col-lg-7">
				<?php if ( $intro_image ) : ?>
				<div class="intro-image-wrapper">
					<?php echo wp_get_attachment_image( $intro_image['id'], 'large', false, array( 'class' => 'intro-image' ) ); ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>

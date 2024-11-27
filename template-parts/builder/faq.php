<?php
/**
 * FAQ module.
 *
 * @package bobcat
 * @subpackage template-parts/builder
 */

// Enable strict typing mode.
declare( strict_types=1 );

?>
<?php
$paragraph = get_sub_field( 'paragraph' );
?>
<section class="m-faq">
	<div class="container">
		<?php get_template_part( 'template-parts/builder/components/title', null, array( 'class' => '' ) ) ?>

		<div class="row">
			<div class="border-paragraph">
				<div class="col-lg-10">
					<?php if ( $paragraph ) : ?>
						<p class="faq-paragraph"><?php echo esc_html($paragraph)  ?></p>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<?php if ( have_rows( 'list' ) ) : ?>
			<div class="js-accordion">
				<?php
				$faq = array();

				while ( have_rows( 'list' ) ) : the_row();

					$question = get_sub_field( 'question' );
					$answer   = get_sub_field( 'answer' );

					$faq[] = array(
						'@type'          => 'Question',
						'name'           => wp_strip_all_tags( $question ),
						'acceptedAnswer' => array(
							'@type' => 'Answer',
							'text'  => wp_strip_all_tags( $answer ),
						),
					)
					?>
					<div class="js-accordion-item m-faq__item">
						<div class="h5 js-accordion-title m-faq__item-title">
							<span><?php echo esc_html( $question ); ?></span>
							<svg class="faq-plus" width="40" height="40">
								<use xlink:href="#plus"></use>
							</svg>
							<svg class="faq-minus" width="40" height="40">
								<use xlink:href="#minus"></use>
							</svg>
						</div>
						<div class="js-accordion-content m-faq__item-content">
							<div class="editor"><?php echo wp_kses_post( $answer ); ?></div>
						</div>
					</div>
				<?php endwhile; ?>

				<script type="application/ld+json">
					{
						"@context": "https://schema.org",
						"@type": "FAQPage",
						"mainEntity": <?php echo wp_json_encode( $faq ); ?>
					}



				</script>
			</div>
		<?php endif; ?>
	</div>
</section>



<section class="section section-downloads section-border-top">
	<div class="container">
		<?php
		$section_title = get_sub_field('section_title');
		if ($section_title) : ?>
			<h2 class="section-downloads__title">
				<?php echo esc_html($section_title); ?>
			</h2>
		<?php endif; ?>

		<?php if (have_rows('download_items')) : ?>
			<div class="downloads-list">
				<?php while (have_rows('download_items')) : the_row();
					$title = get_sub_field('title');
					$file = get_sub_field('file');

					if ($file) {
						$file_extension = pathinfo($file['filename'], PATHINFO_EXTENSION);
						$file_size = size_format($file['filesize']);
					}
					?>
					<div class="downloads-list__item">
						<div class="downloads-list__content">
							<?php if ($title) : ?>
								<h3 class="downloads-list__title">
									<?php echo esc_html($title); ?>
								</h3>
							<?php endif; ?>
							<?php if ($file) : ?>
								<div class="downloads-list__info">
									<?php esc_html_e('Fornat' , 'bobcat') ?> .<?php echo esc_html($file_extension); ?> <?php echo esc_html($file_size); ?>
								</div>
							<?php endif; ?>
						</div>
						<?php if ($file) : ?>
							<a href="<?php echo esc_url($file['url']); ?>"
							   class="downloads-list__link"
							   download>
								<svg width="24" height="24">
									<use xlink:href="#download"></use>
								</svg>
							</a>
						<?php endif; ?>
					</div>
				<?php endwhile; ?>
			</div>
		<?php endif; ?>
	</div>
</section>

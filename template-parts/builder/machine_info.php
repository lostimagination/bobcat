<?php
$info = get_sub_field('info');
$links_label = get_sub_field('links_label')
?>
<section class="machine-info">
    <div class="container">
        <div class="row">
            <div class="col-lg-10">
	            <?php get_template_part( 'template-parts/builder/components/title', null, array( 'class' => '' ) ) ?>

                <?php echo wp_kses_post($info)?>
            </div>
        </div>

        <?php if (have_rows('anchor_links')) : ?>
        <div class="anchor-list">
            <?php if($links_label) : ?>
             <span class="anchor-list__label"><?php echo esc_html($links_label); ?></span>
            <?php endif; ?>
        	 <?php while (have_rows('anchor_links')) : the_row();
        	    $anchor_name = get_sub_field('anchor_name');
        	    $anchor_slug = get_sub_field('anchor_slug');
        	  ?>

             <a href="#<?php echo esc_url($anchor_slug); ?>" class="anchor-list__item h5">
                 <?php echo esc_html($anchor_name); ?>
             </a>

        	 <?php endwhile; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

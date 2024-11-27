<?php
$locations       = get_field( 'locations_list', 'options' );
$locations_count = count( $locations );
?>
<div class="locations-dropdown">
    <a href="#" class="locations-dropdown__toggle">
        <span class="location-icon">
           <svg>
               <use xlink:href="#location-pin"></use>
           </svg>
        </span>
		<?php echo $locations_count; ?> <?php esc_html_e( 'Niederlassungen', 'bobcat' ); ?>
        <span class="dropdown-arrow">
           <svg>
               <use xlink:href="#arrow-down-loc"></use>
           </svg>
        </span>
    </a>

	<?php if ( $locations ) : ?>
        <div class="locations-dropdown__menu">
			<?php foreach ( $locations as $location ) :
				$location_title = get_the_title( $location );
				$location_url = get_permalink( $location );
				?>
                <a href="<?php echo esc_url( $location_url ); ?>" class="locations-dropdown__item">
                    <span class="location-marker"></span>
                    <span class="location-name"><?php esc_html_e( 'Niederlassungen', 'bobcat' ); ?> <?php echo esc_html( $location_title ); ?></span>
                </a>
			<?php endforeach; ?>
        </div>
	<?php endif; ?>
</div>

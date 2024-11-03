<?php
/**
 * The template for displaying search forms
 *
 * @package bobcat
 */

// Enable strict typing mode.
declare( strict_types = 1 );
?>

<form class="search-form" id="searchform" role="search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input class="search-form__input" id="s" name="s" type="text" placeholder="<?php esc_html_e( 'Search', 'bobcat' ); ?>" required />
	<button class="search-form__submit" type="submit">
		<svg>
			<use xlink:href="#search"></use>
		</svg>
	</button>
</form>

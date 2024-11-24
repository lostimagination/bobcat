<?php
/**
 * Functions which will be called on after_setup_theme
 *
 * @link https://developer.wordpress.org/reference/hooks/after_setup_theme/
 *
 * @package bobcat
 * @subpackage inc/
 */

// Enable strict typing mode.
declare( strict_types=1 );

if ( ! function_exists( 'it_setup' ) ) {

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function it_setup(): void {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on IT Starter, use a find and replace
		 * to change 'bobcat' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'bobcat', get_template_directory() . '/languages' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * Example of registering a new image presets
		 *
		 * @link https://developer.wordpress.org/reference/functions/add_image_size/
		 */
		// add_image_size( 'full-hd', 1920, 1080, true );

		/**
		 * This theme uses wp_nav_menu() in one location.
		 *
		 * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
		 */
		register_nav_menus(
			array(
				'main'   => esc_html__( 'Main Nav', 'bobcat' ),
				'footer' => esc_html__( 'Footer Nav', 'bobcat' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );
	}

	add_action( 'after_setup_theme', 'it_setup' );

}

if ( ! function_exists( 'it_set_content_width' ) ) {

	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @return void
	 * @global int $content_width
	 */
	function it_set_content_width(): void {
		$GLOBALS['content_width'] = apply_filters( 'it_content_width', 1130 );
	}

	add_action( 'after_setup_theme', 'it_set_content_width', 0 );

}

if ( ! function_exists( 'it_slug_body_class' ) ) {

	/**
	 * Adds the page slug to the <body> class.
	 *
	 * @link https://developer.wordpress.org/reference/functions/body_class/
	 *
	 * @param string[] $classes An array of body classes.
	 *
	 * @return string[] The modified array of body classes.
	 */
	function it_slug_body_class( array $classes ): array {
		global $post;

		if ( isset( $post ) ) {
			$classes[] = $post->post_type . '-' . $post->post_name;
		}

		return $classes;
	}

	add_filter( 'body_class', 'it_slug_body_class' );

}

if ( ! function_exists( 'it_archive_prefix' ) ) {

	/**
	 * Remove archive title prefix.
	 *
	 * @return string An empty string.
	 */
	function it_archive_prefix(): string {
		return '';
	}

	add_filter( 'get_the_archive_title_prefix', 'it_archive_prefix' );

}

/**
 * Limit post excerpt length
 */
add_filter( 'excerpt_length', fn() => 20 );

/**
 * This will add a filter on `excerpt_more` that returns an empty string.
 */
add_filter( 'excerpt_more', '__return_empty_string' );

add_filter( 'wpseo_breadcrumb_separator', 'custom_breadcrumb_separator' );
function custom_breadcrumb_separator( $separator ): string {
	$svg_icon = '<svg width="5" height="7" viewBox="0 0 5 7" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M0.719504 6.5105H1.54217C1.64434 6.5105 1.7425 6.46984 1.81467 6.3975L4.43967 3.7725C4.59017 3.622 4.59017 3.378 4.43967 3.2275L1.81467 0.602498C1.7425 0.530165 1.64434 0.489498 1.54217 0.489665C1.379 0.489665 1.02434 0.489669 0.719504 0.489502C0.563504 0.489502 0.423004 0.583498 0.363338 0.727498C0.303671 0.871498 0.336671 1.03733 0.446838 1.1475L2.7625 3.46317C2.78284 3.4835 2.78284 3.5165 2.7625 3.53683L0.446838 5.8525C0.336671 5.96267 0.303671 6.1285 0.363338 6.2725C0.423004 6.4165 0.563504 6.5105 0.719504 6.5105Z" fill="black"/>
</svg>';

	return $svg_icon;
}

remove_action( 'wpcf7_init', 'wpcf7_add_form_tag_submit' );
add_action( 'wpcf7_init', 'bobcat_add_form_tag_submit', 10, 0 );

function bobcat_add_form_tag_submit() {
	wpcf7_add_form_tag( 'submit', 'bobcat_submit_form_tag_handler' );
}

function bobcat_submit_form_tag_handler( $tag ): string {
	return '<button class="btn btn-form" type="submit">	<svg width="20" height="17" viewBox="0 0 20 17" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M19.7375 0.115907C19.5459 -0.0199262 19.2942 -0.0382595 19.0859 0.0709072L0.33587 9.86257C0.114204 9.97841 -0.0166296 10.2151 0.00170373 10.4642C0.0208704 10.7142 0.186704 10.9276 0.422537 11.0084L5.63504 12.7901L16.7359 3.29841L8.14587 13.6476L16.8817 16.6334C16.9467 16.6551 17.015 16.6667 17.0834 16.6667C17.1967 16.6667 17.3092 16.6359 17.4084 16.5759C17.5667 16.4792 17.6742 16.3167 17.7017 16.1342L19.9934 0.717574C20.0275 0.484241 19.9292 0.252574 19.7375 0.115907Z" fill="white"/>
</svg>

</button>';
}

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
declare( strict_types = 1 );

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
	 * @global int $content_width
	 * @return void
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
	 * @param  string[] $classes An array of body classes.
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

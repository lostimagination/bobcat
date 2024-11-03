<?php
/**
 * Disable gutenberg stuff
 *
 * @package bobcat
 * @subpackage inc/disables/
 */

// Enable strict typing mode.
declare( strict_types = 1 );

if ( ! function_exists( 'it_remove_block_css' ) ) {

	/**
	 * Disable Gutenberg block styles
	 *
	 * @return void
	 */
	function it_remove_block_css(): void {
		wp_dequeue_style( 'wp-block-library' );
	}

	add_action( 'wp_enqueue_scripts', 'it_remove_block_css', 100 );

}

if ( ! function_exists( 'it_remove_block_css' ) ) {

	/**
	 * Remove default gutenberg actions.
	 *
	 * @return void
	 */
	function custom_wp_remove_global_css(): void {
		remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
		remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );
	}

	add_action( 'init', 'custom_wp_remove_global_css' );

}

// Disable gutenberg editor for posts.
add_filter( 'use_block_editor_for_post', '__return_false', 10 );

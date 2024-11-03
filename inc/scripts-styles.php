<?php
/**
 * Include scripts and styles into theme
 *
 * @link https://developer.wordpress.org/reference/functions/wp_register_style/
 * @link https://developer.wordpress.org/reference/functions/wp_register_script/
 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_style/
 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_script/
 * @link https://developer.wordpress.org/reference/functions/wp_dequeue_style/
 * @link https://developer.wordpress.org/reference/functions/wp_dequeue_script/
 *
 * @package bobcat
 * @subpackage inc/
 */

// Enable strict typing mode.
declare( strict_types = 1 );

if ( ! function_exists( 'it_public_assets' ) ) {

	/**
	 * Enqueue global scripts and styles.
	 *
	 * @return void
	 */
	function it_public_assets(): void {

		// TODO: Create 'release' documentation and describe setting environment type there.
		$version = 'production' !== WP_ENVIRONMENT_TYPE ? strval( time() ) : IT_VERSION;

		// Global styles.
		wp_enqueue_style( 'theme-styles', IT_CSS . 'main.css', array(), $version );

		// Global JavaScript.
		wp_enqueue_script( 'theme-js', IT_JS . 'public.min.js', array( 'jquery' ), $version, true );

		wp_localize_script(
			'theme-js',
			'wpApiSettings',
			array(
				'ajaxUrl' => admin_url( 'admin-ajax.php' ),
				'nonce'   => wp_create_nonce( 'ajax-nonce' ),
			)
		);

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		if ( class_exists( 'WooCommerce' ) ) {
			wp_enqueue_script( 'theme-woocommerce-js', IT_JS . 'woocommerce.min.js', array( 'jquery' ), $version, true );
		}
	}

	add_action( 'wp_enqueue_scripts', 'it_public_assets' );

}

if ( ! function_exists( 'it_admin_assets' ) ) {

	/**
	 * Enqueue admin scripts and styles.
	 *
	 * @return void
	 */
	function it_admin_assets(): void {
		wp_enqueue_style( 'admin-styles', IT_CSS . 'admin-styles.css' ); // phpcs:ignore
		wp_enqueue_script( 'admin-js', IT_JS . 'admin.min.js' ); // phpcs:ignore

		wp_localize_script(
			'admin-js',
			'wpAdminSettings',
			array(
				// WP already has global variable 'ajaxurl' for backend.
				'nonce' => wp_create_nonce( 'ajax-admin-nonce' ),
			)
		);
	}

	// Enqueue admin scripts.
	add_action( 'admin_enqueue_scripts', 'it_admin_assets', 99 );

}

<?php
/**
 * ACF Options page
 *
 * @link https://www.advancedcustomfields.com/resources/options-page/
 * @package bobcat
 * @subpackage inc/
 */

// Enable strict typing mode.
declare( strict_types = 1 );

if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page( 'Theme Settings' );
}

if ( ! function_exists( 'it_acf_flexible_layout_thumbnail' ) ) {

	/**
	 * AFC Extended thumbnails
	 *
	 * @link https://wpsocket.com/plugin/acf-extended/faq/
	 */
	global $acfe_section_builders;

	// Existing flexible content layouts.
	$acfe_section_builders = array(
		// 'hero',
	);

	/**
	 * Generates the thumbnail path for a flexible layout in ACF.
	 *
	 * @param string $thumbnail The thumbnail path to be returned.
	 * @param array  $field The ACF field array.
	 * @param array  $layout The layout configuration array containing layout name.
	 *
	 * @phpstan-ignore-next-line
	 *
	 * @return string The path to the thumbnail image.
	 */
	function it_acf_flexible_layout_thumbnail( string $thumbnail, array $field, array $layout ): string {
		$layout_name = $layout['name'];

		// Recommended image size: 400x320px.
		return IT_IMG . 'acfe-thumbnails/' . $layout_name . '.jpg';
	}

	if ( count( $acfe_section_builders ) > 0 && is_admin() ) {
		foreach ( $acfe_section_builders as $layout ) {
			add_filter( 'acfe/flexible/thumbnail/layout=' . $layout, 'it_acf_flexible_layout_thumbnail', 10, 3 );
		}
	}
}

if ( ! function_exists( 'it_acf_add_google_map' ) ) {

	/**
	 * Add Google Map API key
	 *
	 * @return void
	 */
	function it_acf_add_google_map(): void {
		$google_maps_api_key = get_field( 'google_maps_api_key', 'options' );

		if ( $google_maps_api_key ) {
			acf_update_setting( 'google_api_key', $google_maps_api_key );
		}
	}

	add_action( 'acf/init', 'it_acf_add_google_map' );

}

if ( ! function_exists( 'it_acf_sanitize_anchor_id' ) ) {

	/**
	 * Sanitizes the Anchor ID field before saving.
	 *
	 * @param int|string $post_id The ID of the post being saved.
	 *
	 * @return void
	 */
	function it_acf_sanitize_anchor_id( int|string $post_id ): void {

		$builder = get_field( 'builder', $post_id );

		if ( is_array( $builder ) ) {

			foreach ( $builder as $k => $row ) {

				if ( 'anchor' === $row['acf_fc_layout'] ) {
					$value     = $row['anchor_id'];
					$new_value = sanitize_title( $value );

					update_post_meta( $post_id, 'builder_' . $k . '_anchor_id', $new_value );
				}
			}
		}
	}

	add_action( 'acf/save_post', 'it_acf_sanitize_anchor_id' );

}

if ( ! function_exists( 'it_acf_disable_modules' ) ) {

	/**
	 * Disable ACFE Modules that are not needed.
	 *
	 * @return void
	 */
	function it_acf_disable_modules(): void {
		acf_update_setting( 'acfe/modules/ui', false );
		acf_update_setting( 'acfe/modules/taxonomies', false );
		acf_update_setting( 'acfe/modules/post_types', false );
		acf_update_setting( 'acfe/modules/author', false );
		acf_update_setting( 'acfe/modules/block_types', false );
		acf_update_setting( 'acfe/modules/forms', false );
		acf_update_setting( 'acfe/modules/multilang', false );
		acf_update_setting( 'acfe/modules/options', false );
		acf_update_setting( 'acfe/modules/options_pages', false );
		acf_update_setting( 'acfe/modules/categories', false );
	}

	add_action( 'acfe/init', 'it_acf_disable_modules' );

}

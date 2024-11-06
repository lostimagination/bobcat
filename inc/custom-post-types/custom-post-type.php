<?php
/**
 * Custom post type registration
 *
 * @link https://developer.wordpress.org/reference/hooks/after_setup_theme/
 *
 * @package bobcat
 * @subpackage inc/custom-post-types/
 */

// Enable strict typing mode.
declare( strict_types = 1 );

/**
 * Custom Post type registration
 *
 * @link https://developer.wordpress.org/reference/functions/register_post_type/
 * @link https://developer.wordpress.org/reference/functions/register_taxonomy/
 * @link https://developer.wordpress.org/resource/dashicons/
 *
 * @return void
 */
function it_custom_init(): void {

	$labels = array(
		'name'          => esc_html__( 'Review', 'bobcat' ),
		'singular_name' => esc_html__( 'Review', 'bobcat' ),
	);

	$args = array(
		'label'               => esc_html__( 'Review', 'bobcat' ),
		'labels'              => $labels,
		'description'         => '',
		'public'              => true,
		'publicly_queryable'  => false,
		'show_ui'             => true,
		'rest_base'           => '',
		'has_archive'         => false,
		'menu_icon'           => 'dashicons-format-quote',
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_rest'        => true,
		'exclude_from_search' => false,
		'capability_type'     => 'post',
		'map_meta_cap'        => true,
		'hierarchical'        => false,
		'rewrite'             => array(
			'slug'       => 'review',
			'with_front' => true,
		),
		'query_var'           => true,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions' ),
	);

	register_post_type( 'reviews', $args );


	// Taxonomy: Example Category.
	register_taxonomy(
		'example-category',
		array( 'example' ), /* name of CPT */
		array(
			'labels'            => array(
				'name'          => esc_html__( 'Example Categories', 'bobcat' ),
				'singular_name' => esc_html__( 'Example Category', 'bobcat' ),
				'add_new_item'  => esc_html__( 'Add New Category', 'bobcat' ),
			),
			'hierarchical'      => true,     /* if this is true, it acts like categories */
			'show_admin_column' => true,
			'show_ui'           => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'example-category' ),
		)
	);
}

add_action( 'init', 'it_custom_init' );

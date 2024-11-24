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

	$labels = array(
		'name'          => esc_html__('Baumaschinen', 'bobcat'),
		'singular_name' => esc_html__('Baumaschinen', 'bobcat'),
	);

	$args = array(
		'label'               => esc_html__('Baumaschinen', 'bobcat'),
		'labels'              => $labels,
		'description'         => '',
		'public'              => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'rest_base'           => '',
		'has_archive'         => false, // Changed to true to support category archives
		'menu_icon'           => 'dashicons-format-quote',
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_rest'        => true,
		'exclude_from_search' => false,
		'capability_type'     => 'post',
		'map_meta_cap'        => true,
		'hierarchical'        => false,
		'rewrite'             => array(
			'slug'       => 'baumaschinen',
			'with_front' => false,
		),
		'query_var'           => true,
		'supports'            => array('title', 'editor', 'thumbnail', 'revisions'),
	);

	register_post_type('baumaschinen', $args);

	register_taxonomy(
		'baumaschinen-type',
		array('baumaschinen'),
		array(
			'labels'            => array(
				'name'          => esc_html__('Baumaschinen Categories', 'bobcat'),
				'singular_name' => esc_html__('Baumaschinen Category', 'bobcat'),
				'add_new_item'  => esc_html__('Add New Category', 'bobcat'),
			),
			'hierarchical'      => true,
			'show_admin_column' => true,
			'show_ui'           => true,
			'query_var'         => true,
			'show_in_rest'      => true,
			'rewrite'           => array(
				'slug'         => 'baumaschinen',
				'with_front'   => false,
				'hierarchical' => true
			)
		)
	);

	$labels = array(
		'name'          => esc_html__( 'Standorte', 'bobcat' ),
		'singular_name' => esc_html__( 'Standorte', 'bobcat' ),
	);

	$args = array(
		'label'               => esc_html__( 'Standorte', 'bobcat' ),
		'labels'              => $labels,
		'description'         => '',
		'public'              => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'rest_base'           => '',
		'has_archive'         => false,
		'menu_icon'           => 'dashicons-location',
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_rest'        => true,
		'exclude_from_search' => false,
		'capability_type'     => 'post',
		'map_meta_cap'        => true,
		'hierarchical'        => false,
		'rewrite'             => array(
			'slug'       => 'standorte',
			'with_front' => true,
		),
		'query_var'           => true,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions' ),
	);

	register_post_type( 'standorte', $args );

	$labels = array(
		'name'          => esc_html__( 'Team', 'bobcat' ),
		'singular_name' => esc_html__( 'Team', 'bobcat' ),
	);

	$args = array(
		'label'               => esc_html__( 'Team', 'bobcat' ),
		'labels'              => $labels,
		'description'         => '',
		'public'              => true,
		'publicly_queryable'  => false,
		'show_ui'             => true,
		'rest_base'           => '',
		'has_archive'         => false,
		'menu_icon'           => 'dashicons-admin-users',
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_rest'        => true,
		'exclude_from_search' => false,
		'capability_type'     => 'post',
		'map_meta_cap'        => true,
		'hierarchical'        => false,
		'rewrite'             => array(
			'slug'       => 'team',
			'with_front' => true,
		),
		'query_var'           => true,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions' ),
	);

	register_post_type( 'team', $args );
}

add_action( 'init', 'it_custom_init' );

/**
 * Custom permalink structure for baumaschinen posts
 */
function custom_baumaschinen_permalinks($post_link, $post): string {
	if (is_object($post) && $post->post_type === 'baumaschinen') {
		$terms = wp_get_object_terms($post->ID, 'baumaschinen-type');
		if (!empty($terms) && !is_wp_error($terms)) {
			$hierarchy = array();
			$term = $terms[0];

			while ($term) {
				array_unshift($hierarchy, $term->slug);
				if ($term->parent === 0) break;
				$term = get_term($term->parent, 'baumaschinen-type');
			}

			$taxonomy_path = implode('/', $hierarchy);
			return home_url("baumaschinen/{$taxonomy_path}/{$post->post_name}/");
		}
	}
	return $post_link;
}
add_filter('post_type_link', 'custom_baumaschinen_permalinks', 10, 2);

/**
 * Add custom rewrite rules for hierarchical URLs
 */
function add_custom_rewrite_rules(): void {
	// Rule for single posts with category hierarchy
	add_rewrite_rule(
		'^baumaschinen/(.+)/(.+)/?$',
		'index.php?baumaschinen=$matches[2]',
		'top'
	);

	// Rule for category archives
	add_rewrite_rule(
		'^baumaschinen/(.+)/?$',
		'index.php?baumaschinen-type=$matches[1]',
		'top'
	);
}
add_action('init', 'add_custom_rewrite_rules');

/**
 * Flush rewrite rules on theme/plugin activation
 */
function flush_baumaschinen_rules(): void {
	it_custom_init();
	flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'flush_baumaschinen_rules');

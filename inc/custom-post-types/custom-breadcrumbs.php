<?php
/**
 * Modify Yoast SEO breadcrumbs for Baumaschinen
 */
function custom_baumaschinen_breadcrumbs($links) {
	global $post;

	// Only modify breadcrumbs for Baumaschinen post type
	if (is_singular('baumaschinen')) {
		// Get the current post's terms
		$terms = get_the_terms($post->ID, 'baumaschinen-type');

		if (!empty($terms) && !is_wp_error($terms)) {
			// Get the first term (primary category)
			$term = $terms[0];

			// Build array of all parent terms
			$parent_terms = array();
			while ($term->parent != 0) {
				$term = get_term($term->parent, 'baumaschinen-type');
				array_unshift($parent_terms, $term);
			}

			// Create new breadcrumb array
			$new_breadcrumbs = array();

			// Add home link (keep the first element from original breadcrumbs)
			$new_breadcrumbs[] = $links[0];

			// Add "Baumaschinen" base
			$new_breadcrumbs[] = array(
				'url' => home_url('/baumaschinen/'),
				'text' => __('Baumaschinen', 'bobcat'),
			);

			// Add parent terms
			foreach ($parent_terms as $parent_term) {
				$new_breadcrumbs[] = array(
					'url' => get_term_link($parent_term, 'baumaschinen-type'),
					'text' => $parent_term->name,
				);
			}

			// Add current term
			$current_term = $terms[0];
			$new_breadcrumbs[] = array(
				'url' => get_term_link($current_term, 'baumaschinen-type'),
				'text' => $current_term->name,
			);

			// Add current post
			$new_breadcrumbs[] = array(
				'url' => get_permalink($post),
				'text' => get_the_title($post),
				'allow_html' => true
			);

			return $new_breadcrumbs;
		}
	}

	// For taxonomy archives
	if (is_tax('baumaschinen-type')) {
		$term = get_queried_object();

		// Build array of all parent terms
		$parent_terms = array();
		$current_term = $term;

		while ($current_term->parent != 0) {
			$current_term = get_term($current_term->parent, 'baumaschinen-type');
			array_unshift($parent_terms, $current_term);
		}

		// Create new breadcrumb array
		$new_breadcrumbs = array();

		// Add home link
		$new_breadcrumbs[] = $links[0];

		// Add "Baumaschinen" base
		$new_breadcrumbs[] = array(
			'url' => home_url('/baumaschinen/'),
			'text' => __('Baumaschinen', 'bobcat'),
		);

		// Add parent terms
		foreach ($parent_terms as $parent_term) {
			$new_breadcrumbs[] = array(
				'url' => get_term_link($parent_term, 'baumaschinen-type'),
				'text' => $parent_term->name,
			);
		}

		// Add current term
		$new_breadcrumbs[] = array(
			'text' => $term->name,
		);

		return $new_breadcrumbs;
	}

	return $links;
}
add_filter('wpseo_breadcrumb_links', 'custom_baumaschinen_breadcrumbs');

/**
 * Optional: Add custom separator for breadcrumbs
 */
function custom_breadcrumb_separator($separator) {
	return '<span class="breadcrumb-separator">&gt;</span>';
}
add_filter('wpseo_breadcrumb_separator', 'custom_breadcrumb_separator');

/**
 * Optional: Add schema markup for breadcrumbs
 */
function custom_breadcrumb_schema($schema) {
	if (is_singular('baumaschinen') || is_tax('baumaschinen-type')) {
		$schema['@type'] = 'BreadcrumbList';
	}
	return $schema;
}
add_filter('wpseo_schema_breadcrumb', 'custom_breadcrumb_schema');

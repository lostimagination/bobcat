<?php
/**
 * Modify Yoast SEO breadcrumbs for Baumaschinen
 */
function custom_baumaschinen_breadcrumbs($links) {
	global $post;
	$archive_page_id = get_field('mech_archive', 'option');

	if (is_singular('baumaschinen')) {
		$terms = get_the_terms($post->ID, 'baumaschinen-type');

		if (!empty($terms) && !is_wp_error($terms)) {
			$term = $terms[0];
			$parent_terms = array();
			while ($term->parent != 0) {
				$term = get_term($term->parent, 'baumaschinen-type');
				array_unshift($parent_terms, $term);
			}

			$new_breadcrumbs = array();
			$new_breadcrumbs[] = $links[0]; // Home link

			// Add archive page instead of "Baumaschinen" base
			$new_breadcrumbs[] = array(
				'url' => get_permalink($archive_page_id),
				'text' => get_the_title($archive_page_id),
			);

			foreach ($parent_terms as $parent_term) {
				$new_breadcrumbs[] = array(
					'url' => get_term_link($parent_term, 'baumaschinen-type'),
					'text' => $parent_term->name,
				);
			}

			$current_term = $terms[0];
			$new_breadcrumbs[] = array(
				'url' => get_term_link($current_term, 'baumaschinen-type'),
				'text' => $current_term->name,
			);

			$new_breadcrumbs[] = array(
				'url' => get_permalink($post),
				'text' => get_the_title($post),
				'allow_html' => true
			);

			return $new_breadcrumbs;
		}
	}

	if (is_tax('baumaschinen-type')) {
		$term = get_queried_object();
		$parent_terms = array();
		$current_term = $term;

		while ($current_term->parent != 0) {
			$current_term = get_term($current_term->parent, 'baumaschinen-type');
			array_unshift($parent_terms, $current_term);
		}

		$new_breadcrumbs = array();
		$new_breadcrumbs[] = $links[0];

		// Add archive page instead of "Baumaschinen" base
		$new_breadcrumbs[] = array(
			'url' => get_permalink($archive_page_id),
			'text' => get_the_title($archive_page_id),
		);

		foreach ($parent_terms as $parent_term) {
			$new_breadcrumbs[] = array(
				'url' => get_term_link($parent_term, 'baumaschinen-type'),
				'text' => $parent_term->name,
			);
		}

		$new_breadcrumbs[] = array(
			'text' => $term->name,
		);

		return $new_breadcrumbs;
	}

	return $links;
}
add_filter('wpseo_breadcrumb_links', 'custom_baumaschinen_breadcrumbs');

add_filter( 'wpseo_breadcrumb_separator', 'custom_breadcrumb_separator' );
function custom_breadcrumb_separator( $separator ): string {
	$svg_icon = '<svg width="5" height="7" viewBox="0 0 5 7" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M0.719504 6.5105H1.54217C1.64434 6.5105 1.7425 6.46984 1.81467 6.3975L4.43967 3.7725C4.59017 3.622 4.59017 3.378 4.43967 3.2275L1.81467 0.602498C1.7425 0.530165 1.64434 0.489498 1.54217 0.489665C1.379 0.489665 1.02434 0.489669 0.719504 0.489502C0.563504 0.489502 0.423004 0.583498 0.363338 0.727498C0.303671 0.871498 0.336671 1.03733 0.446838 1.1475L2.7625 3.46317C2.78284 3.4835 2.78284 3.5165 2.7625 3.53683L0.446838 5.8525C0.336671 5.96267 0.303671 6.1285 0.363338 6.2725C0.423004 6.4165 0.563504 6.5105 0.719504 6.5105Z" fill="black"/>
</svg>';

	return $svg_icon;
}

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

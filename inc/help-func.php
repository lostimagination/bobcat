<?php
/**
 * Custom functions which help to speed up development
 *
 * @package bobcat
 * @subpackage inc/disables/
 */

// Enable strict typing mode.
declare( strict_types = 1 );

if ( ! function_exists( 'it_posted_on' ) ) {

	/**
	 * Prints HTML with meta information for the current post-date/time.
	 *
	 * @return void
	 */
	function it_posted_on(): void {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( (string) get_the_date( DATE_W3C ) ),
			esc_html( (string) get_the_date() ),
			esc_attr( (string) get_the_modified_date( DATE_W3C ) ),
			esc_html( (string) get_the_modified_date() )
		);

		$posted_on = sprintf(
		/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'bobcat' ),
			$time_string
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

}

if ( ! function_exists( 'it_posted_by' ) ) {

	/**
	 * Prints HTML with meta information for the current author.
	 *
	 * @return void
	 */
	function it_posted_by(): void {
		$byline = sprintf(
		/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'bobcat' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( (int) get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

}

if ( ! function_exists( 'it_cat_links' ) ) {

	/**
	 * Prints HTML with meta information for the post categories.
	 *
	 * @return void
	 */
	function it_cat_links(): void {
		$categories_list = get_the_category_list( esc_html__( ', ', 'bobcat' ) );

		if ( $categories_list ) {
			printf(
			/* translators: %s: categories. */
				'<div class="cat-links">' . esc_html__( 'Posted in %1$s', 'bobcat' ) . '</div>',
				wp_kses_post( $categories_list )
			);
		}
	}

}

if ( ! function_exists( 'it_tag_links' ) ) {

	/**
	 * Prints HTML with meta information for the post tags.
	 *
	 * @return void
	 */
	function it_tag_links(): void {
		$tags_list = get_the_tag_list( '', ', ' );

		if ( ! is_wp_error( $tags_list ) && $tags_list ) {
			printf(
			/* translators: %s: tags. */
				'<div class="tag-links">' . esc_html__( 'Tagged %1$s', 'bobcat' ) . '</div>',
				wp_kses_post( $tags_list ) // @phpstan-ignore-line
			);
		}
	}

}

if ( ! function_exists( 'it_excerpt' ) ) {

	/**
	 * Limit Excerpt Length
	 *
	 * @param int $word_limit - word limitation.
	 *
	 * @return void
	 */
	function it_excerpt( int $word_limit ): void {

		$excerpt = explode( ' ', get_the_excerpt(), $word_limit );

		if ( count( $excerpt ) >= $word_limit ) {
			array_pop( $excerpt );
			$excerpt = implode( ' ', $excerpt ) . '...';
		} else {
			$excerpt = implode( ' ', $excerpt );
		}

		$excerpt = preg_replace( '`[[^]]*]`', '', $excerpt );

		if ( is_string( $excerpt ) ) {
			echo wp_kses_post( $excerpt );
		}
	}

}

if ( ! function_exists( 'it_phone_cleaner' ) ) {

	/**
	 * Phone number cleaner
	 *
	 * @param string $tel - phone number.
	 *
	 * @return null|string
	 */
	function it_phone_cleaner( string $tel ): string|null {
		return preg_replace( '/[^+\d]+/', '', $tel );
	}
}

if ( ! function_exists( 'it_hide_email_shortcode' ) ) {

	/**
	 * Hide email from Spam Bots using a shortcode.
	 *
	 * @param string[]    $atts Shortcode attributes.
	 * @param string|null $content Shortcode content.
	 *
	 * @return string|null Formatted email link if valid email is provided, null otherwise.
	 */
	function it_hide_email_shortcode( array $atts, ?string $content = null ): ?string {

		if ( is_null( $content ) || ! is_email( $content ) ) {
			return null;
		}

		$email = antispambot( $content );

		return sprintf( '<a href="%s">%s</a>', esc_url( "mailto:$email" ), esc_html( $email ) );
	}

	add_shortcode( 'email', 'it_hide_email_shortcode' );

}

if ( ! function_exists( 'it_image_placeholder' ) ) {

	/**
	 * Image Placeholder
	 *
	 * @return void
	 */
	function it_image_placeholder(): void {
		echo '<span class="img-placeholder"><svg id="image" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M464 64H48C21.49 64 0 85.49 0 112v288c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V112c0-26.51-21.49-48-48-48zm16 336c0 8.822-7.178 16-16 16H48c-8.822 0-16-7.178-16-16V112c0-8.822 7.178-16 16-16h416c8.822 0 16 7.178 16 16v288zM112 232c30.928 0 56-25.072 56-56s-25.072-56-56-56-56 25.072-56 56 25.072 56 56 56zm0-80c13.234 0 24 10.766 24 24s-10.766 24-24 24-24-10.766-24-24 10.766-24 24-24zm207.029 23.029L224 270.059l-31.029-31.029c-9.373-9.373-24.569-9.373-33.941 0l-88 88A23.998 23.998 0 0 0 64 344v28c0 6.627 5.373 12 12 12h360c6.627 0 12-5.373 12-12v-92c0-6.365-2.529-12.47-7.029-16.971l-88-88c-9.373-9.372-24.569-9.372-33.942 0zM416 352H96v-4.686l80-80 48 48 112-112 80 80V352z"/></svg></span>';
	}

}

if ( ! function_exists( 'it_inline_svg' ) ) {

	/**
	 * Inline SVG
	 *
	 * @param string $svg_url SVG url to return inline code.
	 *
	 * @return string
	 */
	function it_inline_svg( string $svg_url ): string {
		$svg_content = '';
		$extension   = pathinfo( $svg_url, PATHINFO_EXTENSION );

		// Also I'd add some extra security check for mime type.
		if ( 'svg' === $extension ) {
			if ( str_contains( $svg_url, home_url() ) ) {
				$path        = str_replace( home_url( '/' ), '', $svg_url );
				$svg_content = file_get_contents( ABSPATH . $path );
			} else {
				$remote_svg_file = wp_remote_get( $svg_url, array( 'sslverify' => false ) );
				$svg_content     = wp_remote_retrieve_body( $remote_svg_file );
			}
		} else {
			$svg_content = '<img alt="" src="' . $svg_url . '">';
		}

		return $svg_content ?: ''; // phpcs:ignore
	}

}

if ( ! function_exists( 'it_console_log' ) ) {

	/**
	 * Output like the var_dump() in the browser's JS console
	 *
	 * @param null|string $content - content to display.
	 * @param bool        $as_text - display type: text, JS object.
	 *
	 * @return void
	 */
	function it_console_log( null|string $content = null, bool $as_text = true ): void {
		echo '<div class="php-to-js-console-log" style="display: none!important;" data-as-text="' . esc_attr( $as_text ) . '" data-variable="' . htmlspecialchars( wp_json_encode( $content ) ) . '">' . htmlspecialchars( var_export( $content, true ) ) . '</div>'; // phpcs:ignore

		$hook = is_admin() ? 'admin_footer' : 'wp_footer';
		add_action(
			$hook,
			function () {
				echo '<script>(function ($) { $(document).ready(function ($) { var phpToJsElements = $(".php-to-js-console-log").detach(); $("body").append("<div id=\"php-to-js-console-logs\" style=\"display: none!important;\"></div>"); $("#php-to-js-console-logs").append(phpToJsElements); phpToJsElements.each(function (i, el) { var $e = $(el); console.log("PHP debug is below:"); (!$e.attr("data-as-text")) ? console.log(JSON.parse($e.attr("data-variable"))) : console.log($e.text()); }); }); }(jQuery));</script>';
			},
			1
		);
	}

}

if ( ! function_exists( 'it_log' ) ) {

	/**
	 * Log a variable to a file.
	 *
	 * Logs a variable to a specified log file with an optional label.
	 *
	 * @param mixed       $variable The variable to be logged.
	 * @param string|null $label Optional. A label to prepend to the log entry.
	 * @param string      $file Optional. The path to the log file. Defaults to 'debug.log' in the current directory.
	 *
	 * @return bool True on success, false on failure.
	 * @since 1.0.0
	 */
	function it_log( mixed $variable, string|null $label = null, string $file = ABSPATH . '/debug.log' ): bool {

		$logfile = $file;

		$date_format   = 'Y-m-d H:i:s';
		$formatted_var = print_r( $variable, true ); // phpcs:ignore

		$output  = '[' . gmdate( $date_format ) . '] ';
		$output .= $label ? '(' . $label . ') ' : '';
		$output .= $formatted_var . "\n";

		// Open the log file, or create it if doesn't exist.
		if ( ! $handle = fopen( $logfile, 'a' ) ) { // phpcs:ignore
			return false;
		}

		if ( fwrite( $handle, $output ) === false ) { // phpcs:ignore
			return false;
		}

		fclose( $handle ); // phpcs:ignore

		return true;
	}

}

if ( ! function_exists( 'it_get_social_share_buttons' ) ) {
	function it_get_social_share_buttons() {
		$post_url = urlencode(get_permalink());
		$post_title = urlencode(get_the_title());

		$facebook_url = 'https://www.facebook.com/sharer.php?u=' . $post_url;
		$twitter_url = 'https://twitter.com/intent/tweet?url=' . $post_url . '&text=' . $post_title;
		$linkedin_url = 'https://www.linkedin.com/shareArticle?mini=true&url=' . $post_url . '&title=' . $post_title;
		$xing_url = 'https://www.xing.com/spi/shares/new?url=' . $post_url;

		$output = '<div class="social-share-buttons">';
		$output .= '<a href="' . $facebook_url . '" target="_blank" rel="nofollow" class="facebook-share">
        <svg><use xlink:href="#social-facebook"></use></svg>
    </a>';
		$output .= '<a href="' . $linkedin_url . '" target="_blank" rel="nofollow" class="linkedin-share">
        <svg><use xlink:href="#social-linkedin"></use></svg>
    </a>';
		$output .= '<a href="' . $twitter_url . '" target="_blank" rel="nofollow" class="twitter-share">
        <svg><use xlink:href="#social-twitter"></use></svg>
    </a>';
		$output .= '<a href="' . $xing_url . '" target="_blank" rel="nofollow" class="xing-share">
        <svg><use xlink:href="#social-xing"></use></svg>
    </a>';
		$output .= '</div>';

		return $output;
	}
}

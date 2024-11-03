<?php
/**
 * Remove user profile fields
 *
 * @package bobcat
 * @subpackage inc/disables/
 */

// Enable strict typing mode.
declare( strict_types = 1 );

if ( ! function_exists( 'it_remove_user_profile_fields' ) ) {

	/**
	 * Remove user profile fields.
	 *
	 * @param array<string, mixed> $profile_fields - fields to disable.
	 *
	 * @return array<string, mixed>
	 */
	function it_remove_user_profile_fields( array $profile_fields ): array {
		unset( $profile_fields['facebook'] );
		unset( $profile_fields['instagram'] );
		unset( $profile_fields['linkedin'] );
		unset( $profile_fields['myspace'] );
		unset( $profile_fields['pinterest'] );
		unset( $profile_fields['soundcloud'] );
		unset( $profile_fields['tumblr'] );
		unset( $profile_fields['twitter'] );
		unset( $profile_fields['youtube'] );
		unset( $profile_fields['wikipedia'] );

		return $profile_fields;
	}

	add_filter( 'user_contactmethods', 'it_remove_user_profile_fields' );

}

'use strict';

const $ = jQuery.noConflict();

export const it_admin_bar = () => {
	/**
	 * Toggle Admin bar display.
	 */
	if ($('body').hasClass('admin-bar')) {
		// Remove extra top margin when admin bar is active on front-end.
		$('html').css({ cssText: 'margin-top: 0 !important' });

		// Toggle admin bar.
		$('#wp-admin-bar-site-name').on('click', function (e) {
			e.stopPropagation();
			$('#wpadminbar').toggleClass('is-expanded');
		});
	}
};

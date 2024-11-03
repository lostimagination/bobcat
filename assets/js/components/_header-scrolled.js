'use strict';

const $ = jQuery.noConflict();

export const it_check_scroll_position = () => {
	if ($('body').hasClass('is-menu-open')) {
		return;
	}

	const scrollPos = $(window).scrollTop();

	if (scrollPos > 70) {
		$('body').addClass('is-scrolled');
	} else {
		$('body').removeClass('is-scrolled');
	}
};

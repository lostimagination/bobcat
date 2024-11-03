'use strict';

const $ = jQuery.noConflict();

export const it_force_lazy_load = () => {
	setTimeout(function () {
		$('.lazyload.loading').removeClass('loading').addClass('loaded');
	}, 3000);
};

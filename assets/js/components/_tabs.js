'use strict';

const $ = jQuery.noConflict();

export const it_tabs = () => {
	$(document).on('click', '.js-tab-title', function () {
		const tabs = $(this).closest('.js-tabs'),
			item = $(this).data('item');
		if ('' !== item) {
			tabs.find('.js-tab-title').removeClass('is-active');
			$(this).addClass('is-active');
			tabs.find('.js-tab-content').removeClass('is-active');
			tabs.find('#' + item).addClass('is-active');
		}
	});
};

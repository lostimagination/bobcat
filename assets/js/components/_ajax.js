'use strict';

const $ = jQuery.noConflict();

export const it_ajax_example = () => {
	$.ajax({
		url: wpApiSettings.ajaxUrl,
		type: 'post',
		data: {
			action: 'it_custom_ajax_action',
		},
		success(data) {
			console.log(data); // eslint-disable-line
		},
	});
};

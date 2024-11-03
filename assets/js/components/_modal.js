'use strict';

const $ = jQuery.noConflict();

export const it_modal = () => {
	$(document).on('click', '.js-modal-open', function (e) {
		e.preventDefault();
		const modal_id = $(this).data('modal');
		$('body').removeClass('is-menu-open').addClass('overflow-hidden');
		$('#' + modal_id).addClass('is-open');
	});

	$(document)
		.find('.js-modal-close, .modal__overlay')
		.on('click', function () {
			$('.modal').removeClass('is-open');
			$('body').removeClass('overflow-hidden');
		});
};

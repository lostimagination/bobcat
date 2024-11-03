'use strict';

import vars from '../_vars';

const $ = jQuery.noConflict();

export const it_menu_nav = () => {
	/**
	 * Toggle main menu
	 */
	$('.icon-burger').on('click', function () {
		$('body').toggleClass('is-menu-open');
	});

	$('.main-menu li:not(.menu-item-has-children) > a').on(
		'click',
		function () {
			$('body').removeClass('is-menu-open');
		}
	);

	/**
	 * Toggle mobile sub menu
	 */
	$(
		'.main-menu .menu-item-has-children, .footer-links .menu-item-has-children'
	).on('click', function (e) {
		const el = $(this),
			topEl = $(this).parent();
		if ($(window).width() < vars.bp.lg) {
			e.stopPropagation();
			if (el.hasClass('active')) {
				el.removeClass('active');
				el.find('> .sub-menu').slideUp();
			} else {
				topEl.find('.menu-item-has-children').each(function () {
					$(this).removeClass('active');
					$(this).find('> .sub-menu').slideUp();
				});
				el.addClass('active');
				el.find('> .sub-menu').slideDown();
			}
		}
	});
};

export const it_close_menu_nav = () => {
	$('.main-menu .sub-menu, .footer-links .sub-menu').css('display', '');

	if ($(window).width() >= vars.bp.lg) {
		if ($('body').hasClass('is-menu-open')) {
			$('.icon-burger').trigger('click');
		}
	}
};

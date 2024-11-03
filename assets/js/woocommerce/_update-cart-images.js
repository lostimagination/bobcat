'use strict';

const $ = jQuery.noConflict();

export const it_update_cart_lazy_images = () => {
	$(document).on(
		'added_to_cart removed_from_cart updated_cart_totals updated_checkout',
		function () {
			try {
				lazyLoadInstance.update();
			} catch (e) {
				console.warn('Lazy load images were not updated'); // eslint-disable-line
			}
		}
	);
};

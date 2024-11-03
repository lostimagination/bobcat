'use strict';

const $ = jQuery.noConflict();

export const it_woo_nice_select = () => {
	if ($('body').hasClass('woocommerce-account')) {
		$('.woocommerce-MyAccount-content select, .woocommerce-form select').select2();
	}
};

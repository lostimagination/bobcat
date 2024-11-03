'use strict';

const $ = jQuery.noConflict();

export const it_nice_select = () => {
	/**
	 * Activate NiceSelect
	 *
	 * Do not activate NiceSelect on those pages, where it might conflict with Select2
	 */
	if (!$('body').hasClass('woocommerce-account')) {
		$('select').niceSelect();
	}

	/**
	 * Trigger NiceSelect update after WooCommerce Update variations
	 */
	$('.variations_form').on('woocommerce_variation_has_changed', function () {
		$('.variations_form select').niceSelect('update');
	});
};

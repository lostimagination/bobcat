'use strict';

const $ = jQuery.noConflict();

const it_woo_update_product_qty = (that) => {
	// Get current quantity values
	const max = 9999,
		min = 1,
		step = 1,
		qty = that.closest('.quantity').find('.qty'),
		val = parseFloat(qty.val());

	let totalQty = val;

	// Change the value if plus or minus
	if (that.is('.btn-qty__plus')) {
		if (max && max <= val) {
			qty.val(max).trigger('change');
			totalQty = max;
		} else {
			qty.val(val + step).trigger('change');
			totalQty = val + step;
		}
	} else if (that.is('.btn-qty__minus')) {
		if (min && min >= val) {
			qty.val(min).trigger('change');
			totalQty = min;
		} else if (val > 1) {
			qty.val(val - step).trigger('change');
			totalQty = val - step;
		}
	}
	if (1 === totalQty) {
		that.closest('.quantity').find('.btn-qty__minus').addClass('disabled');
	} else {
		that.closest('.quantity')
			.find('.btn-qty__minus')
			.removeClass('disabled');
	}
};

export const it_woo_update_quantity = () => {
	$(document).on(
		'click',
		'.quantity button.btn-qty__plus,  .quantity button.btn-qty__minus',
		function () {
			it_woo_update_product_qty($(this));

			$('button[name="update_cart"]')
				.removeAttr('disabled')
				.attr('aria-disabled', 'false');
		}
	);

	$(document).on('keyup', '.quantity .qty', function () {
		it_woo_update_product_qty($(this));

		$('button[name="update_cart"]')
			.removeAttr('disabled')
			.attr('aria-disabled', 'false');
	});

	const qtyFields = $('.quantity .qty');

	if (qtyFields.length) {
		qtyFields.each(function () {
			it_woo_update_product_qty($(this));
		});
	}
};

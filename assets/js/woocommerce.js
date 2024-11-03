'use strict';

const $ = jQuery.noConflict();

/*
 * Import custom functions for WooCommerce.
 */
import { it_woo_nice_select } from './woocommerce/_nice-select';
import { it_woo_update_quantity } from './woocommerce/_update-quantity';
import { it_update_cart_lazy_images } from './woocommerce/_update-cart-images';
import {
	it_configure_single_slider,
	it_init_slider_for_upsells_and_related,
	it_init_woo_zoom,
	it_toggle_buttons_on_resize,
} from './woocommerce/_single-product';

$(document).ready(function () {
	it_woo_nice_select();
	it_woo_update_quantity();
	it_update_cart_lazy_images();
	it_init_woo_zoom();
	it_init_slider_for_upsells_and_related();
	it_configure_single_slider();
});

window.addEventListener('load', function () {});

$(window).resize(function () {
	it_toggle_buttons_on_resize();
});

$(window).on('orientationchange', function () {});

$(window).on('scroll', function () {});

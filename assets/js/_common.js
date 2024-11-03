'use strict';

const $ = jQuery.noConflict();

/*
 * Import helper functions
 */
import { throttle } from './functions/throttle';

/*
 * Import custom that runs after some plugin event.
 */
import { it_cf7_example_event } from './plugins/_cf7-events';

/*
 * Import custom scripts for fixes.
 */
import { it_fix_full_height } from './fixes/_fix-full-height';

/*
 * Import custom functions from components.
 */
import { it_accordion } from './components/_accordion';
import { it_admin_bar } from './components/_adminbar';
import { it_check_scroll_position } from './components/_header-scrolled';
import { it_modal } from './components/_modal';
import { it_menu_nav, it_close_menu_nav } from './components/_menu_nav';
import { it_tabs } from './components/_tabs';
import { it_smooth_anchor_scroll } from './components/_smooth-scroll-anchor';
import { it_toggle_to_top, it_click_to_top } from './components/_to-top';
import { it_toggle_item } from './components/_toggle';
import { it_force_lazy_load } from './components/_force-lazy-load';

/*
 * Import custom functions for vendor libraries.
 */
import { it_nice_select } from './libraries/_nice-select';
import { it_swiper } from './libraries/_swiper';
import { it_fancybox } from './libraries/_fancybox';

$(document).ready(function () {
	it_accordion();
	it_admin_bar();
	it_check_scroll_position();
	it_modal();
	it_menu_nav();
	it_tabs();
	it_smooth_anchor_scroll();
	it_toggle_item();
	it_force_lazy_load();
	it_cf7_example_event();
	it_fix_full_height();
	it_nice_select();
	it_swiper();
	it_fancybox();

	/*
	 * JS LazyLoad fix for images on the first screen.
	 * This code should run after all the code is initiated.
	 */
	$(window).trigger('scroll');
});

window.addEventListener('load', function () {
	it_check_scroll_position();
	it_click_to_top();
});

$(window).resize(function () {
	it_close_menu_nav();
	throttle(it_fix_full_height);
});

$(window).on('orientationchange', function () {});

$(window).on('scroll', function () {
	it_check_scroll_position();
	it_toggle_to_top();
});

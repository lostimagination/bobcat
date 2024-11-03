'use strict';

const $ = jQuery.noConflict();

/*
 * Import custom functions for admin area.
 */
import { it_admin_example } from './admin/admin_example';

$(document).ready(function () {
	it_admin_example();
});

window.addEventListener('load', function () {});

$(window).resize(function () {});

$(window).on('orientationchange', function () {});

$(window).on('scroll', function () {});

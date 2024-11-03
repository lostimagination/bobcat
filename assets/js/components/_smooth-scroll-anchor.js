'use strict';

const $ = jQuery.noConflict();

export const it_smooth_anchor_scroll = () => {
	$('a[href*="#"]:not([href="#"])').on('click', function () {
		if (
			location.pathname.replace(/^\//, '') ===
				this.pathname.replace(/^\//, '') &&
			location.hostname === this.hostname
		) {
			let target = $(this.hash);
			target = target.length
				? target
				: $('[name=' + this.hash.slice(1) + ']');
			if (target.length) {
				$('html,body').animate(
					{
						scrollTop: target.offset().top,
					},
					700
				);

				// remove anchor from url
				const hash = location.hash.replace('#', '');

				if (hash !== '') {
					location.hash = '';
				}

				return false;
			}
		}
	});
};

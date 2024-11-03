'use strict';

/*
 * Import Swiper bundle with all modules installed.
 *
 * Available Swiper.js modules = [Virtual, Keyboard, Mousewheel, Navigation,
 * Pagination, Scrollbar, Parallax, Zoom, Lazy, Controller, A11y, History,
 * HashNavigation, Autoplay, Thumbs, FreeMode, Grid, Manipulation, EffectFade,
 * EffectCube, EffectFlip, EffectCoverflow, EffectCreative, EffectCards]
 */
import Swiper, {
	Navigation,
	Pagination,
	Autoplay,
	Thumbs,
} from 'swiper/bundle';

export const it_swiper = () => {
	const sliders = document.querySelectorAll('.swiper-images');

	if (sliders.length < 1) {
		return;
	}

	sliders.forEach((slider) => {
		new Swiper(slider, {
			loop: true,
			autoplay: {
				delay: 2500,
				disableOnInteraction: false,
			},
			pagination: {
				el: slider.querySelector('.swiper-pagination'),
				clickable: true,
			},
			navigation: {
				enabled: true,
				nextEl: slider.querySelector('.swiper-button-next'),
				prevEl: slider.querySelector('.swiper-button-prev'),
			},
			on: {
				// lazy load images
				slideChange() {
					try {
						lazyLoadInstance.update();
					} catch (e) {}
				},
			},
		});
	});
};

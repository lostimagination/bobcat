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
	const sliders = document.querySelectorAll('.slide-reviews');

	if (sliders.length < 1) {
		return;
	}

	sliders.forEach((slider) => {
		const sliderWrapper = slider.closest('.review-slider-wrapper');
		new Swiper(slider, {
			loop: true,
			slidesPerView: 3,
			spaceBetween: 30,
			autoplay: false,
			pagination: {
				el: sliderWrapper.querySelector('.swiper-pagination'),
				clickable: true,
			},
			navigation: {
				enabled: true,
				nextEl: sliderWrapper.querySelector('.swiper-button-next'),
				prevEl: sliderWrapper.querySelector('.swiper-button-prev'),
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

		const sliders = document.querySelectorAll('.slider-jobs');

		sliders.forEach((slider) => {
			const sliderWrapper = slider.closest('.jobs-slider-wrapper');
			new Swiper(slider, {
				slidesPerView: 1,
				spaceBetween: 20,
				autoplay: false,
				centeredSlides: true,
				loop: true,
				pagination: {
					el: sliderWrapper.querySelector('.swiper-pagination'),
					clickable: true,
				},
				navigation: {
					enabled: true,
					nextEl: sliderWrapper.querySelector('.swiper-button-next'),
					prevEl: sliderWrapper.querySelector('.swiper-button-prev'),
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
	});
};

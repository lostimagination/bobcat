'use strict';

import Swiper, {
	Navigation,
	Pagination,
	Autoplay,
	Thumbs,
} from 'swiper/bundle';

const sliderConfigs = {
	reviews: {
		selector: '.slide-reviews',
		wrapperSelector: '.review-slider-wrapper',
		options: {
			loop: true,
			slidesPerView: 3,
			spaceBetween: 30,
			autoplay: false,
			pagination: {
				enabled: true,
				options: {
					clickable: true
				}
			}
		}
	},
	jobs: {
		selector: '.slider-jobs',
		wrapperSelector: '.jobs-slider-wrapper',
		options: {
			slidesPerView: 1,
			spaceBetween: 20,
			autoplay: false,
			centeredSlides: true,
			loop: true,
			pagination: {
				enabled: true,
				options: {
					clickable: true
				}
			}
		}
	},
	machineGallery: {
		selector: '.machine-gallery-slider',
		wrapperSelector: '.machine-gallery',
		options: {
			slidesPerView: 3,
			spaceBetween: 20,
			autoplay: false,
			loop: true,
			pagination: {
				enabled: false,
			}
		}
	},
	relatedProductGallery: {
		selector: '.related-product-gallery-slider',
		wrapperSelector: '.related-product-gallery',
		options: {
			slidesPerView: 3,
			spaceBetween: 30,
			autoplay: false,
			loop: true,
			pagination: {
				enabled: true,
				options: {
					clickable: true
				}
			}
		}
	}
};

const initializeSliderType = (config) => {
	const sliders = document.querySelectorAll(config.selector);

	if (sliders.length === 0) return;

	sliders.forEach((slider) => {
		const sliderWrapper = slider.closest(config.wrapperSelector);
		if (!sliderWrapper) return;

		const swiperConfig = {
			...config.options,
			navigation: {
				enabled: true,
				nextEl: sliderWrapper.querySelector('.swiper-button-next'),
				prevEl: sliderWrapper.querySelector('.swiper-button-prev'),
			},
			on: {
				slideChange() {
					try {
						lazyLoadInstance.update();
					} catch (e) {
						console.warn('LazyLoad instance not available:', e);
					}
				},
			},
		};

		if (config.options.pagination?.enabled) {
			swiperConfig.pagination = {
				el: sliderWrapper.querySelector('.swiper-pagination'),
				...config.options.pagination.options
			};
		}

		const paginationOverride = slider.dataset.pagination === 'false' ? false :
			slider.dataset.pagination === 'true' ? true : null;

		if (paginationOverride !== null) {
			if (paginationOverride) {
				swiperConfig.pagination = {
					el: sliderWrapper.querySelector('.swiper-pagination'),
					...config.options.pagination?.options
				};
			} else {
				delete swiperConfig.pagination;
			}
		}

		new Swiper(slider, swiperConfig);
	});
};

export const initializeSliders = () => {
	Object.values(sliderConfigs).forEach(initializeSliderType);
};

export const initializeSpecificSlider = (sliderType) => {
	if (sliderConfigs[sliderType]) {
		initializeSliderType(sliderConfigs[sliderType]);
	} else {
		console.warn(`Slider type "${sliderType}" not found in configurations`);
	}
};

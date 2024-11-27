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
			slidesPerView: 1,
			spaceBetween: 30,
			autoplay: false,
			breakpoints: {
				320: {
					slidesPerView: 1.2,
					pagination: {
						enabled: false
					}
				},
				768: {
					slidesPerView: 2,
					pagination: {
						enabled: false
					}
				},
				1024: {
					slidesPerView: 3,
					pagination: {
						enabled: true,
						clickable: true
					}
				}
			},
			pagination: {
				el: '.swiper-pagination',
				enabled: true,
				clickable: true
			},
		}
	},
	jobs: {
		selector: '.slider-jobs',
		wrapperSelector: '.jobs-slider-wrapper',
		options: {
			slidesPerView: 1,
			spaceBetween: 20,
			autoplay: false,
			centeredSlides: false,
			loop: false,
			initialSlide: 0,
			breakpoints: {
				320: {
					slidesPerView: 1.3,
					pagination: {
						enabled: false
					}
				},
				1024: {
					slidesPerView: 1,
					initialSlide: 1,
					centeredSlides: false,
					pagination: {
						enabled: true,
						clickable: true
					}
				}
			},
			pagination: {
				enabled: true,
				options: {
					clickable: true
				}
			}
		}
	},
	history: {
		selector: '.slider-history',
		wrapperSelector: '.history-slider-wrapper',
		options: {
			slidesPerView: 3,
			spaceBetween: 0,
			autoplay: false,
			centeredSlides: true,
			loop: false,
			initialSlide: 1,
			breakpoints: {
				320: {
					slidesPerView: 1.2,
				},
				768: {
					slidesPerView: 2,
				},
				1024: {
					slidesPerView: 3,
				}
			},
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
			slidesPerView: 1.3,
			breakpoints: {
				768: {
					slidesPerView: 2,
				},
				1024: {
					slidesPerView: 3,
				}
			},
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
			slidesPerView: 1.3,
			spaceBetween: 30,
			autoplay: false,
			loop: true,
			pagination: {
				enabled: true,
				options: {
					clickable: true
				}
			},
			breakpoints: {
				320: {
					slidesPerView: 1.3,
					pagination: {
						enabled: false,
					},
				},
				768: {
					slidesPerView: 2,
				},
				1024: {
					slidesPerView: 3,
					pagination: {
						enabled: true,
					},
				}
			},
		}
	},
	news: {
		selector: '.slider-news',
		wrapperSelector: '.mobile-news-slider',
		options: {
			slidesPerView: 1.2,
			spaceBetween: 8,
			autoplay: false,
			pagination: {
				el: '.swiper-pagination',
				enabled: false,
				clickable: true
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

		if (slider.classList.contains('slider-history')) {
			const slides = slider.querySelectorAll('.swiper-slide');
			const totalSlides = slides.length;
			if (totalSlides > 0) {
				const middleIndex = Math.floor((totalSlides - 1) / 2);
				swiperConfig.initialSlide = middleIndex;
			}
		}

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

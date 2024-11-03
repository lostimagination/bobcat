'use strict';

const $ = jQuery.noConflict();

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

import { throttle } from '../functions/throttle';

const it_toggle_slider_buttons = (slider) => {
	const disabledButtons = slider.querySelectorAll('.swiper-button-disabled');

	if (disabledButtons.length === 2) {
		disabledButtons.forEach((el) => el.classList.add('d-none'));
	} else {
		slider
			.querySelectorAll('.swiper-button-prev, .swiper-button-next')
			.forEach((el) => el.classList.remove('d-none'));
	}
};

export const it_toggle_buttons_on_resize = () => {
	document
		.querySelectorAll('.swiper')
		.forEach((slider) => throttle(it_toggle_slider_buttons(slider)));
};

export const it_init_woo_zoom = () => {
	if ($('body').hasClass('single-product')) {
		if (typeof wc_single_product_params === 'undefined') {
			return false;
		}

		if (wc_single_product_params.zoom_enabled) {
			$('.swiper-product-image .c-image').each(function () {
				const el = $(this);
				el.zoom({ url: el.attr('href') });
			});
		}
	}
};

export const it_init_slider_for_upsells_and_related = () => {
	document.querySelectorAll('.swiper-products').forEach((slider) => {
		new Swiper(slider, {
			spaceBetween: 10,
			breakpoints: {
				576: {
					slidesPerView: 2,
					spaceBetween: 20,
				},
				768: {
					slidesPerView: 3,
					spaceBetween: 30,
				},
				1025: {
					slidesPerView: 4,
				},
			},
			pagination: {
				el: slider.querySelector('.swiper-pagination'),
				clickable: true,
			},
			navigation: {
				nextEl: slider.querySelector('.swiper-button-next'),
				prevEl: slider.querySelector('.swiper-button-prev'),
			},
			on: {
				init() {
					slider.dataset.slides =
						slider.querySelectorAll('.swiper-slide').length;

					it_toggle_slider_buttons(slider);
				}, // lazy load images
				slideChange() {
					try {
						lazyLoadInstance.update();
					} catch (e) {}
				},
			},
		});
	});
};

export const it_configure_single_slider = () => {
	let swiperProductThumbs, swiperProductImage;

	// Get slider Product Thumbnails.
	const sliderProductThumbs = document.querySelector(
			'.swiper-product-thumbs'
		),
		sliderProductImage = document.querySelector('.swiper-product-image');

	// Initialize product sliders.
	if (sliderProductImage) {
		// Init slider for thumbnails.
		swiperProductThumbs = new Swiper(sliderProductThumbs, {
			spaceBetween: 20,
			slidesPerView: 3,
			watchSlidesProgress: true,
			breakpoints: {
				1025: {
					slidesPerView: 4,
				},
			},
			navigation: {
				nextEl: sliderProductThumbs.querySelector(
					'.swiper-button-next'
				),
				prevEl: sliderProductThumbs.querySelector(
					'.swiper-button-prev'
				),
			},
			on: {
				init() {
					sliderProductThumbs.dataset.slides =
						sliderProductThumbs.querySelectorAll(
							'.swiper-slide'
						).length;

					it_toggle_slider_buttons(sliderProductThumbs);
				}, // lazy load images
				slideChange() {
					try {
						lazyLoadInstance.update();
					} catch (e) {}
				},
			},
		});

		// Init slider for Images.
		swiperProductImage = new Swiper(sliderProductImage, {
			spaceBetween: 10,
			watchSlidesProgress: true,
			navigation: {
				nextEl: sliderProductImage.querySelector('.swiper-button-next'),
				prevEl: sliderProductImage.querySelector('.swiper-button-prev'),
			},
			thumbs: {
				swiper: swiperProductThumbs,
			},
			on: {
				init() {
					sliderProductImage.dataset.slides =
						sliderProductImage.querySelectorAll(
							'.swiper-slide'
						).length;
				}, // lazy load images
				slideChange() {
					try {
						lazyLoadInstance.update();
					} catch (e) {}
				},
			},
		});
	}

	// Work around product variations, manipulate sliders on variation change.
	if ($('form.variations_form').length) {
		const firstSlide = swiperProductImage.slides[0],
			firstSlideThumbs = swiperProductThumbs.slides[0];

		const firstSlideOriginal = {
			dataImageId: firstSlide.getAttribute('data-image-id'),
			href: firstSlide.querySelector('a').getAttribute('href'),
			src: firstSlide.querySelector('img').getAttribute('src'),
			srcset: firstSlide.querySelector('img').getAttribute('srcset'),
		};

		function resetFirstSlideToOriginal() {
			// slider product image:
			firstSlide.setAttribute(
				'data-image-id',
				firstSlideOriginal.dataImageId
			);
			firstSlide
				.querySelector('a')
				.setAttribute('href', firstSlideOriginal.href);
			firstSlide
				.querySelector('img')
				.setAttribute('src', firstSlideOriginal.src);
			firstSlide
				.querySelector('img')
				.setAttribute('srcset', firstSlideOriginal.srcset);

			// slider product thumbnails:
			firstSlideThumbs.setAttribute(
				'data-image-id',
				firstSlideOriginal.dataImageId
			);
			firstSlideThumbs
				.querySelector('img')
				.setAttribute('src', firstSlideOriginal.src);
			firstSlideThumbs
				.querySelector('img')
				.setAttribute('srcset', firstSlideOriginal.srcset);
		}

		$('input.variation_id').on('change', function () {
			if ('' !== $(this).val()) {
				const varID = $(this).val(),
					variations = JSON.parse(
						$('form.variations_form').attr(
							'data-product_variations'
						)
					),
					filteredData = variations.filter(
						(i) => i.variation_id == varID
					);

				if (Object.keys(filteredData).length !== 0) {
					let imgID = null;
					const varObj = filteredData[0];
					imgID = varObj.image_id;

					const slides = swiperProductImage.slides;
					let slideIndexGoTo = 0;
					slides.forEach((slide, i) => {
						if (slide.dataset.imageId == imgID) {
							slideIndexGoTo = i;
						}
					});

					if (slideIndexGoTo === 0) {
						// slider product image:
						firstSlide.setAttribute('data-image-id', imgID);
						firstSlide
							.querySelector('a')
							.setAttribute('href', varObj.image.url);
						firstSlide
							.querySelector('img')
							.setAttribute('src', varObj.image.src);
						firstSlide
							.querySelector('img')
							.setAttribute('srcset', varObj.image.srcset);

						// slider product thumbnails:
						firstSlideThumbs.setAttribute('data-image-id', imgID);
						firstSlideThumbs
							.querySelector('img')
							.setAttribute('src', varObj.image.thumb_src);
						firstSlideThumbs
							.querySelector('img')
							.setAttribute('srcset', varObj.image.srcset);
					}

					// change active slide
					swiperProductImage.slideTo(slideIndexGoTo);
				}
			} else {
				resetFirstSlideToOriginal();
			}
		});

		// reset variations
		$('.reset_variations').on('click', function (e) {
			$('.variations_form select').val('').niceSelect('update');
			if (
				firstSlide.getAttribute('data-image-id') !==
				firstSlideOriginal.dataImageId
			) {
				resetFirstSlideToOriginal();
			}
		});
	}
};

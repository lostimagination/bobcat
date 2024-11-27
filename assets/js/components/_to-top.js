'use strict';

export const it_toggle_to_top = () => {
	const toTop = document.getElementById('to-top');
	const mapWrapper = document.querySelector('.map-wrapper');
	const footer = document.querySelector('.site-footer');

	if (!toTop) {
		return;
	}

	const isOverSection = (element) => {
		if (!element) return false;

		const rect = element.getBoundingClientRect();
		const buttonRect = toTop.getBoundingClientRect();
		const windowHeight = window.innerHeight;

		return rect.top <= windowHeight && rect.bottom >= buttonRect.top;
	};

	if (window.scrollY > 300) {
		if (isOverSection(mapWrapper) || isOverSection(footer)) {
			toTop.classList.remove('show');
		} else {
			toTop.classList.add('show');
		}
	} else {
		toTop.classList.remove('show');
	}
};

export const it_click_to_top = () => {
	const toTop = document.getElementById('to-top');

	if (!toTop) {
		return;
	}

	toTop.addEventListener('click', () => {
		// Remove hash from url
		setTimeout(() => {
			history.replaceState(
				'',
				document.title,
				window.location.origin +
				window.location.pathname +
				window.location.search
			);
		}, 5);
	});
};

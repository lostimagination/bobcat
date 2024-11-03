'use strict';

export const it_toggle_to_top = () => {
	const toTop = document.getElementById('to-top');

	if (!toTop) {
		return;
	}

	if (window.scrollY > 300) {
		toTop.classList.add('show');
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

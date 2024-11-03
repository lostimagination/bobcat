'use strict';

import vars from '../_vars';

export const it_fix_full_height = () => {
	const vh = window.innerHeight * 0.01;
	vars.htmlEl.style.setProperty('--vh', `${vh}px`);
};

'use strict';

/*
 * Import Fancybox
 *
 * Import it even if it's not using in .js files.
 * It can be used via data-fancybox attributes.
 */
import { Fancybox } from '@fancyapps/ui';

export const it_fancybox = () => {
	Fancybox.bind('[data-fancybox]', {
		// Your custom options
	});
};

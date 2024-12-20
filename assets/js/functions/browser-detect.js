/**
 * Browser detection
 * @return {string}
 *
 * example: console.log(browserDetect());
 */

export const browserDetect = () => {
	const userAgent = navigator.userAgent;
	let browserName;

	if (userAgent.match(/chrome|chromium|crios/i)) {
		browserName = 'chrome';
	} else if (userAgent.match(/firefox|fxios/i)) {
		browserName = 'firefox';
	} else if (userAgent.match(/safari/i)) {
		browserName = 'safari';
	} else if (userAgent.match(/opr\//i)) {
		browserName = 'opera';
	} else if (userAgent.match(/edg/i)) {
		browserName = 'edge';
	} else {
		browserName = 'unknown';
	}

	return browserName;
};

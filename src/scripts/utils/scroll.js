import { html, body, scroll } from 'utils/environment';

/**
 * reset
 *
 * @param  positionX
 * @param  positionY
 * @public
 */
const reset = (positionX, positionY) => {
	// console.info('reset');

	if ('undefined' !== typeof positionX) {
		scroll.x = parseInt(positionX, 10);
	}

	if ('undefined' !== typeof positionY) {
		scroll.y = parseInt(positionY, 10);
	}

	window.scrollTo(scroll.x, scroll.y);
};

/**
 * disableScroll
 *
 * Lock scroll position, but retain settings for later
 *
 * @see  http://stackoverflow.com/a/3656618
 */
export function disableScroll() {
	// console.info('disableScroll');

	const documentElementScrollLeft = html.scrollLeft;
	const documentElementScrollTop = html.scrollTop;

	const bodyScrollLeft = body.scrollLeft;
	const bodyScrollTop = body.scrollTop;

	scroll.left = window.pageXOffset || documentElementScrollLeft || bodyScrollLeft;
	scroll.top = window.pageYOffset || documentElementScrollTop || bodyScrollTop;

	html.style.setProperty('overflow', 'hidden');
	html.style.setProperty('height', '100%');

	// eslint-disable-next-line
	reset(scroll.left, scroll.top);
}

/**
 * enableScroll
 *
 * @param  position
 */
export function enableScroll(position) {
	// console.info('enableScroll');

	let resumeScroll = true;
	let currentPosition = position;

	if ('undefined' === typeof currentPosition) {
		currentPosition = scroll.top;
	}

	if ('boolean' === typeof currentPosition && false === currentPosition) {
		resumeScroll = false;
	}

	// unlock scroll position
	// http://stackoverflow.com/a/3656618
	html.style.removeProperty('overflow');
	html.style.removeProperty('height');

	// resume scroll position if possible
	if (resumeScroll) {
		// eslint-disable-next-line
		reset(scroll.left, currentPosition);
	}
}

export const getPageYScroll = () => window.pageYOffset || document.documentElement.scrollTop;

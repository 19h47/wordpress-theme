const html = document.documentElement;
const { body } = document;
const isDebug = html.hasAttribute('data-debug');

const scroll = {
	y: 0,
	x: 0,
};

const breakpoints = {
	xs: window.matchMedia('(min-width: 0)'),
	sm: window.matchMedia('(min-width: 576px)'),
	md: window.matchMedia('(min-width: 768px)'),
	lg: window.matchMedia('(min-width: 992px)'),
	xl: window.matchMedia('(min-width: 1200px)'),
	xxl: window.matchMedia('(min-width: 1400px)'),
	'2xl': window.matchMedia('(min-width: 1600px)'),
	'3xl': window.matchMedia('(min-width: 1800px)'),
}

const production = 'production' === process.env.NODE_ENV;


export { html, body, isDebug, scroll, breakpoints, production };

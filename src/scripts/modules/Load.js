import { module as M } from '@19h47/modular';
import modularLoad from 'modularload';
import { body, html } from 'utils/environment';

class Load extends M {
	init() {
		// eslint-disable-next-line new-cap
		this.load = new modularLoad({});

		// eslint-disable-next-line no-unused-vars
		this.load.on('loading', (_, oldContainer) => {
			html.classList.remove('has-dom-ready');
			html.classList.add('is-loading');
			body.classList.add('cursor-wait');

			this.call('close', null, 'Nav', 'main');

			oldContainer.style.setProperty('opacity', '0.3');
		});

		this.load.on('loaded', (_, oldContainer, newContainer) => {

			html.classList.remove('is-loading');
			body.classList.remove('cursor-wait');

			this.call('destroy', oldContainer, 'app');

			newContainer.style.setProperty('opacity', '0');
			setTimeout(() => html.classList.add('has-dom-ready'), 0.7);
		});

		this.load.on('ready', (_, newContainer) => {
			this.call('update', newContainer, 'app');

			newContainer.style.setProperty('opacity', '1');
		});
	}

	goTo(href = '/') {
		this.load.goTo(href);
	}
}

export default Load;

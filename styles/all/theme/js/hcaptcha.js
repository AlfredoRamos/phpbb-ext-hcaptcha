/**
 * hCaptcha extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-2.0-only
 */

(() => {
	'use strict';

	// hCaptcha library must be defined first
	if (typeof window.hcaptcha === 'undefined') {
		return;
	}

	const widget = document.body.querySelector('.h-captcha');

	if (!widget) {
		return;
	}

	const form = widget.closest('form');

	if (!form) {
		return;
	}

	const button = form.querySelector('[type="submit"]');

	if (!button) {
		return;
	}

	button.addEventListener('click', (e) => {
		e.preventDefault();

		// Generate hCaptcha response
		window.hcaptcha.execute({async: true}).then((response) => {
			const captchaResponse = form.querySelector('[name="h-captcha-response"]');

			if (!captchaResponse) {
				return;
			}

			captchaResponse.value = response?.response || '';
		}).catch((error) => {
			console.error(error);
		}).finally(() => {
			// Submit form
			if (form.requestSubmit) {
				form.requestSubmit();
			} else {
				// Workaround for error "submit() is not a function" due to field being named "submit"
				HTMLFormElement.prototype.submit.call(form);
			}
		});
	});
})();

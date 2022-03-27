/**
 * hCaptcha extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-2.0-only
 */

(function() {
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

	// Solve hCaptcha challenge
	form.addEventListener('click', function(event) {
		if (!event.target.closest('[type="submit"]')) {
			return;
		}

		// Do not submit the form yet
		event.preventDefault();

		// Generate hCaptcha response
		window.hcaptcha.execute();

		// Submit form
		if (form.requestSubmit) {
			form.requestSubmit();
		} else {
			// Workaround for error "submit() is not a function" due to field being named "submit"
			HTMLFormElement.prototype.submit.call(form);
		}
	});
})();

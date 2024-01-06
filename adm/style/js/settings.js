/**
 * hCaptcha extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@skiff.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-2.0-only
 */

(function () {
	'use strict';

	// Toggle hCaptcha secret key
	document.body.addEventListener('click', function (e) {
		const toggle = e.target.closest('#toggle-hcaptcha-secret');

		if (!toggle) {
			return;
		}

		const field = document.body.querySelector('#hcaptcha-secret');
		const icon = toggle.querySelector('.icon');

		if (!field || !icon) {
			return;
		}

		const isHidden = field.getAttribute('type').trim() === 'password';

		// Toggle field type
		field.setAttribute('type', isHidden ? 'text' : 'password');

		// Toggle icon
		icon.classList.toggle('fa-eye-slash', isHidden);
		icon.classList.toggle('fa-eye', !isHidden);
	});
})();

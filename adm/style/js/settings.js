/**
 * hCaptcha extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-2.0-only
 */

(function() {
	'use strict';

	document.body.addEventListener('click', function(e) {
		let toggle = e.target.closest('#toggle-hcaptcha-secret');

		if (!toggle) {
			return;
		}

		let field = document.body.querySelector('#hcaptcha-secret');
		let icon = toggle.querySelector('.icon');

		if (!field || !icon) {
			return;
		}

		let isHidden = (field.getAttribute('type').trim() === 'password');

		// Toggle field type
		field.setAttribute('type', (isHidden ? 'text' : 'password'));

		// Toggle icon
		icon.classList.toggle('fa-eye-slash', isHidden);
		icon.classList.toggle('fa-eye', !isHidden);
	});
})();

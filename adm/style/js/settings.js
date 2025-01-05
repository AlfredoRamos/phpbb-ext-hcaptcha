/**
 * hCaptcha extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@proton.me>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-2.0-only
 */

(() => {
	'use strict';

	const debounce = (callback, wait) => {
		let timeout = null;

		return (...args) => {
			clearTimeout(timeout);
			timeout = setTimeout(() => callback?.apply(this, args), wait);
		};
	};

	const widget = document.body.querySelector('#h-captcha-preview');
	const loadPreview = debounce(() => {
		if (!widget) {
			return;
		}

		widget.innerHTML = '';
		window.hcaptcha.render('h-captcha-preview', {
			sitekey: widget.getAttribute('data-sitekey'),
			theme: widget.getAttribute('data-theme'),
			size: widget.getAttribute('data-size'),
		});
	}, 250);

	document.body
		.querySelector('#toggle-hcaptcha-secret')
		?.addEventListener('click', (e) => {
			const toggle = e.target.closest('#toggle-hcaptcha-secret');

			if (!toggle) {
				return;
			}

			const field = document.body.querySelector('#hcaptcha-secret');
			const icon = toggle?.querySelector('.icon');

			if (!field || !icon) {
				return;
			}

			const isHidden = field.getAttribute('type').trim() === 'password';
			field.setAttribute('type', isHidden ? 'text' : 'password');
			icon.classList.toggle('fa-eye-slash', isHidden);
			icon.classList.toggle('fa-eye', !isHidden);
		});

	document.body
		.querySelectorAll('#hcaptcha-theme,#hcaptcha-size')
		?.forEach((elem) => {
			if (!widget) {
				return;
			}

			elem?.addEventListener('change', (e) => {
				const attr = (e.target?.id ?? '')?.replace('hcaptcha', 'data');
				const value = e.target.value;

				if (!widget?.hasAttribute(attr) || !value) {
					return;
				}

				widget.setAttribute(attr, value);
				loadPreview();
			});
		});
})();

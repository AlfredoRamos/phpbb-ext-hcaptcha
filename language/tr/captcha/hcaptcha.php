<?php

/**
 * hCaptcha extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-2.0-only
 */

/**
 * @ignore
 */
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
 * @ignore
 */
if (empty($lang) || !is_array($lang))
{
	$lang = [];
}

$lang = array_merge($lang, [
	'CAPTCHA_HCAPTCHA' => 'hCaptcha',
	'CAPTCHA_HCAPTCHA_EXPLAIN' => 'Consult the <a href="https://www.phpbb.com/customise/db/extension/hcaptcha/faq" rel="external nofollow noreferrer noopener" target="_blank"><strong>FAQ</strong></a> for more information. If you require assistance, please visit the <a href="https://www.phpbb.com/customise/db/extension/hcaptcha/support" rel="external nofollow noreferrer noopener" target="_blank"><strong>Support</strong></a> section.',
	'HCAPTCHA_KEY' => 'Site key',
	'HCAPTCHA_KEY_EXPLAIN' => 'The site key generated on hCaptcha for your domain.',
	'HCAPTCHA_SECRET' => 'Secret key',
	'HCAPTCHA_SECRET_EXPLAIN' => 'The secret key generated on your hCaptcha account.',
	'HCAPTCHA_THEME' => 'Theme',
	'HCAPTCHA_THEME_EXPLAIN' => 'The color theme of the hCaptcha widget.',
	'HCAPTCHA_THEME_LIGHT' => 'Light',
	'HCAPTCHA_THEME_DARK' => 'Dark',
	'HCAPTCHA_SIZE' => 'Size',
	'HCAPTCHA_SIZE_EXPLAIN' => 'The size of the hCaptcha widget.',
	'HCAPTCHA_SIZE_NORMAL' => 'Normal',
	'HCAPTCHA_SIZE_COMPACT' => 'Compact',
	'HCAPTCHA_NOT_AVAILABLE' => 'In order to use hCaptcha, you must create an account on <a href="https://www.hcaptcha.com/" rel="external nofollow noreferrer noopener" target="_blank">www.hcaptcha.com</a>.',
	'HCAPTCHA_INCORRECT' => 'The solution you provided was incorrect.',
	'HCAPTCHA_NOSCRIPT' => 'Please enable JavaScript in your browser to load the challenge.',
	'HCAPTCHA_LOGIN_ERROR_ATTEMPTS' => 'You have exceeded the maximum number of login attempts allowed.<br>In addition to your username and password, hCaptcha will be used to authenticate your session.',
	'HCAPTCHA_REQUEST_EXCEPTION' => 'hCaptcha request error: %s',

	'ACP_HCAPTCHA_TOGGLE_SECRET' => 'Toggle %s',
	'ACP_HCAPTCHA_VALIDATE_INVALID_FIELDS' => 'Invalid values for fields: <samp>%s</samp>'
]);

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
	'HCAPTCHA_SECRET' => 'Secret key',
	'HCAPTCHA_THEME' => 'Theme',
	'HCAPTCHA_THEMES_LIGHT' => 'Light',
	'HCAPTCHA_THEMES_DARK' => 'Dark',
	'HCAPTCHA_SIZE' => 'Size',
	'HCAPTCHA_SIZES_NORMAL' => 'Normal',
	'HCAPTCHA_SIZES_COMPACT' => 'Compact',
	'HCAPTCHA_NOT_AVAILABLE' => 'In order to use hCaptcha, you must create an account on <a href="https://www.hcaptcha.com/" rel="external nofollow noreferrer noopener" target="_blank">www.hcaptcha.com</a>.',
	'HCAPTCHA_INCORRECT' => 'The solution you provided was incorrect.',
	'HCAPTCHA_NOSCRIPT' => 'Please enable JavaScript in your browser to load the challenge.',

	'ACP_HCAPTCHA_VALIDATE_INVALID_FIELDS' => 'Invalid values for fields: <samp>%s</samp>'
]);

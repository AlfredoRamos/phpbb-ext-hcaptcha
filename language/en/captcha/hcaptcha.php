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
	'HCAPTCHA_KEY' => 'Site key',
	'HCAPTCHA_SECRET' => 'Secret key',
	'HCAPTCHA_NOT_AVAILABLE' => 'In order to use hCaptcha, you must create an account on <a href="https://www.hcaptcha.com/" target="_blank" rel="noreferrer noopener">www.hcaptcha.com</a>.',
	'HCAPTCHA_INCORRECT' => 'The solution you provided was incorrect.'
]);

<?php

/**
 * hCaptcha extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@proton.me>
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
	'CAPTCHA_HCAPTCHA_EXPLAIN' => 'Podrobnosti najdete v <a href="https://www.phpbb.com/customise/db/extension/hcaptcha/faq" rel="external nofollow noreferrer noopener" target="_blank"><strong>často kladených otázkách</strong></a>. Pokud potebujete pomoc, navštivte sekci <a href="https://www.phpbb.com/customise/db/extension/hcaptcha/support" rel="external nofollow noreferrer noopener" target="_blank"><strong>Support</strong></a>.',
	'HCAPTCHA_KEY' => 'Klíč webu',
	'HCAPTCHA_KEY_EXPLAIN' => 'Klíč vygenerovaný od hCaptcha pro vaši doménu.',
	'HCAPTCHA_SECRET' => 'Tajný klíč',
	'HCAPTCHA_SECRET_EXPLAIN' => 'Tajný klíč vygenerovaný pro váš účet hCaptcha.',
	'HCAPTCHA_THEME' => 'Téma vzhledu',
	'HCAPTCHA_THEME_EXPLAIN' => 'Barva vzhledu widgetu hCaptcha.',
	'HCAPTCHA_THEME_LIGHT' => 'Světlý',
	'HCAPTCHA_THEME_DARK' => 'Tmavý',
	'HCAPTCHA_SIZE' => 'Velikost',
	'HCAPTCHA_SIZE_EXPLAIN' => 'Velikost widgetu hCaptcha.',
	'HCAPTCHA_SIZE_NORMAL' => 'Normální',
	'HCAPTCHA_SIZE_COMPACT' => 'Kompaktní',
	'HCAPTCHA_NOT_AVAILABLE' => 'Pro používání služby hCaptcha si nejprve vytvořte účet na <a href="https://www.hcaptcha.com/" rel="external nofollow noreferrer noopener" target="_blank">www.hcaptcha.com</a>.',
	'HCAPTCHA_INCORRECT' => 'Zadali jste nesprávné řešení.',
	'HCAPTCHA_NOSCRIPT' => 'Povolte ve svém prohlížeči JavaScript pro načtení hCaptcha.',
	'HCAPTCHA_LOGIN_ERROR_ATTEMPTS' => 'Překročili jste maximální počet pokusů o přihlášení.<br>Pro ověření vaší relace vyplňte kromě svého uživatelského jména a hesla také hCaptcha.',
	'HCAPTCHA_REQUEST_EXCEPTION' => 'Chyba požadavku hCaptcha: %s',

	'ACP_HCAPTCHA_TOGGLE_SECRET' => 'Přepnout zobrazení %s',
	'ACP_HCAPTCHA_VALIDATE_INVALID_FIELDS' => 'Neplatné hodnoty pro pole: <samp>%s</samp>'
]);

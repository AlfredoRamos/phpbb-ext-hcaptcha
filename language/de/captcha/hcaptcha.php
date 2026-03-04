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
	'CAPTCHA_HCAPTCHA_EXPLAIN' => '<p>Consult the <a href="%1$s" rel="external nofollow noreferrer noopener" target="_blank"><strong>FAQ</strong></a> for more information. If you require assistance, please visit the <a href="%2$s" rel="external nofollow noreferrer noopener" target="_blank"><strong>Support</strong></a> section.</p><p>If you like or found this extension useful and want to show some appreciation, you can consider supporting its development by <a href="%3$s" rel="external nofollow noreferrer noopener" target="_blank"><strong>giving a donation</strong></a>.</p>',
	'HCAPTCHA_KEY' => 'Sitekey',
	'HCAPTCHA_KEY_EXPLAIN' => 'Der Sitekey, der auf hCaptcha für Ihre Domain generiert wurde.',
	'HCAPTCHA_SECRET' => 'Geheimer Schlüssel',
	'HCAPTCHA_SECRET_EXPLAIN' => 'Der in Ihrem hCaptcha‑Konto generierte geheime Schlüssel.',
	'HCAPTCHA_THEME' => 'Thema',
	'HCAPTCHA_THEME_EXPLAIN' => 'Das Farbschema des hCaptcha-Widgets.',
	'HCAPTCHA_THEME_LIGHT' => 'Hell',
	'HCAPTCHA_THEME_DARK' => 'Dunkel',
	'HCAPTCHA_SIZE' => 'Größe',
	'HCAPTCHA_SIZE_EXPLAIN' => 'Die Größe des hCaptcha-Widgets.',
	'HCAPTCHA_SIZE_NORMAL' => 'Normal',
	'HCAPTCHA_SIZE_COMPACT' => 'Kompakt',
	'HCAPTCHA_FORCE_LOGIN' => 'Force spambot countermeasures in logins',
	'HCAPTCHA_FORCE_LOGIN_EXPLAIN' => 'Requires users to always pass the anti-spambot task to help prevent automated logins.',
	'HCAPTCHA_NOT_AVAILABLE' => 'Um hCaptcha nutzen zu können, müssen Sie ein Konto bei <a href="https://www.hcaptcha.com/" rel="external nofollow noreferrer noopener" target="_blank">www.hcaptcha.com</a> erstellen.',
	'HCAPTCHA_INCORRECT' => 'Die von Ihnen eingegebene Lösung war falsch.',
	'HCAPTCHA_NOSCRIPT' => 'Bitte aktivieren Sie JavaScript in Ihrem Browser, um die Challenge zu laden.',
	'HCAPTCHA_LOGIN_ERROR_ATTEMPTS' => 'Sie haben die maximal zulässige Anzahl an Anmeldeversuchen überschritten.<br>Zusätzlich zu Ihrem Benutzernamen und Passwort wird hCaptcha zur Authentifizierung Ihrer Sitzung verwendet.',
	'HCAPTCHA_REQUEST_EXCEPTION' => 'hCaptcha Anforderungsfehler: %s',

	'ACP_HCAPTCHA_TOGGLE_SECRET' => '%s umschalten',
	'ACP_HCAPTCHA_VALIDATE_INVALID_FIELDS' => 'Ungültige Werte für Felder: <samp>%s</samp>'
]);

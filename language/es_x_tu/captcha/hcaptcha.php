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
	'HCAPTCHA_KEY' => 'Clave del sitio',
	'HCAPTCHA_KEY_EXPLAIN' => 'La clave del sitio generada en hCaptcha para tu dominio.',
	'HCAPTCHA_SECRET' => 'Clave secreta',
	'HCAPTCHA_SECRET_EXPLAIN' => 'La clave secreta generada en tu cuenta hCaptcha.',
	'HCAPTCHA_THEME' => 'Tema',
	'HCAPTCHA_THEME_EXPLAIN' => 'El color del widget de hCaptcha.',
	'HCAPTCHA_THEME_LIGHT' => 'Claro',
	'HCAPTCHA_THEME_DARK' => 'Obscuro',
	'HCAPTCHA_SIZE' => 'Tamaño',
	'HCAPTCHA_SIZE_EXPLAIN' => 'El tamaño del widget de hCapcha.',
	'HCAPTCHA_SIZE_NORMAL' => 'Normal',
	'HCAPTCHA_SIZE_COMPACT' => 'Compacto',
	'HCAPTCHA_FORCE_LOGIN' => 'Force spambot countermeasures in logins',
	'HCAPTCHA_FORCE_LOGIN_EXPLAIN' => 'Requires users to always pass the anti-spambot task to help prevent automated logins.',
	'HCAPTCHA_NOT_AVAILABLE' => 'Para poder utilizar hCaptcha, debes crear una cuenta en <a href="https://www.hcaptcha.com/" rel="external nofollow noreferrer noopener" target="_blank">www.hcaptcha.com</a>.',
	'HCAPTCHA_INCORRECT' => 'La solución que proporcionaste es incorrecta.',
	'HCAPTCHA_NOSCRIPT' => 'Por favor, habilita JavaScript en tu navegador web para cargar el desafío.',
	'HCAPTCHA_LOGIN_ERROR_ATTEMPTS' => 'Has superado el número máximo de intentos de inicio de sesión permitidos.<br>Además de tu nombre de usuario y contraseña, se utilizará hCaptcha para autenticar tu sesión.',
	'HCAPTCHA_REQUEST_EXCEPTION' => 'Error de solicitud de hCaptcha: %s',

	'ACP_HCAPTCHA_TOGGLE_SECRET' => 'Alternar visibilidad de %s',
	'ACP_HCAPTCHA_VALIDATE_INVALID_FIELDS' => 'Valores inválidos para los campos: <samp>%s</samp>'
]);

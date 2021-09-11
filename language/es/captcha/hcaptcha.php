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
	'CAPTCHA_HCAPTCHA_EXPLAIN' => 'Consulte las <a href="https://www.phpbb.com/customise/db/extension/hcaptcha/faq" rel="external nofollow noreferrer noopener" target="_blank"><strong>Preguntas Frecuentes</strong></a> para obtener más información. Si requiere de ayuda, por favor visite la sección de <a href="https://www.phpbb.com/customise/db/extension/hcaptcha/support" rel="external nofollow noreferrer noopener" target="_blank"><strong>Soporte</strong></a>.',
	'HCAPTCHA_KEY' => 'Clave del sitio',
	'HCAPTCHA_KEY_EXPLAIN' => 'La clave del sitio generada en hCaptcha para su dominio.',
	'HCAPTCHA_SECRET' => 'Clave secreta',
	'HCAPTCHA_SECRET_EXPLAIN' => 'La clave secreta generada en su cuenta hCaptcha.',
	'HCAPTCHA_THEME' => 'Tema',
	'HCAPTCHA_THEME_EXPLAIN' => 'El color del widget de hCaptcha.',
	'HCAPTCHA_THEME_LIGHT' => 'Claro',
	'HCAPTCHA_THEME_DARK' => 'Obscuro',
	'HCAPTCHA_SIZE' => 'Tamaño',
	'HCAPTCHA_SIZE_EXPLAIN' => 'El tamaño del widget de hCapcha.',
	'HCAPTCHA_SIZE_NORMAL' => 'Normal',
	'HCAPTCHA_SIZE_COMPACT' => 'Compacto',
	'HCAPTCHA_NOT_AVAILABLE' => 'Para poder utilizar hCaptcha, debe crear una cuenta en <a href="https://www.hcaptcha.com/" rel="external nofollow noreferrer noopener" target="_blank">www.hcaptcha.com</a>.',
	'HCAPTCHA_INCORRECT' => 'La solución que proporcionó es incorrecta.',
	'HCAPTCHA_NOSCRIPT' => 'Por favor, habilite JavaScript en su navegador web para cargar el desafío.',

	'ACP_HCAPTCHA_TOGGLE_SECRET' => 'Alternar visibilidad de %s',
	'ACP_HCAPTCHA_VALIDATE_INVALID_FIELDS' => 'Valores inválidos para los campos: <samp>%s</samp>'
]);

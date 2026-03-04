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
	'HCAPTCHA_KEY' => 'Ключ сайта',
	'HCAPTCHA_KEY_EXPLAIN' => 'Ключ сайта сгенерирован на hCaptcha для вашего домена.',
	'HCAPTCHA_SECRET' => 'Секретный ключ',
	'HCAPTCHA_SECRET_EXPLAIN' => 'Секретный ключ, созданный на вашем аккаунте hCaptcha.',
	'HCAPTCHA_THEME' => 'Тема',
	'HCAPTCHA_THEME_EXPLAIN' => 'Цветовая тема виджета hCaptcha.',
	'HCAPTCHA_THEME_LIGHT' => 'Светлая',
	'HCAPTCHA_THEME_DARK' => 'Тёмная',
	'HCAPTCHA_SIZE' => 'Размер',
	'HCAPTCHA_SIZE_EXPLAIN' => 'Размер виджета hCaptcha.',
	'HCAPTCHA_SIZE_NORMAL' => 'Обычный',
	'HCAPTCHA_SIZE_COMPACT' => 'Компактный',
	'HCAPTCHA_FORCE_LOGIN' => 'Force spambot countermeasures in logins',
	'HCAPTCHA_FORCE_LOGIN_EXPLAIN' => 'Requires users to always pass the anti-spambot task to help prevent automated logins.',
	'HCAPTCHA_NOT_AVAILABLE' => 'Чтобы использовать hCaptcha, необходимо создать учетную запись на сайте <a href="https://www.hcaptcha.com/" rel="external nofollow noreferrer noopener" target="_blank">www.hcaptcha.com</a>.',
	'HCAPTCHA_INCORRECT' => 'Вы указали неправильное решение.',
	'HCAPTCHA_NOSCRIPT' => 'Для загрузки включите JavaScript в вашем браузере.',
	'HCAPTCHA_LOGIN_ERROR_ATTEMPTS' => 'Вы превысили максимально допустимое количество попыток входа.<br>В дополнение к вашему логину и паролю будет использоваться hCaptcha.',
	'HCAPTCHA_REQUEST_EXCEPTION' => 'Ошибка запроса hCaptcha: %s',

	'ACP_HCAPTCHA_TOGGLE_SECRET' => 'Переключатель %s',
	'ACP_HCAPTCHA_VALIDATE_INVALID_FIELDS' => 'Недопустимые значения для полей: <samp>%s</samp>'
]);

<?php

/**
 * hCaptcha extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@skiff.com>
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
	'CAPTCHA_HCAPTCHA_EXPLAIN' => 'Daha fazla bilgi için <a href="https://www.phpbb.com/customise/db/extension/hcaptcha/faq" rel="external nofollow noreferrer noopener" target="_blank"><strong>FAQ</strong></a>\'e bakınız. Yardıma ihtiyacınız varsa lütfen <a href="https://www.phpbb.com/customise/db/extension/hcaptcha/support" rel="external nofollow noreferrer noopener" target="_blank"><strong>Destek</strong></a> bölümünü ziyaret edin.',
	'HCAPTCHA_KEY' => 'Site anahtarı',
	'HCAPTCHA_KEY_EXPLAIN' => 'Alan adınız için hCaptcha\'da oluşturulan site anahtarı.',
	'HCAPTCHA_SECRET' => 'Gizli anahtar',
	'HCAPTCHA_SECRET_EXPLAIN' => 'hCaptcha hesabınızda oluşturulan gizli anahtar.',
	'HCAPTCHA_THEME' => 'Tema',
	'HCAPTCHA_THEME_EXPLAIN' => 'hCaptcha widget\'ının renk teması.',
	'HCAPTCHA_THEME_LIGHT' => 'Açık',
	'HCAPTCHA_THEME_DARK' => 'Koyu',
	'HCAPTCHA_SIZE' => 'Boyut',
	'HCAPTCHA_SIZE_EXPLAIN' => 'hCaptcha widget\'ının boyutu.',
	'HCAPTCHA_SIZE_NORMAL' => 'Normal',
	'HCAPTCHA_SIZE_COMPACT' => 'Kompakt',
	'HCAPTCHA_NOT_AVAILABLE' => 'hCaptcha kullanmak için <a href="https://www.hcaptcha.com/" rel="external nofollow noreferrer noopener" target="_blank">www.hcaptcha.com</a> sitesinde bir hesap oluşturmalısınız.',
	'HCAPTCHA_INCORRECT' => 'Sağladığınız çözüm yanlıştı.',
	'HCAPTCHA_NOSCRIPT' => 'Lütfen meydan okumayı yüklemek için tarayıcınızda JavaScript\'i etkinleştirin.',
	'HCAPTCHA_LOGIN_ERROR_ATTEMPTS' => 'İzin verilen maksimum giriş denemesi sayısını aştınız.<br>Kullanıcı adınıza ve şifrenize ek olarak, oturumunuzun kimliğini doğrulamak için hCaptcha kullanılacaktır.',
	'HCAPTCHA_REQUEST_EXCEPTION' => 'hCaptcha istek hatası: %s',

	'ACP_HCAPTCHA_TOGGLE_SECRET' => 'Aç/kapat %s',
	'ACP_HCAPTCHA_VALIDATE_INVALID_FIELDS' => 'Şu alanlar için geçersiz değerler: <samp>%s</samp>'
]);

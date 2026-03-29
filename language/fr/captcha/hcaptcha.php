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
	'HCAPTCHA_KEY' => 'Clé de site',
	'HCAPTCHA_KEY_EXPLAIN' => 'Clé de site générée sur hCaptcha pour votre domaine.',
	'HCAPTCHA_SECRET' => 'Clé secrète',
	'HCAPTCHA_SECRET_EXPLAIN' => 'Clé secrète générée sur votre compte hCaptcha.',
	'HCAPTCHA_THEME' => 'Thème',
	'HCAPTCHA_THEME_EXPLAIN' => 'Thème de couleur du widget hCaptcha.',
	'HCAPTCHA_THEME_LIGHT' => 'Clair',
	'HCAPTCHA_THEME_DARK' => 'Sombre',
	'HCAPTCHA_SIZE' => 'Taille',
	'HCAPTCHA_SIZE_EXPLAIN' => 'Taille du widget hCaptcha.',
	'HCAPTCHA_SIZE_NORMAL' => 'Normale',
	'HCAPTCHA_SIZE_COMPACT' => 'Compacte',
	'HCAPTCHA_FORCE_LOGIN' => 'Force spambot countermeasures in logins',
	'HCAPTCHA_FORCE_LOGIN_EXPLAIN' => 'Requires users to always pass the anti-spambot task to help prevent automated logins.',
	'HCAPTCHA_NOT_AVAILABLE' => 'Pour utiliser hCaptcha, vous devez créer un compte sur <a href="https://www.hcaptcha.com/" rel="external nofollow noreferrer noopener" title="S’ouvre dans un nouvel onglet" target="_blank">www.hcaptcha.com</a>.',
	'HCAPTCHA_INCORRECT' => 'La solution que vous avez indiquée est incorrecte.',
	'HCAPTCHA_NOSCRIPT' => 'Veuillez activer JavaScript dans votre navigateur pour charger le test.',
	'HCAPTCHA_LOGIN_ERROR_ATTEMPTS' => 'Vous avez dépassé le nombre maximum de tentatives de connexion autorisées.<br>En plus de votre nom d’utilisateur et de votre mot de passe, hCaptcha sera utilisé pour authentifier votre session.',
	'HCAPTCHA_REQUEST_EXCEPTION' => 'Erreur de requête hCaptcha : %s',

	'ACP_HCAPTCHA_TOGGLE_SECRET' => 'Afficher/Masquer la %s',
	'ACP_HCAPTCHA_VALIDATE_INVALID_FIELDS' => 'Valeurs invalides pour les champs : <samp>%s</samp>'
]);

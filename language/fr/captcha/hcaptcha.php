<?php

/**
 * hCaptcha extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@protonmail.com>
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
	'CAPTCHA_HCAPTCHA_EXPLAIN' => 'Consultez la <a href="https://www.phpbb.com/customise/db/extension/hcaptcha/faq" rel="external nofollow noreferrer noopener" title="S’ouvre dans un nouvel onglet" target="_blank"><strong>FAQ</strong></a> pour plus d’informations. Si vous avez besoin d’aide, veuillez vous rendre dans la section de <a href="https://www.phpbb.com/customise/db/extension/hcaptcha/support" rel="external nofollow noreferrer noopener" title="S’ouvre dans un nouvel onglet" target="_blank"><strong>support</strong></a>.',
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
	'HCAPTCHA_NOT_AVAILABLE' => 'Pour utiliser hCaptcha, vous devez créer un compte sur <a href="https://www.hcaptcha.com/" rel="external nofollow noreferrer noopener" title="S’ouvre dans un nouvel onglet" target="_blank">www.hcaptcha.com</a>.',
	'HCAPTCHA_INCORRECT' => 'La solution que vous avez indiquée est incorrecte.',
	'HCAPTCHA_NOSCRIPT' => 'Veuillez activer JavaScript dans votre navigateur pour charger le test.',
	'HCAPTCHA_LOGIN_ERROR_ATTEMPTS' => 'Vous avez dépassé le nombre maximum de tentatives de connexion autorisées.<br>En plus de votre nom d’utilisateur et de votre mot de passe, hCaptcha sera utilisé pour authentifier votre session.',
	'HCAPTCHA_REQUEST_EXCEPTION' => 'Erreur de requête hCaptcha : %s',

	'ACP_HCAPTCHA_TOGGLE_SECRET' => 'Afficher/Masquer la %s',
	'ACP_HCAPTCHA_VALIDATE_INVALID_FIELDS' => 'Valeurs invalides pour les champs : <samp>%s</samp>'
]);

<?php

/**
 * hCaptcha extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\hcaptcha\captcha\plugins;

use phpbb\captcha\plugins\captcha_abstract;
use phpbb\config\config;
use phpbb\user;
use phpbb\request\request;
use phpbb\template\template;
use phpbb\language\language;
use phpbb\log\log;

class hcaptcha extends captcha_abstract
{
	const HCAPTCHA = 'hcaptcha.com';

	protected $config;
	protected $user;
	protected $request;
	protected $template;
	protected $language;
	protected $log;
	protected $root_path;
	protected $php_ext;

	protected static $actions = [
		0				=> 'default',
		CONFIRM_REG		=> 'register',
		CONFIRM_LOGIN	=> 'login',
		CONFIRM_POST	=> 'post',
		CONFIRM_REPORT	=> 'report'
	];

	public function __construct(config $config, user $user, request $request, template $template, language $language, log $log, $root_path, $php_ext)
	{
		$this->config = $config;
		$this->user = $user;
		$this->request = $request;
		$this->template = $template;
		$this->language = $language;
		$this->log = $log;
		$this->root_path = $root_path;
		$this->php_ext = $php_ext;
	}

	public static function get_actions()
	{
		return self::$actions;
	}

	public function execute_demo()
	{
	}

	public function get_generator_class()
	{
		throw new \Exception('No generator class given.');
	}

	public function get_name()
	{
		return 'CAPTCHA_HCAPTCHA';
	}

	public function has_config()
	{
		return true;
	}

	public function init($type)
	{
		$this->language->add_lang('captcha/hcaptcha', 'alfredoramos/hcaptcha');
		parent::init($type);
	}

	public function is_available()
	{
		$this->language->add_lang('captcha/hcaptcha', 'alfredoramos/hcaptcha');

		return (
			!empty($this->config['hcaptcha_key']) &&
			!empty($this->config['hcaptcha_secret'])
		);
	}

	public function acp_page($id, $module)
	{
		$module->tpl_name = '@alfredoramos_hcaptcha/acp_captcha_hcaptcha';
		$module->page_title = 'ACP_VC_SETTINGS';

		$form_key = 'acp_captcha';
		add_form_key($form_key);

		if ($this->request->is_set_post('submit'))
		{
			if (!check_form_key($form_key))
			{
				trigger_error($this->language->lang('FORM_INVALID') . adm_back_link($module->u_action), E_USER_WARNING);
			}

			$this->config->set('hcaptcha_key', $this->request->variable('hcaptcha_key', '', true));
			$this->config->set('hcaptcha_secret', $this->request->variable('hcaptcha_secret', '', true));

			foreach (self::$actions as $action)
			{
				$key = sprintf('hcaptcha_threshold_%s', $action);
				$this->config->set($key, $this->request->variable($key, 0.50));
			}

			$this->log->add(
				'admin',
				$this->user->data['user_id'],
				$this->user->ip,
				'LOG_CONFIG_VISUAL'
			);

			trigger_error($this->language->lang('CONFIG_UPDATED') . adm_back_link($module->u_action));
		}

		foreach (self::$actions as $action)
		{
			$key = sprintf('hcaptcha_threshold_%s', $action);
			$this->template->assign_block_vars('thresholds', [
				'key'	=> $key,
				'value'	=> $this->config[$key] ?? 0.5
			]);
		}

		$this->template->assign_vars([
			'U_ACTION'			=> $module->u_action,

			'CAPTCHA_NAME'		=> $this->get_service_name(),
			'CAPTCHA_PREVIEW'	=> $this->get_demo_template($id),

			'HCAPTCHA_KEY'		=> $this->config['hcaptcha_key'],
			'HCAPTCHA_SECRET'	=> $this->config['hcaptcha_secret']
		]);
	}

	public function get_demo_template($id)
	{
		return $this->get_template();
	}

	public function get_template()
	{
		if ($this->is_solved())
		{
			return false;
		}

		$contact = phpbb_get_board_contact_link(
			$this->config,
			$this->root_path,
			$this->php_ext
		);
		$explain = $this->type !== CONFIRM_POST ? 'CONFIRM_EXPLAIN' : 'POST_CONFIRM_EXPLAIN';
		$domain = self::HCAPTCHA;
		$render = $this->config['hcaptcha_key'];

		$this->template->assign_vars([
			'CONFIRM_EXPLAIN'		=> $this->language->lang($explain, '<a href="' . $contact . '">', '</a>'),

			'HCAPTCHA_ACTION'		=> self::$actions[$this->type] ?? reset(self::$actions),
			'HCAPTCHA_KEY'			=> $this->config['hcaptcha_key'],
			'U_HCAPTCHA_SCRIPT'		=> sprintf('https://js.%s/1/api.js', $domain),
			'S_HCAPTCHA_AVAILABLE'	=> $this->is_available(),

			'S_CONFIRM_CODE'		=> true,
			'S_TYPE'				=> $this->type
		]);

		return '@alfredoramos_hcaptcha/captcha_hcaptcha.html';
	}

	public function validate()
	{
		if (!parent::validate())
		{
			return false;
		}

		return $this->hcaptcha_verify_token();
	}

	protected function hcaptcha_verify_token()
	{
		$token		= $this->request->variable('hcaptcha_token', '', true);
		$action		= $this->request->variable('hcaptcha_action', '', true);
		$action		= in_array($action, self::$actions) ? $action : reset(self::$actions);
		$threshold	= (double) $this->config[sprintf('hcaptcha_threshold_%s', $action)] ?? 0.5;

		if (empty($token))
		{
			return $this->language->lang('HCAPTCHA_INCORRECT');
		}

		return $this->language->lang('HCAPTCHA_INCORRECT');
	}

	public function get_login_error_attempts(): string
	{
		$this->language->add_lang('captcha/hcaptcha', 'alfredoramos/hcaptcha');

		return 'HCAPTCHA_LOGIN_ERROR_ATTEMPTS';
	}
}

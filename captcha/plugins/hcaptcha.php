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
use alfredoramos\hcaptcha\includes\helper;
use GuzzleHttp\Client as HttpClient;

class hcaptcha extends captcha_abstract
{
	protected $config;
	protected $user;
	protected $request;
	protected $template;
	protected $language;
	protected $log;
	protected $helper;
	protected $root_path;
	protected $php_ext;

	public function __construct(config $config, user $user, request $request, template $template, language $language, log $log, helper $helper, $root_path, $php_ext)
	{
		$this->config = $config;
		$this->user = $user;
		$this->request = $request;
		$this->template = $template;
		$this->language = $language;
		$this->log = $log;
		$this->helper = $helper;
		$this->root_path = $root_path;
		$this->php_ext = $php_ext;
	}

	public function execute()
	{
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

		$allowed = [
			'themes'	=> ['light', 'dark'],
			'sizes'	=> ['normal', 'compact']
		];

		$errors = [];

		$filters = [
			'hcaptcha_key' => [
				'filter' => FILTER_VALIDATE_REGEXP,
				'options' => [
					'regexp' => '#^[a-f0-9]{8}\-[a-f0-9]{4}\-[a-f0-9]{4}\-[a-f0-9]{4}\-[a-f0-9]{12}$#'
				]
			],
			'hcaptcha_secret' => [
				'filter' => FILTER_VALIDATE_REGEXP,
				'options' => [
					'regexp' => '#^0x[a-fA-F0-9]{40}$#'
				]
			],
			'hcaptcha_theme' => [
				'filter' => FILTER_VALIDATE_REGEXP,
				'options' => [
					'regexp' => '#^(?:' . implode('|', $allowed['themes']) . ')?$#'
				]
			],
			'hcaptcha_size' => [
				'filter' => FILTER_VALIDATE_REGEXP,
				'options' => [
					'regexp' => '#^(?:' . implode('|', $allowed['sizes']) . ')?$#'
				]
			]
		];

		if ($this->request->is_set_post('submit'))
		{
			if (!check_form_key($form_key))
			{
				trigger_error($this->language->lang('FORM_INVALID') . adm_back_link($module->u_action), E_USER_WARNING);
			}

			$fields = [
				'hcaptcha_key' => $this->request->variable('hcaptcha_key', ''),
				'hcaptcha_secret' => $this->request->variable('hcaptcha_secret', ''),
				'hcaptcha_theme' => $this->request->variable('hcaptcha_theme', ''),
				'hcaptcha_size' => $this->request->variable('hcaptcha_size', '')
			];

			if ($this->helper->validate($fields, $filters, $errors))
			{
				foreach ($fields as $key => $value)
				{
					$this->config->set($key, $value);
				}

				$this->log->add(
					'admin',
					$this->user->data['user_id'],
					$this->user->ip,
					'LOG_CONFIG_VISUAL'
				);

				trigger_error(
					$this->language->lang('CONFIG_UPDATED') .
					adm_back_link($module->u_action)
				);
			}

		}

		$this->template->assign_vars([
			'U_ACTION'			=> $module->u_action,

			'CAPTCHA_NAME'		=> $this->get_service_name(),
			'CAPTCHA_PREVIEW'	=> $this->get_demo_template($id),

			'HCAPTCHA_KEY'		=> $this->config['hcaptcha_key'],
			'HCAPTCHA_SECRET'	=> $this->config['hcaptcha_secret']
		]);

		foreach ($allowed as $key => $value)
		{
			$block_var = sprintf('HCAPTCHA_%s', strtoupper($key));

			foreach ($value as $val)
			{
				$this->template->assign_block_vars($block_var, [
					'KEY' => $val,
					'NAME' => $this->language->lang(sprintf(
						'HCAPTCHA_%1$s_%2$s',
						strtoupper($key),
						strtoupper($val)
					)),
					'ENABLED' => ($this->config['hcaptcha_theme'] === $val)
				]);
			}
		}

		foreach ($errors as $error)
		{
			$this->template->assign_block_vars('VALIDATION_ERRORS', [
				'MESSAGE' => $error['message']
			]);
		}
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
		$render = $this->config['hcaptcha_key'];

		$this->template->assign_vars([
			'CONFIRM_EXPLAIN'		=> $this->language->lang($explain, '<a href="' . $contact . '">', '</a>'),

			'HCAPTCHA_KEY'			=> $this->config['hcaptcha_key'],
			'U_HCAPTCHA_SCRIPT'		=> 'https://js.hcaptcha.com/1/api.js',
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
		$result = $this->request->variable('h-captcha-response', '', true);

		if (empty($result))
		{
			return $this->language->lang('HCAPTCHA_INCORRECT');
		}

		$client = new HttpClient([
			'base_uri' => 'https://hcaptcha.com'
		]);

		$response = $client->request('POST', '/siteverify', [
			'form_params' => [
				'sitekey'	=> $this->config['hcaptcha_key'],
				'secret'	=> $this->config['hcaptcha_secret'],
				'response'	=> $result,
				'remoteip'	=> $this->user->ip
			]
		]);

		$data = json_decode($response->getBody()->getContents());

		if ($data->success === true)
		{
			$this->solved = true;
			return false;
		}

		return $this->language->lang('HCAPTCHA_INCORRECT');
	}

	public function get_login_error_attempts(): string
	{
		$this->language->add_lang('captcha/hcaptcha', 'alfredoramos/hcaptcha');
		return 'HCAPTCHA_LOGIN_ERROR_ATTEMPTS';
	}
}

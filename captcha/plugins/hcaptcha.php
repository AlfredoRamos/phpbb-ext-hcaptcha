<?php

/**
 * hCaptcha extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@proton.me>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\hcaptcha\captcha\plugins;

use phpbb\captcha\plugins\base;
use phpbb\captcha\plugins\confirm_type;
use phpbb\config\config;
use phpbb\db\driver\driver_interface;
use phpbb\language\language;
use phpbb\log\log_interface;
use phpbb\request\request_interface;
use phpbb\template\template;
use phpbb\user;
use alfredoramos\hcaptcha\includes\helper;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;

class hcaptcha extends base
{
	/** @var string */
	private const SCRIPT_URL = 'https://js.hcaptcha.com/1/api.js';

	/** @var string */
	private const VERIFY_ENDPOINT = 'https://hcaptcha.com/siteverify';

	/** @var template */
	protected $template;

	/** @var log_interface */
	protected log_interface $log;

	/** @var helper */
	protected helper $helper;

	/** @var GuzzleClient */
	protected GuzzleClient $client;

	/** @var string */
	protected string $service_name = '';

	/** @var array */
	protected array $supported_values = [
		'theme' => ['light', 'dark'],
		'size' => ['normal', 'compact']
	];

	/**
	 * Constructor of hCaptcha plugin.
	 *
	 * @param config			$config
	 * @param driver_interface	$db
	 * @param language			$language
	 * @param log_interface		$log
	 * @param request_interface	$request
	 * @param template			$template
	 * @param user				$user
	 * @param helper			$helper
	 *
	 * @return void
	 */
	public function __construct(config $config, driver_interface $db, language $language, log_interface $log, request_interface $request, template $template, user $user, helper $helper)
	{
		parent::__construct($config, $db, $language, $request, $user);

		$this->template = $template;
		$this->log = $log;
		$this->helper = $helper;
	}

	/**
	 * {@inheritDoc}
	 */
	public function init(confirm_type $type): void
	{
		parent::init($type);
		$this->language->add_lang('captcha/hcaptcha', 'alfredoramos/hcaptcha');
	}

	/**
	 * {@inheritDoc}
	 */
	public function is_available(): bool
	{
		$this->init($this->type);

		return !empty($this->config->offsetGet('hcaptcha_key'))
			&& !empty($this->config->offsetGet('hcaptcha_secret'));
	}

	/**
	 * {@inheritDoc}
	 */
	public function has_config(): bool
	{
		return true;
	}

	/**
	 * {@inheritDoc}
	 */
	public function get_name(): string
	{
		return 'CAPTCHA_HCAPTCHA';
	}

	/**
	 * {@inheritDoc}
	 */
	public function set_name(string $name): void
	{
		$this->service_name = $name;
	}

	/**
	 * {@inheritDoc}
	 */
	public function acp_page(mixed $id, mixed $module): void
	{
		$module->tpl_name = '@alfredoramos_hcaptcha/acp_captcha_hcaptcha';
		$module->page_title = 'ACP_VC_SETTINGS';

		$form_key = 'acp_captcha';
		add_form_key($form_key);

		// Validation errors
		$errors = [];

		// Field filters
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
					'regexp' => '#^(0x[a-fA-F0-9]{40}|ES_[a-fA-F0-9]{32})$#'
				]
			],
			'hcaptcha_theme' => [
				'filter' => FILTER_VALIDATE_REGEXP,
				'options' => [
					'regexp' => '#^(?:' . implode('|', $this->supported_values['theme']) . ')?$#'
				]
			],
			'hcaptcha_size' => [
				'filter' => FILTER_VALIDATE_REGEXP,
				'options' => [
					'regexp' => '#^(?:' . implode('|', $this->supported_values['size']) . ')?$#'
				]
			]
		];

		// Request form data
		if ($this->request->is_set_post('submit'))
		{
			if (!check_form_key($form_key))
			{
				trigger_error($this->language->lang('FORM_INVALID') . adm_back_link($module->u_action), E_USER_WARNING);
			}

			// Form data
			$fields = [
				'hcaptcha_key' => $this->request->variable('hcaptcha_key', ''),
				'hcaptcha_secret' => $this->request->variable('hcaptcha_secret', ''),
				'hcaptcha_theme' => $this->request->variable('hcaptcha_theme', $this->supported_values['theme'][0]),
				'hcaptcha_size' => $this->request->variable('hcaptcha_size', $this->supported_values['size'][0])
			];

			// Validation check
			if ($this->helper->validate($fields, $filters, $errors))
			{
				// Save configuration
				foreach ($fields as $key => $value)
				{
					$this->config->set($key, $value);
				}

				// Confirm dialog
				$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_CONFIG_VISUAL');
				trigger_error($this->language->lang('CONFIG_UPDATED') . adm_back_link($module->u_action));
			}
		}

		// Assign template variables
		$this->template->assign_vars([
			'U_ACTION'			=> $module->u_action,
			'PREVIEW'			=> true,

			'HCAPTCHA_KEY'		=> $this->config->offsetGet('hcaptcha_key'),
			'HCAPTCHA_SECRET'	=> $this->config->offsetGet('hcaptcha_secret'),

			'CAPTCHA_NAME'		=> $this->service_name,
			'CAPTCHA_PREVIEW'	=> $this->get_demo_template(),

			'S_HCAPTCHA_SETTINGS'	=> true
		]);

		// Assign allowed values
		foreach ($this->supported_values as $key => $value)
		{
			$block_var = sprintf('HCAPTCHA_%s_LIST', strtoupper($key));

			foreach ($value as $val)
			{
				$this->template->assign_block_vars($block_var, [
					'KEY' => $val,
					'NAME' => $this->language->lang(sprintf(
						'HCAPTCHA_%1$s_%2$s',
						strtoupper($key),
						strtoupper($val)
					)),
					'ENABLED' => ($this->config->offsetGet(sprintf('hcaptcha_%s', $key)) === $val)
				]);
			}
		}

		// Assign validation errors
		foreach ($errors as $error)
		{
			$this->template->assign_block_vars('VALIDATION_ERRORS', [
				'MESSAGE' => $error['message']
			]);
		}
	}

	/**
	 * {@inheritDoc}
	 */
	public function get_template(): string
	{
		if ($this->is_solved())
		{
			return '';
		}

		$this->template->assign_vars([
			'HCAPTCHA_KEY'			=> $this->config->offsetGet('hcaptcha_key'),
			'HCAPTCHA_THEME'		=> $this->config->offsetGet('hcaptcha_theme'),
			'HCAPTCHA_SIZE'			=> $this->config->offsetGet('hcaptcha_size'),
			'U_HCAPTCHA_SCRIPT'		=> self::SCRIPT_URL,
			'S_HCAPTCHA_AVAILABLE'	=> $this->is_available(),
			'S_TYPE'				=> $this->type->value
		]);

		return '@alfredoramos_hcaptcha/captcha_hcaptcha.html';
	}

	/**
	 * {@inheritDoc}
	 */
	public function get_demo_template(): string
	{
		$this->template->assign_vars([
			'HCAPTCHA_KEY'			=> $this->config->offsetGet('hcaptcha_key'),
			'HCAPTCHA_THEME'		=> $this->config->offsetGet('hcaptcha_theme'),
			'HCAPTCHA_SIZE'			=> $this->config->offsetGet('hcaptcha_size'),
			'U_HCAPTCHA_SCRIPT'		=> self::SCRIPT_URL,
			'S_HCAPTCHA_AVAILABLE'	=> $this->is_available(),
		]);

		return '@alfredoramos_hcaptcha/captcha_hcaptcha_demo.html';
	}

	/**
	 * Get Guzzle client
	 *
	 * @return GuzzleClient
	 */
	protected function get_client(): GuzzleClient
	{
		if (!isset($this->client))
		{
			$this->client = new GuzzleClient(['allow_redirects' => false]);
		}

		return $this->client;
	}

	/**
	 * {@inheritDoc}
	 */
	public function validate(): bool
	{
		if (parent::validate())
		{
			return true;
		}

		$result = $this->request->variable('h-captcha-response', '', true);

		if (empty($result))
		{
			$this->last_error = $this->language->lang('HCAPTCHA_INCORRECT');
			$this->solved = false;
			$this->confirm_code = '';
			return false;
		}

		// Verify hCaptcha token
		try
		{
			$client = $this->get_client();

			$response = $client->request('POST', self::VERIFY_ENDPOINT, [
				'form_params' => [
					'sitekey'	=> $this->config->offsetGet('hcaptcha_key'),
					'secret'	=> $this->config->offsetGet('hcaptcha_secret'),
					'response'	=> $result,
					'remoteip'	=> $this->user->ip
				]
			]);

			$data = json_decode($response->getBody()->getContents());

			if ($data->success === true)
			{
				$this->last_error = '';
				$this->solved = true;
				$this->confirm_code = $this->code;
				return true;
			}
		}
		catch (GuzzleException $ex)
		{
			$this->last_error = $this->language->lang('HCAPTCHA_REQUEST_EXCEPTION', $ex->getMessage());
			$this->solved = false;
			$this->confirm_code = '';
			return false;
		};

		// Must not get here
		$this->last_error = $this->language->lang('HCAPTCHA_INCORRECT');
		$this->solved = false;
		$this->confirm_code = '';
		return false;
	}

	/**
	 * {@inheritDoc}
	 */
	public function get_login_error_attempts(): string
	{
		$this->language->add_lang('captcha/hcaptcha', 'alfredoramos/hcaptcha');
		return 'HCAPTCHA_LOGIN_ERROR_ATTEMPTS';
	}
}

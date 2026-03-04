<?php

/**
 * hCaptcha extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@proton.me>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\hcaptcha\includes;

use phpbb\config\config;
use phpbb\language\language;
use phpbb\template\template;
use phpbb\captcha\factory as captcha_factory;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

class helper
{
	/** @var config */
	protected $config;

	/** @var language */
	protected $language;

	/** @var template */
	protected $template;

	/** @var captcha_factory */
	protected $captcha_factory;

	/** @var string */
	public const SUPPORT_FAQ = 'https://www.phpbb.com/customise/db/extension/hcaptcha/faq';

	/** @var string */
	public const SUPPORT_URL = 'https://www.phpbb.com/customise/db/extension/hcaptcha/support';

	/** @var string */
	public const VENDOR_DONATE = 'https://alfredoramos.mx/donate/';

	/**
	 * Helper constructor.
	 *
	 * @param language $language
	 *
	 * @param void
	 */
	public function __construct(config $config, language $language, template $template, captcha_factory $captcha_factory)
	{
		$this->config = $config;
		$this->language = $language;
		$this->template = $template;
		$this->captcha_factory = $captcha_factory;
	}

	/**
	 * Validate form fields with given filters.
	 *
	 * @param array $fields		Pair of field name and value
	 * @param array $filters	Filters that will be passed to filter_var_array()
	 * @param array $errors		Array of message errors
	 *
	 * @return bool
	 */
	public function validate(array &$fields = null, array &$filters = null, array &$errors = null): bool
	{
		$fields = $fields ?? [];
		$filters = $filters ?? [];
		$errors = $errors ?? [];

		if (empty($fields) || empty($filters))
		{
			return false;
		}

		// Filter fields
		$data = filter_var_array($fields, $filters, false);

		// Invalid fields helper
		$invalid = [];

		// Validate fields
		foreach ($data as $key => $value)
		{
			// Remove and generate error if field did not pass validation
			// Not using empty() because an empty string can be a valid value
			if (!isset($value) || $value === false)
			{
				$invalid[] = $this->language->lang(sprintf('%s', strtoupper($key)));
				unset($fields[$key]);
			}
		}

		if (!empty($invalid))
		{
			$errors[]['message'] = $this->language->lang(
				'ACP_HCAPTCHA_VALIDATE_INVALID_FIELDS',
				implode($this->language->lang('COMMA_SEPARATOR'), $invalid)
			);
		}

		// Validation check
		return empty($errors);
	}

	/**
	 * Force captcha on login page.
	 */
	public function setup_login_captcha(): void
	{
		if ((int) $this->config->offsetGet('hcaptcha_force_login') !== 1)
		{
			return;
		}

		try
		{
			$captcha = $this->captcha_factory->get_instance('alfredoramos.hcaptcha.captcha.hcaptcha');

			if (empty($captcha) || !$captcha->is_available())
			{
				return;
			}

			$captcha->init(CONFIRM_LOGIN);
			$this->template->assign_vars(['CAPTCHA_TEMPLATE' => $captcha->get_template()]);
		}
		catch(ServiceNotFoundException $ex) // Just in case, must not get here
		{
			return;
		}
	}
}

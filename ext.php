<?php

/**
 * hCaptcha extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\hcaptcha;

use phpbb\extension\base;

class ext extends base
{
	/**
	 * Check whether or not the extension can be enabled.
	 *
	 * @return bool
	 */
	public function is_enableable()
	{
		return phpbb_version_compare(PHPBB_VERSION, '3.3.0', '>=');
	}

	public function enable_step($old_state)
	{
		$parent_state = parent::enable_step($old_state);

		if ($parent_state === false)
		{
			$this->handle_hcaptcha('enable');
		}

		return $parent_state;
	}

	public function disable_step($old_state)
	{
		switch ($old_state)
		{
			case '':
				$state = $this->handle_hcaptcha('disable');
				break;

			default:
				$state = parent::disable_step($old_state);
				break;
		}

		return $state;
	}

	public function purge_step($old_state)
	{
		switch ($old_state)
		{
			case '':
				$state = $this->handle_hcaptcha('purge');
				break;

			default:
				$state = parent::purge_step($old_state);
				break;
		}

		return $state;
	}

	private function handle_hcaptcha($step)
	{
		$config = $this->container->get('config');
		$hcaptcha_service = 'alfredoramos.hcaptcha.captcha.hcaptcha';
		$selected_key = 'hcaptcha_selected';

		switch ($step)
		{
			case 'enable':
				if (!empty($config[$selected_key]))
				{
					$config->set('captcha_plugin', $hcaptcha_service);
				}

				$config->delete($selected_key);
			break;

			case 'disable':
				if ($config['captcha_plugin'] === $hcaptcha_service)
				{
					$config->set($selected_key, 1);
					$config->set('captcha_plugin', 'core.captcha.plugins.gd');
				}
			break;

			case 'purge':
				$config->delete($selected_key);
			break;
		}

		return 'hcaptcha_handled';
	}
}

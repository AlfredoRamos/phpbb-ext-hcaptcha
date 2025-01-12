<?php

/**
 * hCaptcha extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@proton.me>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\hcaptcha\tests\functional;

trait functional_test_case_trait
{
	static protected function setup_extensions()
	{
		return ['alfredoramos/hcaptcha'];
	}

	protected function init_hcaptcha()
	{
		$this->update_config([
			'captcha_plugin' => 'alfredoramos.hcaptcha.captcha.hcaptcha',
			'hcaptcha_key' => '10000000-ffff-ffff-ffff-000000000001',
			'hcaptcha_secret' => '0x0000000000000000000000000000000000000000',
			'old_captcha_plugin' => 'core.captcha.plugins.incomplete'
		]);
	}

	private function update_config(array $data = [])
	{
		if (empty($data))
		{
			return;
		}

		$db = $this->get_db();
		$db->sql_transaction('begin');

		foreach ($data as $key => $value)
		{
			if (!is_string($key) || !is_string($value))
			{
				continue;
			}

			$key = trim($key);
			$value = trim($value);

			if (empty($key) || empty($value))
			{
				continue;
			}

			$sql = 'UPDATE ' . CONFIG_TABLE . '
			SET ' . $db->sql_build_array('UPDATE',
				[
					'config_value' => $value,
					'is_dynamic' => 1 // Fix cache
				]
			) . '
			WHERE ' . $db->sql_build_array('UPDATE',
				['config_name' => $key]
			);
			$db->sql_query($sql);
		}

		$db->sql_transaction('commit');
	}
}

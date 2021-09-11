<?php

/**
 * hCaptcha extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
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
		$db = $this->get_db();
		$db->sql_transaction('begin');

		$config_ary = [
			// hCaptcha
			'captcha_plugin' => 'alfredoramos.hcaptcha.captcha.hcaptcha',
			'hcaptcha_key' => '10000000-ffff-ffff-ffff-000000000001',
			'hcaptcha_secret' => '0x0000000000000000000000000000000000000000'
		];

		foreach ($config_ary as $key => $value)
		{
			$key = trim($key);
			$value = trim($value);

			$sql = 'UPDATE ' . CONFIG_TABLE . '
				SET ' . $db->sql_build_array('UPDATE', [
					'config_value' => $value
				]) . '
				WHERE ' . $db->sql_build_array('UPDATE', [
					'config_name' => $key
				]);

			$db->sql_query($sql);
		}

		$db->sql_transaction('commit');
	}
}

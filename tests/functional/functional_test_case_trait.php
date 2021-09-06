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

	abstract protected function init();

	protected function setUp(): void
	{
		parent::setUp();

		$this->update_config_values([
			'hcaptcha_key' => '10000000-ffff-ffff-ffff-000000000001',
			'hcaptcha_secret' => '0x0000000000000000000000000000000000000000'
		]);

		$this->init();
	}

	private function update_config_values($data)
	{
		if (empty($data) || !is_array($data))
		{
			return;
		}

		$sql_data = [];

		foreach ($data as $key => $value)
		{
			$sql_data[] = [
				'config_name' => trim($key),
				'config_value' => trim($value),
				'is_dynamic' => 1 // Fix cache
			];
		}

		$db = $this->get_db();

		foreach ($sql_data as $sql_ary)
		{
			$sql_where = ['config_name' => $sql_ary['config_name']];
			unset($sql_ary['config_name']);

			$sql = 'UPDATE ' . CONFIG_TABLE . '
				SET ' . $db->sql_build_array('UPDATE', $sql_ary) . '
				WHERE ' . $db->sql_build_array('UPDATE', $sql_where);

			$db->sql_query($sql);
		}
	}
}

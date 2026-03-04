<?php

/**
 * hCaptcha extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@proton.me>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\hcaptcha\migrations\v10x;

use phpbb\db\migration\migration;

class m002_config extends migration
{
	/**
	 * Migration dependencies.
	 *
	 * @return array
	 */
	static public function depends_on()
	{
		return ['\alfredoramos\hcaptcha\migrations\v10x\m001_config'];
	}

	/**
	 * Add hCaptcha configuration.
	 *
	 * @return array
	 */
	public function update_data()
	{
		return [
			[
				'config.add',
				['hcaptcha_force_login', 1]
			]
		];
	}
}

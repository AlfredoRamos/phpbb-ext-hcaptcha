<?php

/**
 * hCaptcha extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@skiff.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\hcaptcha\migrations\v10x;

use phpbb\db\migration\migration;

class m001_config extends migration
{
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
				['hcaptcha_key', '']
			],
			[
				'config.add',
				['hcaptcha_secret', '']
			],
			[
				'config.add',
				['hcaptcha_theme', '']
			],
			[
				'config.add',
				['hcaptcha_size', '']
			],
		];
	}
}

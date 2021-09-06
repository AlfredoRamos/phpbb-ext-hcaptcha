<?php

/**
 * hCaptcha extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\hcaptcha\tests\functional;

/**
 * @group functional
 */
class acp_test extends \phpbb_functional_test_case
{
	use functional_test_case_trait;

	protected function init()
	{
		$this->add_lang_ext('alfredoramos/hcaptcha', 'captcha/hcaptcha');
		$this->login();
		$this->admin_login();
	}

	public function test_plugin_option()
	{
		$crawler = self::request('GET', sprintf(
			'adm/index.php?i=acp_captcha&mode=visual&sid=%s&',
			$this->sid
		));

		$form = $crawler->selectButton($this->lang('SUBMIT'))->form();
		$this->assertTrue($form->has('select_captcha'));
		$this->assertContains(
			'alfredoramos.hcaptcha.captcha.hcaptcha',
			$form->get('select_captcha')->availableOptionValues()
		);

		/*
		$container = $crawler->filter('.h-captcha');
		$this->assertSame(1, $container->count());
		$this->assertSame(
			'10000000-ffff-ffff-ffff-000000000001',
			$container->attr('data-sitekey')
		);
		$this->assertSame(
			1,
			preg_match(
				'#^[a-f0-9]{8}\-[a-f0-9]{4}\-[a-f0-9]{4}\-[a-f0-9]{4}\-[a-f0-9]{12}$#',
				$container->attr('data-sitekey')
			)
		);

		$script = $container->closest('dd')->filter('script');
		$this->assertSame(1, $script->count());
		$this->assertSame('https://js.hcaptcha.com/1/api.js', $script->attr('src'));
		$this->assertFalse(empty($script->attr('async')));
		$this->assertFalse(empty($script->attr('defer')));

		$noscript = $container->closest('dd')->filter('noscript');
		$this->assertSame(1, $noscript->count());
		$this->assertSame(
			$this->lang('HCAPTCHA_NOSCRIPT'),
			$noscript->filter('div')->text()
		);
		*/
	}
}

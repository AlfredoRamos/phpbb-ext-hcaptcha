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
	static protected function setup_extensions()
	{
		return ['alfredoramos/hcaptcha'];
	}

	protected function setUp(): void
	{
		parent::setUp();
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

		$form = $crawler->selectButton('configure')->form();
		$this->assertTrue($form->has('select_captcha'));
		$this->assertContains(
			'alfredoramos.hcaptcha.captcha.hcaptcha',
			$form->get('select_captcha')->availableOptionValues()
		);

		$form->get('select_captcha')->select('alfredoramos.hcaptcha.captcha.hcaptcha');

		$crawler = self::submit($form);

		$form = $crawler->selectButton('submit')->form();

		$this->assertTrue($form->has('hcaptcha_key'));
		$this->assertSame('', $form->get('hcaptcha_key')->getValue());

		$this->assertTrue($form->has('hcaptcha_secret'));
		$this->assertSame('', $form->get('hcaptcha_secret')->getValue());

		$this->assertTrue($form->has('hcaptcha_theme'));
		$this->assertSame('light', $form->get('hcaptcha_theme')->getValue());
		$this->assertSame(
			['light', 'dark'],
			$form->get('hcaptcha_theme')->availableOptionValues()
		);

		$this->assertTrue($form->has('hcaptcha_size'));
		$this->assertSame('normal', $form->get('hcaptcha_size')->getValue());
		$this->assertSame(
			['normal', 'compact'],
			$form->get('hcaptcha_size')->availableOptionValues()
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

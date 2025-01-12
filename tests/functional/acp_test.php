<?php

/**
 * hCaptcha extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@proton.me>
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

	protected function setUp(): void
	{
		parent::setUp();
		$this->add_lang_ext('alfredoramos/hcaptcha', 'captcha/hcaptcha');
		$this->login();
		$this->admin_login();
	}

	public function test_plugin_option()
	{
		$crawler = self::request('GET', 'adm/index.php?i=acp_captcha&mode=visual&sid=' . $this->sid);
		$form = $crawler->selectButton('main_submit')->form();

		$this->assertTrue($form->has('select_captcha'));
		$this->assertContains(
			'alfredoramos.hcaptcha.captcha.hcaptcha',
			$form->get('select_captcha')->availableOptionValues()
		);

		$form->get('select_captcha')->select('alfredoramos.hcaptcha.captcha.hcaptcha');

		// TODO: Investigage why it does not work sending a POST request
		//  since that's what it does internally when changing the option with JS (onchange event)
		// $crawler = self::submit($form);
		// $crawler = self::request('POST', 'adm/index.php?i=acp_captcha&mode=visual', $form->getPhpValues());
		$this->init_hcaptcha();
		$crawler = self::request('GET', 'adm/index.php?i=acp_captcha&mode=visual&sid=' . $this->sid);
		$form = $crawler->selectButton('main_submit')->form();
		$form->get('select_captcha')->select('alfredoramos.hcaptcha.captcha.hcaptcha');
		$crawler = self::submit($form);

		$this->assertSame(1, $crawler->filter('.successbox')->count());

		$crawler = self::request('GET', 'adm/index.php?i=acp_captcha&mode=visual&sid=' . $this->sid);
		$form = $crawler->selectButton('configure')->form();

		$this->assertTrue($form->has('select_captcha'));
		$this->assertContains(
			'alfredoramos.hcaptcha.captcha.hcaptcha',
			$form->get('select_captcha')->availableOptionValues()
		);
		$this->assertSame('alfredoramos.hcaptcha.captcha.hcaptcha', $form->get('select_captcha')->getValue());

		$crawler = self::submit($form);
		$form = $crawler->selectButton('submit')->form();

		$this->assertTrue($form->has('hcaptcha_key'));
		$this->assertSame('10000000-ffff-ffff-ffff-000000000001', $form->get('hcaptcha_key')->getValue());

		$this->assertTrue($form->has('hcaptcha_secret'));
		$this->assertSame('0x0000000000000000000000000000000000000000', $form->get('hcaptcha_secret')->getValue());

		$this->assertTrue($form->has('hcaptcha_theme'));
		$this->assertSame(['light', 'dark'], $form->get('hcaptcha_theme')->availableOptionValues());
		$this->assertSame('light', $form->get('hcaptcha_theme')->getValue());

		$this->assertTrue($form->has('hcaptcha_size'));
		$this->assertSame(['normal', 'compact'], $form->get('hcaptcha_size')->availableOptionValues());
		$this->assertSame('normal', $form->get('hcaptcha_size')->getValue());

		$form->setValues([
			'hcaptcha_theme' => 'dark',
			'hcaptcha_size' => 'compact'
		]);
		$crawler = self::submit($form);

		$this->assertSame(1, $crawler->filter('.successbox')->count());

		$crawler = self::request('GET', 'adm/index.php?i=acp_captcha&mode=visual&sid=' . $this->sid);
		$widget = $crawler->filter('.h-captcha');

		$this->assertSame(1, $widget->count());
		$this->assertSame(
			'10000000-ffff-ffff-ffff-000000000001',
			$widget->attr('data-sitekey')
		);
		$this->assertSame(1, preg_match(
			'#^[a-f0-9]{8}\-[a-f0-9]{4}\-[a-f0-9]{4}\-[a-f0-9]{4}\-[a-f0-9]{12}$#',
			$widget->attr('data-sitekey')
		));
		$this->assertSame('dark', $widget->attr('data-theme'));
		$this->assertSame('compact', $widget->attr('data-size'));

		$container = $crawler->filterXPath('//div[contains(@class, "h-captcha")]/ancestor::fieldset');
		$script = $crawler->filterXPath('//script[contains(@src, "hcaptcha.com")]');
		$noscript = $container->filter('noscript');

		$this->assertSame(1, $script->count());
		$this->assertSame('https://js.hcaptcha.com/1/api.js', $script->attr('src'));
		$this->assertSame(1, $noscript->count());
		$this->assertSame($this->lang('HCAPTCHA_NOSCRIPT'), $noscript->filter('div')->text());

		$form = $crawler->selectButton('configure')->form();
		$crawler = self::submit($form);
		$form = $crawler->selectButton('submit')->form();

		$this->assertTrue($form->has('hcaptcha_key'));
		$this->assertSame('10000000-ffff-ffff-ffff-000000000001', $form->get('hcaptcha_key')->getValue());

		$this->assertTrue($form->has('hcaptcha_secret'));
		$this->assertSame('0x0000000000000000000000000000000000000000', $form->get('hcaptcha_secret')->getValue());

		$this->assertTrue($form->has('hcaptcha_theme'));
		$this->assertSame('dark', $form->get('hcaptcha_theme')->getValue());

		$this->assertTrue($form->has('hcaptcha_size'));
		$this->assertSame('compact', $form->get('hcaptcha_size')->getValue());
	}
}

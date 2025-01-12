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
class ucp_test extends \phpbb_functional_test_case
{
	use functional_test_case_trait;

	protected function setUp(): void
	{
		parent::setUp();
		$this->add_lang_ext('alfredoramos/hcaptcha', 'captcha/hcaptcha');
		$this->init_hcaptcha();
	}

	public function test_register_captcha()
	{
		$crawler = self::request('GET', 'ucp.php?mode=register');
		$form = $crawler->selectButton('agreed')->form();

		$crawler = self::submit($form);
		$container = $crawler->filter('.hcaptcha-container');
		$this->assertSame(1, $container->count());

		$widget = $container->filter('.h-captcha');
		$this->assertSame(1, $widget->count());
		$this->assertSame(
			'10000000-ffff-ffff-ffff-000000000001',
			$widget->attr('data-sitekey')
		);
		$this->assertSame(
			1,
			preg_match(
				'#^[a-f0-9]{8}\-[a-f0-9]{4}\-[a-f0-9]{4}\-[a-f0-9]{4}\-[a-f0-9]{12}$#',
				$widget->attr('data-sitekey')
			)
		);

		$script = $crawler->filterXPath('//script[contains(@src, "hcaptcha.com")]');
		$this->assertSame(1, $script->count());
		$this->assertSame('https://js.hcaptcha.com/1/api.js', $script->attr('src'));

		$noscript = $container->filter('noscript');
		$this->assertSame(1, $noscript->count());
		$this->assertSame(
			$this->lang('HCAPTCHA_NOSCRIPT'),
			$noscript->filter('div')->text()
		);
	}
}

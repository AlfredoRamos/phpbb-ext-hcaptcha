<?php

/**
 * hCaptcha extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@proton.me>
 * @copyright 2026 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\hcaptcha\tests\event;

use alfredoramos\hcaptcha\event\listener;
use alfredoramos\hcaptcha\includes\helper;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * @group event
 */
class listener_test extends \phpbb_test_case
{
	protected $helper;

	protected function setUp(): void
	{
		parent::setUp();
		$this->helper = $this->getMockBuilder(helper::class)
			->disableOriginalConstructor()->getMock();
	}

	public function test_instance()
	{
		$this->assertInstanceOf(
			EventSubscriberInterface::class,
			new listener($this->helper)
		);
	}

	public function test_subscribed_events()
	{
		$this->assertSame(
			['core.login_box_before'],
			array_keys(listener::getSubscribedEvents())
		);
	}
}

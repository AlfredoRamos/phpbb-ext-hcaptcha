<?php

/**
 * hCaptcha extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@proton.me>
 * @copyright 2026 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\hcaptcha\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use alfredoramos\hcaptcha\includes\helper;

class listener implements EventSubscriberInterface
{
	/** @var helper */
	protected $helper;

	/**
	 * Listener constructor.
	 *
	 * @param helper $helper
	 *
	 * @return void
	 */
	public function __construct(helper $helper)
	{
		$this->helper = $helper;
	}

	/**
	 * Assign functions defined in this class to event listeners in the core.
	 *
	 * @return array
	 */
	static public function getSubscribedEvents()
	{
		return [
			'core.login_box_before' => 'login_captcha'
		];
	}

	/**
	 * Force captcha on login page.
	 */
	public function login_captcha($event): void
	{
		if ($event['admin'])
		{
			return;
		}

		$this->helper->setup_login_captcha();
	}
}

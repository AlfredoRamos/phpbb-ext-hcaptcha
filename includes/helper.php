<?php

/**
 * hCaptcha extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@proton.me>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\hcaptcha\includes;

use phpbb\language\language;

class helper
{
	/** @var language */
	protected $language;

	/**
	 * Helper constructor.
	 *
	 * @param language $language
	 *
	 * @param void
	 */
	public function __construct(language $language)
	{
		$this->language = $language;
	}

	/**
	 * Validate form fields with given filters.
	 *
	 * @param array $fields		Pair of field name and value
	 * @param array $filters	Filters that will be passed to filter_var_array()
	 * @param array $errors		Array of message errors
	 *
	 * @return bool
	 */
	public function validate(&$fields = [], &$filters = [], &$errors = [])
	{
		if (empty($fields) || empty($filters)) {
			return false;
		}

		// Filter fields
		$data = filter_var_array($fields, $filters, false);

		// Invalid fields helper
		$invalid = [];

		// Validate fields
		foreach ($data as $key => $value) {
			// Remove and generate error if field did not pass validation
			// Not using empty() because an empty string can be a valid value
			if (!isset($value) || $value === false) {
				$invalid[] = $this->language->lang(sprintf('%s', strtoupper($key)));
				unset($fields[$key]);
			}
		}

		if (!empty($invalid)) {
			$errors[]['message'] = $this->language->lang(
				'ACP_HCAPTCHA_VALIDATE_INVALID_FIELDS',
				implode($this->language->lang('COMMA_SEPARATOR'), $invalid)
			);
		}

		// Validation check
		return empty($errors);
	}
}

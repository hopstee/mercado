<?php
/**
 * LaraClassified - Classified Ads Web Application
 * Copyright (c) BedigitCom. All Rights Reserved
 *
 * Website: http://www.bedigit.com
 *
 * LICENSE
 * -------
 * This software is furnished under a license and may be used and copied
 * only in accordance with the terms of such license and with the inclusion
 * of the above copyright notice. If you Purchased from Codecanyon,
 * Please read the full License from here - http://codecanyon.net/licenses/standard
 */

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;


/**
 * E.K.
 */
class valBetweenRule implements Rule
{
	public $min = 0;
	public $max = 999999;
	
	public function __construct($name, $min = 0, $max = 999999)
	{
		$this->name = $name;
		$this->min = $min;
		$this->max = $max;
	}
	
	/**
	 * Determine if the validation rule passes.
	 * Multi-bytes version of the Laravel "between" rule.
	 *
	 * @param  string  $attribute
	 * @param  mixed  $value
	 * @return bool
	 */
	public function passes($attribute, $value)
	{
		$value = strip_tags($value);
		
		if ($value < $this->min) {
			return false;
		} else if ($value > $this->max) {
            return false;
		}
		
		return true;
	}
	
	/**
	 * Get the validation error message.
	 *
	 * @return string
	 */
	public function message()
	{	
		return trans('validation.value_between_rule', ['attribute' => $this->name ,'min' => $this->min, 'max' => $this->max]);
	}
}

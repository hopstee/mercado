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

namespace App\Http\Requests;

use App\Rules\BetweenRule;
use App\Rules\EmailRule;

class ReportRequest extends Request
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$rules = [
			'report_type_id' => ['required', 'not_in:0'],
			'phone'          => ['required','max:20'],
			'message'        => ['required', new BetweenRule(5, 1000)],
			'post_id'        => ['required', 'numeric'],
		];

		if(isEnabledField('email') && !is_null($this->input('email'))){
			$rules = [
				'email' => ['email',
					new EmailRule(), 
					'max:100'], 
			];
		}
		if ($this->filled('phone')) {
			$countryCode = $this->input('country_code', config('country.code'));
			if ($countryCode == 'UK') {
				$countryCode = 'GB';
			}
			$rules['phone'][] = 'phone:' . $countryCode;
		}
		
		// reCAPTCHA
		$rules = $this->recaptchaRules($rules);
		
		return $rules;
	}
	
	/**
	 * @return array
	 */
	public function messages()
	{
		$messages = [];
		
		return $messages;
	}
}

<?php

class User extends Eloquent 
{
	public function images()
	{
		return $this->has_many('Image');
	}

	public function websites()
	{
		return $this->has_many('Website');
	}

	public static $rules = array(
		'email' => 'required|email',
		'pass' => 'required|min:3',
		'confirm' => 'required|same:pass',
		'captchatest' => 'laracaptcha|required'
	);

	public static $messages = array(
		 'laracaptcha' => 'Invalid captcha'
	);

	public static function validate($input)
	{
		$v = Validator::make($input, static::$rules, static::$messages);
		return $v->fails()
			? $v
			: true;
	}

	public static function get_unique_string()
	{
		$random = base_convert(rand(10000,99999), 10, 36);
		if ( static::where_random($random)->first() ) {
			return static::get_unique_string();
		}

		return $random;
	}
}
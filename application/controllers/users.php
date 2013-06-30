<?php

class Users_Controller extends Base_Controller {

	public $restful = true;    

	public function get_index()
    {
        
        return View::make('user.index');

    }    

	public function post_index()
    {
        $credentials = array(
                        'username' => e(Input::get('email')),  // Input::get('email')
                        'password' => e(Input::get('pass')) // Input::get('password')
        );

        // Check Creds
        if ( Auth::attempt($credentials) )
        {
            return 'You are a user! I will log you in';
        }

        return Redirect::to('/users/');

    }    

	public function get_show()
    {

    }    

	public function get_edit()
    {

    }    

	public function get_new()
    {

    }    

	public function put_update()
    {

    }    

	public function delete_destroy()
    {

    }

}
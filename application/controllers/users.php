<?php

class Users_Controller extends Base_Controller {

	public $restful = true;    

	public function get_index()
    {
        //This is already overwritten in routes.php
        //return View::make('user.index');

    }    

	public function post_index()
    {
        $email = e(Input::get('email'));
        $password = e(Input::get('pass'));
        $password_conf = e(Input::get('confirm'));
        // Validate 
        $v = User::validate(array(
                'email' => $email,
                'pass' => $password,
                'confirm' => $password_conf
            ));
        if ( $v !== true ) {
        return Redirect::to('/users/new')->with_errors($v->errors);
        }

        // If email is already in the table, return text
        $record = User::where_email($email)->first();

        if ( $record ) {
        return 'Email already exists';
        }
        
        // Otherwise, add a new row, and return the user's profile page
        $row = User::create(array(
        'email' => $email,
        'random' => User::get_unique_string(),
        'password' => Hash::make($password)
        ));

        if ( $row ) {
        Auth::logout();
        return 'Registration Successful! Please Go back to ' . HTML::link('/', 'login' ) . ' page';
        }
    }    

	public function get_show($id)
    {
        // Logic that checks if the person is that user
        // If person is not a user then redirect
        return View::make('user.show');

        // User is logged in. Now they can add photos, add notes..etc
    }    

	public function get_edit()
    {

    }    

	public function get_new()
    {
        return View::make('user.new');
    }    

	public function put_update()
    {

    }    

	public function delete_destroy()
    {

    }

}